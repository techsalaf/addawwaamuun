<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
  /**
   * The URIs that should be excluded from CSRF verification.
   *
   * @var array
   */
  protected $except = [
    '/course-enrolment/flutterwave/notify',
    '/course-enrolment/razorpay/notify',
    '/course-enrolment/mercadopago/notify',
    '/course-enrolment/paytm/notify'
  ];
}
