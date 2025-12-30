<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- required meta tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- title --}}
    <title>Certificate {{ '| ' . config('app.name') }}</title>

    {{-- fav icon --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}">

    {{-- fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/certificate.css') }}">

  </head>

  <body>
    <div class="container" id="certificate-container">
      <div class="certificate-main" id="course-certificate">
        <div class="certificate-wrapper text-center" style="background-image: url({{ asset('assets/img/banner.jpg') }});">
          <div class="certificate-top-content text-center">
            <img src="{{ asset('assets/img/design-01.png') }}" class="img-1" alt="design">
            <h1>{{ $certificateTitle }}</h1>
            <img src="{{ asset('assets/img/design-02.png') }}" class="img-2" alt="design">
          </div>
  
          <div class="main-content">
            <p>{!! nl2br($certificateText) !!}</p>
          </div>
  
          <div class="user-box">
            <h4>{{ $instructorInfo->name }}</h4>
            <h5>{{ $instructorInfo->name . ', ' . $instructorInfo->occupation }}</h5>
          </div>
  
          <div class="bottom-shape">
            <img src="{{ asset('assets/img/design-02.png') }}" alt="design">
          </div>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button class="btn btn-primary" id="print-btn"><i class="far fa-print"></i> {{ __('Print') }}</button>
    </div>

    <script type="text/javascript" src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/printThis.min.js') }}"></script>

    <script>
      $(document).ready(function () {
        'use strict';

        $('#print-btn').on('click', function () {
          $('#course-certificate').printThis({
            importCSS: true,
            importStyle: true,
            loadCSS: "{{ asset('assets/css/certificate.css') }}"
          });
        })
      });
    </script>
  </body>
</html>
