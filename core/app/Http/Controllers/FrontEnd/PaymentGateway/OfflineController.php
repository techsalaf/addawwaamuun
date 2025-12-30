<?php

namespace App\Http\Controllers\FrontEnd\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use App\Http\Helpers\UploadFile;
use App\Models\Curriculum\CourseEnrolment;
use App\Models\PaymentGateway\OfflineGateway;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OfflineController extends Controller
{
  public function enrolmentProcess(Request $request, $courseId)
  {
    // check whether this course is already erolled to authenticate user
    $authUser = Auth::guard('web')->user();
    $status = CourseEnrolment::where('user_id', $authUser->id)->where('course_id', $courseId)->pluck('payment_status')->first();

    if (!is_null($status) && $status == 'pending') {
      $request->session()->flash('warning', 'Your enrolment request for this course is pending.');

      return redirect()->back();
    }

    $offlineGateway = OfflineGateway::find($request->gateway);

    // check whether attachment is required or not
    if ($offlineGateway->has_attachment == 1) {
      $rules = [
        'attachment' => [
          'required',
          new ImageMimeTypeRule()
        ]
      ];

      $validator = Validator::make($request->all(), $rules);

      $request->session()->flash('gatewayId', $offlineGateway->id);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
    }

    $enrol = new EnrolmentController();

    // do calculation
    $calculatedData = $enrol->calculation($request, $courseId);

    $currencyInfo = $this->getCurrencyInfo();

    // store attachment in local storage
    if ($request->hasFile('attachment')) {
      $attachmentName = UploadFile::store('./assets/file/attachments/', $request->file('attachment'));
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
      'paymentMethod' => $offlineGateway->name,
      'gatewayType' => 'offline',
      'paymentStatus' => 'pending',
      'attachmentFile' => $request->exists('attachment') ? $attachmentName : null
    );

    // store the course enrolment information in database
    $enrol->storeData($arrData);

    return redirect()->route('course_enrolment.complete', ['id' => $courseId, 'via' => 'offline']);
  }
}
