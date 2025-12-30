<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Basic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends Controller
{
	public function contact()
	{
		$language = $this->getLanguage();

		$queryResult['seoInfo'] = $language->seoInfo()->select('meta_keyword_contact', 'meta_description_contact')->first();

		$queryResult['pageHeading'] = $this->getPageHeading($language);

		$queryResult['bgImg'] = $this->getBreadcrumb();

		$queryResult['info'] = Basic::select('email_address', 'contact_number', 'address', 'latitude', 'longitude', 'google_recaptcha_status')
			->firstOrFail();

		return view('frontend.contact', $queryResult);
	}

	public function sendMail(Request $request)
	{
		$info = Basic::select('google_recaptcha_status', 'to_mail')->firstOrFail();

		$rules = [
			'name' => 'required',
			'email' => 'required|email:rfc,dns',
			'subject' => 'required',
			'message' => 'required'
		];

		if ($info->google_recaptcha_status == 1) {
			$rules['g-recaptcha-response'] = 'required|captcha';
		}

		$msgs = [];

		if ($info->google_recaptcha_status == 1) {
			$msgs['g-recaptcha-response.required'] = 'Please verify that you are not a robot.';
			$msgs['g-recaptcha-response.captcha'] = 'Captcha error! try again later or contact site admin.';
		}

		$validator = Validator::make($request->all(), $rules, $msgs);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}

		$from = $request->email;
		$name = $request->name;
		$to = $info->to_mail;
		$subject = $request->subject;
		$message = $request->message;

		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'base64';

		try {
			$mail->setFrom($from, $name);
			$mail->addAddress($to);

			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;

			$mail->send();

			$request->session()->flash('success', 'Mail has been sent.');
		} catch (Exception $e) {
			$request->session()->flash('error', 'Mail could not be sent!');
		}

		return redirect()->back();
	}
}
