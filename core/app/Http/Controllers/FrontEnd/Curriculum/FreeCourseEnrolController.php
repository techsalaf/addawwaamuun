<?php

namespace App\Http\Controllers\FrontEnd\Curriculum;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Curriculum\EnrolmentController;
use Illuminate\Http\Request;

class FreeCourseEnrolController extends Controller
{
  public function enrolmentProcess($courseId)
  {
    $enrol = new EnrolmentController();

    $arrData = array(
      'courseId' => $courseId,
      'paymentStatus' => 'completed'
    );

    // store the course enrolment information in database
    $enrolmentInfo = $enrol->storeData($arrData);

    // generate an invoice in pdf format
    $invoice = $enrol->generateInvoice($enrolmentInfo, $courseId);

    // then, update the invoice field info in database
    $enrolmentInfo->update(['invoice' => $invoice]);

    // send a mail to the customer with the invoice
    $enrol->sendMail($enrolmentInfo);

    return redirect()->route('course_enrolment.complete', ['id' => $courseId]);
  }
}
