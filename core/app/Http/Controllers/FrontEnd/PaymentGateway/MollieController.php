<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
  public function enrolmentProcess(Request $request, $courseId)
  {
    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $allowedCurrencies = array('AED', 'AUD', 'BGN', 'BRL', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HRK', 'HUF', 'ILS', 'ISK', 'JPY', 'MXN', 'MYR', 'NOK', 'NZD', 'PHP', 'PLN', 'RON', 'RUB', 'SEK', 'SGD', 'THB', 'TWD', 'USD', 'ZAR');

    $currencyInfo = $this->getCurrencyInfo();

    // checking whether the base currency is allowed or not
    if (!in_array($currencyInfo->base_currency_text, $allowedCurrencies)) {
      return redirect()->back()->with('error', 'Invalid currency for mollie payment.')->withInput();
    }

    $arrData = array(
      'courseId' => $courseId,
      'coursePrice' => $calculatedData['coursePrice'],
      'discount' => $calculatedData['discount'],
      'grandTotal' => $calculatedData['grandTotal'],
      'currencyText' => $currencyInfo->base_currency_text,
      'currencyTextPosition' => $currencyInfo->base_currency_text_position,
      'currencySymbol' => $currencyInfo->base_currency_symbol,
      'currencySymbolPosition' => $currencyInfo->base_currency_symbol_position,
      'paymentMethod' => 'Mollie',
      'gatewayType' => 'online',
      'paymentStatus' => 'completed'
    );

    $notifyURL = route('course_enrolment.mollie.notify');

    /**
     * we must send the correct number of decimals.
     * thus, we have used sprintf() function for format.
     */
    $payment = Mollie::api()->payments->create([
      'amount' => [
        'currency' => $currencyInfo->base_currency_text,
        'value' => sprintf('%0.2f', $calculatedData['grandTotal'])
      ],
      'description' => 'Course Enrolment Via Mollie',
      'redirectUrl' => $notifyURL
    ]);

    // put some data in session before redirect to mollie url
    $request->session()->put('courseId', $courseId);
    $request->session()->put('arrData', $arrData);
    $request->session()->put('paymentId', $payment->id);

    return redirect($payment->getCheckoutUrl(), 303);
  }

  public function notify(Request $request)
  {
    // get the information from session
    $courseId = $request->session()->get('courseId');
    $arrData = $request->session()->get('arrData');
    $paymentId = $request->session()->get('paymentId');

    $paymentInfo = Mollie::api()->payments->get($paymentId);

    if ($paymentInfo->isPaid() == true) {
      $enrol = new EnrolmentController();

      // store the course enrolment information in database
      $enrolmentInfo = $enrol->storeData($arrData);

      // generate an invoice in pdf format
      $invoice = $enrol->generateInvoice($enrolmentInfo, $courseId);

      // then, update the invoice field info in database
      $enrolmentInfo->update(['invoice' => $invoice]);

      // send a mail to the customer with the invoice
      $enrol->sendMail($enrolmentInfo);

      // remove all session data
      $request->session()->forget('courseId');
      $request->session()->forget('arrData');
      $request->session()->forget('paymentId');

      return redirect()->route('course_enrolment.complete', ['id' => $courseId]);
    } else {
      // remove all session data
      $request->session()->forget('courseId');
      $request->session()->forget('arrData');
      $request->session()->forget('paymentId');

      return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
    }
  }
}
