<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaytmController extends Controller
{
  public function enrolmentProcess(Request $request, $courseId)
  {
    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $currencyInfo = $this->getCurrencyInfo();

    // checking whether the currency is set to 'INR' or not
    if ($currencyInfo->base_currency_text !== 'INR') {
      return redirect()->back()->with('error', 'Invalid currency for paytm payment.')->withInput();
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
      'paymentMethod' => 'Paytm',
      'gatewayType' => 'online',
      'paymentStatus' => 'completed'
    );

    $notifyURL = route('course_enrolment.paytm.notify');

    $payment = PaytmWallet::with('receive');

    $payment->prepare([
      'order' => time(),
      'user' => uniqid(),
      'mobile_number' => Auth::guard('web')->user()->contact_number,
      'email' => Auth::guard('web')->user()->email,
      'amount' => $calculatedData['grandTotal'],
      'callback_url' => $notifyURL
    ]);

    // put some data in session before redirect to paytm url
    $request->session()->put('courseId', $courseId);
    $request->session()->put('arrData', $arrData);

    return $payment->receive();
  }

  public function notify(Request $request)
  {
    // get the information from session
    $courseId = $request->session()->get('courseId');
    $arrData = $request->session()->get('arrData');

    $transaction = PaytmWallet::with('receive');

    // this response is needed to check the transaction status
    $response = $transaction->response();

    if ($transaction->isSuccessful()) {
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
  }
}
