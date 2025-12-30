{{-- animate css --}}
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">

{{-- fontawesome css --}}
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

{{-- flaticon css --}}
<link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">

{{-- bootstrap css --}}
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

{{-- magnific-popup css --}}
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

{{-- owl-carousel css --}}
<link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.min.css') }}">

{{-- nice-select css --}}
<link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">

{{-- slick css --}}
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

{{-- toastr css --}}
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">

{{-- datatables css --}}
<link rel="stylesheet" href="{{ asset('assets/css/datatables-1.10.23.min.css') }}">

{{-- datatables bootstrap css --}}
<link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap4.min.css') }}">

{{-- monokai css --}}
<link rel="stylesheet" href="{{ asset('assets/css/monokai-sublime.css') }}">

{{-- jQuery-ui css --}}
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">

@if (request()->routeIs('user.my_course.curriculum'))
  {{-- video css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/video.min.css') }}">
@endif

{{-- default css --}}
<link rel="stylesheet" href="{{ asset('assets/css/default.min.css') }}">

{{-- main css --}}
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

{{-- responsive css --}}
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

{{-- mega-menu css --}}
<link rel="stylesheet" href="{{ asset('assets/css/mega-menu.css') }}">

@if ($currentLanguageInfo->direction == 1)
  {{-- right-to-left css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">

  {{-- right-to-left-responsive css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/rtl-responsive.css') }}">
@endif

@php
  $primaryColor = '2079FF';

  if (!empty($basicInfo->primary_color)) {
    $primaryColor = $basicInfo->primary_color;
  }

  $secondaryColor = 'F16001';

  if (!empty($basicInfo->secondary_color)) {
    $secondaryColor = $basicInfo->secondary_color;
  }

  $footerBackgroundColor = '001B61';

  if (!empty($footerInfo->footer_background_color)) {
    $footerBackgroundColor = $footerInfo->footer_background_color;
  }

  $copyrightBackgroundColor = '003A91';

  if (!empty($footerInfo->copyright_background_color)) {
    $copyrightBackgroundColor = $footerInfo->copyright_background_color;
  }

  $breadcrumbOverlayColor = '001B61';

  if (!empty($basicInfo->breadcrumb_overlay_color)) {
    $breadcrumbOverlayColor = $basicInfo->breadcrumb_overlay_color;
  }

  $breadcrumbOverlayOpacity = 0.5;

  if (!empty($basicInfo->breadcrumb_overlay_opacity)) {
    $breadcrumbOverlayOpacity = $basicInfo->breadcrumb_overlay_opacity;
  }
@endphp

{{-- website-color css using a php file --}}
<link rel="stylesheet" href="{{ asset("assets/css/website-color.php?primary_color=$primaryColor&secondary_color=$secondaryColor&footer_background_color=$footerBackgroundColor&copyright_background_color=$copyrightBackgroundColor&breadcrumb_overlay_color=$breadcrumbOverlayColor&breadcrumb_overlay_opacity=$breadcrumbOverlayOpacity") }}">

@if ($basicInfo->theme_version == 4)
  <link rel="stylesheet" href="{{ asset('assets/css/theme-v4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/header-footer-v4.css') }}">
@endif
