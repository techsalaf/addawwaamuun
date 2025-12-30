<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
  public function enrolmentProcess(Request $request, $courseId)
  {
    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $allowedCurrencies = array('BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN', 'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD');

    $currencyInfo = $this->getCurrencyInfo();

    // checking whether the base currency is allowed or not
    if (!in_array($currencyInfo->base_currency_text, $allowedCurrencies)) {
      return redirect()->back()->with('error', 'Invalid currency for flutterwave payment.')->withInput();
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
      'paymentMethod' => 'Flutterwave',
      'gatewayType' => 'online',
      'paymentStatus' => 'completed'
    );

    $title = 'Course Enrolment';
    $notifyURL = route('course_enrolment.flutterwave.notify');

    // generate a payment reference
    $reference = Flutterwave::generateReference();

    $data = [
      'payment_options' => 'card,banktransfer',
      'amount' => $calculatedData['grandTotal'],
      'email' => Auth::guard('web')->user()->email,
      'tx_ref' => $reference,
      'currency' => $currencyInfo->base_currency_text,
      'redirect_url' => $notifyURL,
      'customer' => [
        'email' => Auth::guard('web')->user()->email,
        'phone_number' => Auth::guard('web')->user()->contact_number,
        'name' => Auth::guard('web')->user()->first_name . ' ' . Auth::guard('web')->user()->last_name
      ],
      'customizations' => [
        'title' => $title,
        'description' => 'Course Enrolment via Flutterwave'
      ]
    ];

    $payment = Flutterwave::initializePayment($data);

    // put some data in session before redirect to flutterwave url
    $request->session()->put('courseId', $courseId);
    $request->session()->put('arrData', $arrData);

    if ($payment['status'] === 'success') {
      return redirect($payment['data']['link']);
    } else {
      return redirect()->back()->with('error', 'Error: ' . $payment['message'])->withInput();
    }
  }

  public function notify(Request $request)
  {
    // get the information from session
    $courseId = $request->session()->get('courseId');
    $arrData = $request->session()->get('arrData');

    $urlInfo = $request->all();

    if ($urlInfo['status'] == 'successful') {
      $transactionID = Flutterwave::getTransactionIDFromCallback();
      $transactionInfo = Flutterwave::verifyTransaction($transactionID);

      if ($transactionInfo['data']['status'] == 'successful') {
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

        return redirect()->route('course_enrolment.complete', ['id' => $courseId]);
      } else {
        // remove all session data
        $request->session()->forget('courseId');
        $request->session()->forget('arrData');

        return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
      }
    } else {
      // remove all session data
      $request->session()->forget('courseId');
      $request->session()->forget('arrData');

      return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
    }
  }
}
