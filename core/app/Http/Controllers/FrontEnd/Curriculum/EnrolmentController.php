<?php

namespace App\Http\Controllers\FrontEnd\Curriculum;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\PaymentGateway\FlutterwaveController;
use App\Http\Controllers\FrontEnd\PaymentGateway\InstamojoController;
use App\Http\Controllers\FrontEnd\PaymentGateway\MercadoPagoController;
use App\Http\Controllers\FrontEnd\PaymentGateway\MollieController;
use App\Http\Controllers\FrontEnd\PaymentGateway\OfflineController;
use App\Http\Controllers\FrontEnd\PaymentGateway\PayPalController;
use App\Http\Controllers\FrontEnd\PaymentGateway\PaystackController;
use App\Http\Controllers\FrontEnd\PaymentGateway\PaytmController;
use App\Http\Controllers\FrontEnd\PaymentGateway\RazorpayController;
use App\Http\Controllers\FrontEnd\PaymentGateway\StripeController;
use App\Models\BasicSettings\MailTemplate;
use App\Models\Curriculum\Course;
use App\Models\Curriculum\CourseEnrolment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EnrolmentController extends Controller
{
  public function enrol(Request $request, $id)
  {
    // check whether user is logged in or not
    if (Auth::guard('web')->check() == false) {
      return redirect()->route('user.login', ['redirectPath' => 'course_details']);
    } else {
      // check for user's profile information
      $user = Auth::guard('web')->user();

      if ($user->edit_profile_status == 0) {
        $request->session()->flash('profile_warning', 'Please complete your profile information');

        return redirect()->back()->withInput();
      }
    }

    // free course enrolment
    if ($request->filled('type') && $request['type'] == 'free') {
      $freeCourseEnrol = new FreeCourseEnrolController();

      return $freeCourseEnrol->enrolmentProcess($id);
    }

    // premium course enrolment
    if (!$request->exists('gateway')) {
      $request->session()->flash('error', 'Please select a payment method.');

      return redirect()->back();
    } else if ($request['gateway'] == 'paypal') {
      $paypal = new PayPalController();

      return $paypal->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'instamojo') {
      $instamojo = new InstamojoController();

      return $instamojo->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'paystack') {
      $paystack = new PaystackController();

      return $paystack->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'flutterwave') {
      $flutterwave = new FlutterwaveController();

      return $flutterwave->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'razorpay') {
      $razorpay = new RazorpayController();

      return $razorpay->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'mercadopago') {
      $mercadopago = new MercadoPagoController();

      return $mercadopago->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'mollie') {
      $mollie = new MollieController();

      return $mollie->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'stripe') {
      $stripe = new StripeController();

      return $stripe->enrolmentProcess($request, $id);
    } else if ($request['gateway'] == 'paytm') {
      $paytm = new PaytmController();

      return $paytm->enrolmentProcess($request, $id);
    } else {
      $offline = new OfflineController();

      return $offline->enrolmentProcess($request, $id);
    }
  }

  public function calculation(Request $request, $courseId)
  {
    $course = Course::where('id', '=', $courseId)->where('status', '=', 'published')->firstOrFail();

    $course_price = floatval($course->current_price);

    if ($request->session()->has('discountedCourse')) {
      $_course_id = $request->session()->get('discountedCourse');

      if ($courseId == $_course_id) {
        if ($request->session()->has('discount')) {
          $_discount = $request->session()->get('discount');
        }

        if ($request->session()->has('discountedPrice')) {
          $_course_new_price = $request->session()->get('discountedPrice');
        }
      }
    }

    $calculatedData = array(
      'coursePrice' => $course_price,
      'discount' => isset($_discount) ? floatval($_discount) : null,
      'grandTotal' => isset($_course_new_price) ? floatval($_course_new_price) : $course_price
    );

    return $calculatedData;
  }

  public function storeData($info)
  {
    $enrolment = CourseEnrolment::create([
      'user_id' => Auth::guard('web')->user()->id,
      'order_id' => uniqid(),
      'billing_first_name' => Auth::guard('web')->user()->first_name,
      'billing_last_name' => Auth::guard('web')->user()->last_name,
      'billing_email' => Auth::guard('web')->user()->email,
      'billing_contact_number' => Auth::guard('web')->user()->contact_number,
      'billing_address' => Auth::guard('web')->user()->address,
      'billing_city' => Auth::guard('web')->user()->city,
      'billing_state' => Auth::guard('web')->user()->state,
      'billing_country' => Auth::guard('web')->user()->country,
      'course_id' => $info['courseId'],
      'course_price' => array_key_exists('coursePrice', $info) ? $info['coursePrice'] : null,
      'discount' => array_key_exists('discount', $info) ? $info['discount'] : null,
      'grand_total' => array_key_exists('grandTotal', $info) ? $info['grandTotal'] : null,
      'currency_text' => array_key_exists('currencyText', $info) ? $info['currencyText'] : null,
      'currency_text_position' => array_key_exists('currencyTextPosition', $info) ? $info['currencyTextPosition'] : null,
      'currency_symbol' => array_key_exists('currencySymbol', $info) ? $info['currencySymbol'] : null,
      'currency_symbol_position' => array_key_exists('currencySymbolPosition', $info) ? $info['currencySymbolPosition'] : null,
      'payment_method' => array_key_exists('paymentMethod', $info) ? $info['paymentMethod'] : null,
      'gateway_type' => array_key_exists('gatewayType', $info) ? $info['gatewayType'] : null,
      'payment_status' => array_key_exists('paymentStatus', $info) ? $info['paymentStatus'] : null,
      'attachment' => array_key_exists('attachmentFile', $info) ? $info['attachmentFile'] : null
    ]);

    return $enrolment;
  }

  public function generateInvoice($enrolmentInfo, $courseId)
  {
    $fileName = $enrolmentInfo->order_id . '.pdf';
    $directory = './assets/file/invoices/';

    @mkdir($directory, 0775, true);

    $fileLocated = $directory . $fileName;

    // get course title
    $language = $this->getLanguage();

    $course = Course::findOrFail($courseId);

    $courseInfo = $course->information()->where('language_id', $language->id)->firstOrFail();

    $width = "50%";
    $float = "right";
    $mb = "35px";
    $ml = "18px";

    PDF::loadView('frontend.curriculum.invoice', compact('enrolmentInfo', 'courseInfo', 'width', 'float', 'mb', 'ml'))->save($fileLocated);

    return $fileName;
  }

  public function sendMail($enrolmentInfo)
  {
    // first get the mail template info from db
    $mailTemplate = MailTemplate::where('mail_type', 'course_enrolment')->first();
    $mailSubject = $mailTemplate->mail_subject;
    $mailBody = $mailTemplate->mail_body;

    // second get the website title & mail's smtp info from db
    $info = DB::table('basic_settings')
      ->select('website_title', 'smtp_status', 'smtp_host', 'smtp_port', 'encryption', 'smtp_username', 'smtp_password', 'from_mail', 'from_name')
      ->first();

    $customerName = $enrolmentInfo->billing_first_name . ' ' . $enrolmentInfo->billing_last_name;
    $orderId = $enrolmentInfo->order_id;

    $language = $this->getLanguage();
    $course = Course::where('id', $enrolmentInfo->course_id)->firstOrFail();
    $courseInfo = $course->information()->where('language_id', $language->id)->firstOrFail();
    $courseTitle = $courseInfo->title;

    $websiteTitle = $info->website_title;

    $mailBody = str_replace('{customer_name}', $customerName, $mailBody);
    $mailBody = str_replace('{order_id}', $orderId, $mailBody);
    $mailBody = str_replace('{title}', '<a href="' . route('course_details', ['slug' => $courseInfo->slug]) . '">' . $courseTitle . '</a>', $mailBody);
    $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

    // initialize a new mail
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    // if smtp status == 1, then set some value for PHPMailer
    if ($info->smtp_status == 1) {
      $mail->isSMTP();
      $mail->Host       = $info->smtp_host;
      $mail->SMTPAuth   = true;
      $mail->Username   = $info->smtp_username;
      $mail->Password   = $info->smtp_password;

      if ($info->encryption == 'TLS') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      }

      $mail->Port       = $info->smtp_port;
    }

    // finally add other informations and send the mail
    try {
      // Recipients
      $mail->setFrom($info->from_mail, $info->from_name);
      $mail->addAddress($enrolmentInfo->billing_email);

      // Attachments (Invoice)
      $mail->addAttachment('assets/file/invoices/' . $enrolmentInfo->invoice);

      // Content
      $mail->isHTML(true);
      $mail->Subject = $mailSubject;
      $mail->Body    = $mailBody;

      $mail->send();

      return;
    } catch (Exception $e) {
      return session()->put('error', 'Mail could not be sent! Mailer Error: ' . $e);
    }
  }

  public function complete($id, Request $request, $via = null)
  {
    $language = $this->getLanguage();

    $queryResult['bgImg'] = $this->getBreadcrumb();

    $course = Course::findOrFail($id);

    $queryResult['courseInfo'] = $course->information()->where('language_id', $language->id)->firstOrFail();

    $queryResult['paidVia'] = $via;

    // forget all session data before proceed
    $request->session()->forget('discountedCourse');
    $request->session()->forget('discount');
    $request->session()->forget('discountedPrice');

    return view('frontend.payment.success', $queryResult);
  }

  public function cancel($id, Request $request)
  {
    $language = $this->getLanguage();

    $course = Course::findOrFail($id);

    $courseInfo = $course->information()->where('language_id', $language->id)->firstOrFail();

    $request->session()->flash('error', 'Sorry, an error has occured!');

    // forget all session data before proceed
    $request->session()->forget('discountedCourse');
    $request->session()->forget('discount');
    $request->session()->forget('discountedPrice');

    return redirect()->route('course_details', ['slug' => $courseInfo->slug]);
  }
}
