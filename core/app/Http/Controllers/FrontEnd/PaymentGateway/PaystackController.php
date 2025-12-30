<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use App\Models\PaymentGateway\OnlineGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaystackController extends Controller
{
  private $api_key;

  public function __construct()
  {
    $data = OnlineGateway::whereKeyword('paystack')->first();
    $paystackData = json_decode($data->information, true);

    $this->api_key = $paystackData['key'];
  }

  public function enrolmentProcess(Request $request, $courseId)
  {
    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $currencyInfo = $this->getCurrencyInfo();

    // checking whether the currency is set to 'NGN' or not
    if ($currencyInfo->base_currency_text !== 'NGN') {
      return redirect()->back()->with('error', 'Invalid currency for paystack payment.')->withInput();
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
      'paymentMethod' => 'Paystack',
      'gatewayType' => 'online',
      'paymentStatus' => 'completed'
    );

    $notifyURL = route('course_enrolment.paystack.notify');

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL            => 'https://api.paystack.co/transaction/initialize',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST  => 'POST',
      CURLOPT_POSTFIELDS     => json_encode([
        'amount'       => intval($calculatedData['grandTotal']) * 100,
        'email'        => Auth::guard('web')->user()->email,
        'callback_url' => $notifyURL
      ]),
      CURLOPT_HTTPHEADER     => [
        'authorization: Bearer ' . $this->api_key,
        'content-type: application/json',
        'cache-control: no-cache'
      ]
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $transaction = json_decode($response, true);

    // put some data in session before redirect to paystack url
    $request->session()->put('courseId', $courseId);
    $request->session()->put('arrData', $arrData);

    if ($transaction['status'] == true) {
      return redirect($transaction['data']['authorization_url']);
    } else {
      return redirect()->back()->with('error', 'Error: ' . $transaction['message'])->withInput();
    }
  }

  public function notify(Request $request)
  {
    // get the information from session
    $courseId = $request->session()->get('courseId');
    $arrData = $request->session()->get('arrData');

    $urlInfo = $request->all();

    if ($urlInfo['trxref'] === $urlInfo['reference']) {
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
