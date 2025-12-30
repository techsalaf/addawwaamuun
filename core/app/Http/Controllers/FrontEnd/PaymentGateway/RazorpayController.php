<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use App\Models\PaymentGateway\OnlineGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends Controller
{
  private $key, $secret, $api;

  public function __construct()
  {
    $data = OnlineGateway::whereKeyword('razorpay')->first();
    $razorpayData = json_decode($data->information, true);

    $this->key = $razorpayData['key'];
    $this->secret = $razorpayData['secret'];

    $this->api = new Api($this->key, $this->secret);
  }

  public function enrolmentProcess(Request $request, $courseId)
  {
    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $currencyInfo = $this->getCurrencyInfo();

    // checking whether the currency is set to 'INR' or not
    if ($currencyInfo->base_currency_text !== 'INR') {
      return redirect()->back()->with('error', 'Invalid currency for razorpay payment.')->withInput();
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
      'paymentMethod' => 'Razorpay',
      'gatewayType' => 'online',
      'paymentStatus' => 'completed'
    );

    $notifyURL = route('course_enrolment.razorpay.notify');

    // create order data
    $orderData = [
      'receipt'         => 'Course Enrolment',
      'amount'          => $calculatedData['grandTotal'] * 100,
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $this->api->order->create($orderData);

    $webInfo = DB::table('basic_settings')->select('website_title')->first();
    $buyerName = Auth::guard('web')->user()->first_name . ' ' . Auth::guard('web')->user()->last_name;
    $buyerEmail = Auth::guard('web')->user()->email;
    $buyerContact = Auth::guard('web')->user()->contact_number;

    // create checkout data
    $checkoutData = [
      'key'               => $this->key,
      'amount'            => $orderData['amount'],
      'name'              => $webInfo->website_title,
      'description'       => 'Course Enrolment Via Razorpay',
      'prefill'           => [
        'name'              => $buyerName,
        'email'             => $buyerEmail,
        'contact'           => $buyerContact
      ],
      'order_id'          => $razorpayOrder->id
    ];

    $jsonData = json_encode($checkoutData);

    // put some data in session before redirect to razorpay url
    $request->session()->put('courseId', $courseId);
    $request->session()->put('arrData', $arrData);
    $request->session()->put('razorpayOrderId', $razorpayOrder->id);

    return view('frontend.payment.razorpay', compact('jsonData', 'notifyURL'));
  }

  public function notify(Request $request)
  {
    // get the information from session
    $courseId = $request->session()->get('courseId');
    $arrData = $request->session()->get('arrData');
    $razorpayOrderId = $request->session()->get('razorpayOrderId');

    $urlInfo = $request->all();

    // assume that the transaction was successful
    $success = true;

    /**
     * either razorpay_order_id or razorpay_subscription_id must be present.
     * the keys of $attributes array must be follow razorpay convention.
     */
    try {
      $attributes = [
        'razorpay_order_id' => $razorpayOrderId,
        'razorpay_payment_id' => $urlInfo['razorpayPaymentId'],
        'razorpay_signature' => $urlInfo['razorpaySignature']
      ];

      $this->api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
      $success = false;
    }

    if ($success === true) {
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
      $request->session()->forget('razorpayOrderId');

      return redirect()->route('course_enrolment.complete', ['id' => $courseId]);
    } else {
      // remove all session data
      $request->session()->forget('courseId');
      $request->session()->forget('arrData');
      $request->session()->forget('razorpayOrderId');

      return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
    }
  }
}
