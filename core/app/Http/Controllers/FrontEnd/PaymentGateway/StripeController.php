<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\UnauthorizedException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
  public function enrolmentProcess(Request $request, $courseId)
  {
    // card validation start
    $rules = [
      'card_number' => 'required',
      'cvc_number' => 'required',
      'expiry_month' => 'required',
      'expiry_year' => 'required'
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    // card validation end

    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $currencyInfo = $this->getCurrencyInfo();

    // changing the currency before redirect to Stripe
    if ($currencyInfo->base_currency_text !== 'USD') {
      $rate = floatval($currencyInfo->base_currency_rate);
      $convertedTotal = round(($calculatedData['grandTotal'] / $rate), 2);
    }

    $stripeTotal = $currencyInfo->base_currency_text === 'USD' ? $calculatedData['grandTotal'] : $convertedTotal;

    $arrData = array(
      'courseId' => $courseId,
      'coursePrice' => $calculatedData['coursePrice'],
      'discount' => $calculatedData['discount'],
      'grandTotal' => $calculatedData['grandTotal'],
      'currencyText' => $currencyInfo->base_currency_text,
      'currencyTextPosition' => $currencyInfo->base_currency_text_position,
      'currencySymbol' => $currencyInfo->base_currency_symbol,
      'currencySymbolPosition' => $currencyInfo->base_currency_symbol_position,
      'paymentMethod' => 'Stripe',
      'gatewayType' => 'online',
      'paymentStatus' => 'completed'
    );

    try {
      // initialize stripe
      $stripe = new Stripe();
      $stripe = Stripe::make(Config::get('services.stripe.secret'));

      try {
        // generate token
        $token = $stripe->tokens()->create([
          'card' => [
            'number'    => $request['card_number'],
            'cvc'       => $request['cvc_number'],
            'exp_month' => $request['expiry_month'],
            'exp_year'  => $request['expiry_year']
          ]
        ]);

        // generate charge
        $charge = $stripe->charges()->create([
          'source' => $token['id'],
          'currency' => 'USD',
          'amount'   => $stripeTotal
        ]);

        if ($charge['status'] == 'succeeded') {
          // store the course enrolment information in database
          $enrolmentInfo = $enrol->storeData($arrData);

          // generate an invoice in pdf format
          $invoice = $enrol->generateInvoice($enrolmentInfo, $courseId);

          // then, update the invoice field info in database
          $enrolmentInfo->update(['invoice' => $invoice]);

          // send a mail to the customer with the invoice
          $enrol->sendMail($enrolmentInfo);

          return redirect()->route('course_enrolment.complete', ['id' => $courseId]);
        } else {
          return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
        }
      } catch (CardErrorException $e) {
        $request->session()->flash('error', $e->getMessage());

        return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
      }
    } catch (UnauthorizedException $e) {
      $request->session()->flash('error', $e->getMessage());

      return redirect()->route('course_enrolment.cancel', ['id' => $courseId]);
    }
  }
}
