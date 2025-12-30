<!DOCTYPE html>
<html lang="{{ $currentLanguageInfo->code }}" @if ($currentLanguageInfo->direction == 1) dir="rtl" @endif>
  <head>
    {{-- required meta tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- csrf-token for ajax request --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title --}}
    <title>@yield('pageHeading') {{ '| ' . config('app.name') }}</title>

    <meta name="keywords" content="@yield('metaKeywords')">
    <meta name="description" content="@yield('metaDescription')">

    {{-- fav icon --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/' . ($websiteInfo->favicon ?? 'favicon.png')) }}">

    {{-- include styles --}}
    @includeIf('frontend.partials.styles')

    {{-- additional style --}}
    @yield('style')
  </head>

  <body>
    {{-- preloader start --}}
    @if ($basicInfo->theme_version == 4)
      @includeIf('frontend.partials.preloader-v4')
    @else
      <div id="preloader">
        <div id="status">
          <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
          </div>
        </div>
      </div>
    @endif
    {{-- preloader end --}}

    {{-- header start --}}
    @if (!request()->routeIs('user.my_course.curriculum'))
      @if ($basicInfo->theme_version == 1)
        <header class="header-area header-area-one">
          {{-- include header-top --}}
          @includeIf('frontend.partials.header.header-top-v1')

          {{-- include header-nav --}}
          @includeIf('frontend.partials.header.header-nav-v1')
        </header>
      @elseif ($basicInfo->theme_version == 2)
        <header class="header-area header-area-two">
          {{-- include header-nav --}}
          @includeIf('frontend.partials.header.header-nav-v2')
        </header>
      @elseif ($basicInfo->theme_version == 4)
        <header class="header-area header-area-v4">
          {{-- include header-nav-v4 --}}
          @includeIf('frontend.partials.header.header-nav-v4')
        </header>
      @else
        <header class="header-area header-area-three">
          {{-- include header-top --}}
          @includeIf('frontend.partials.header.header-top-v3')

          {{-- include header-nav --}}
          @includeIf('frontend.partials.header.header-nav-v3')
        </header>
      @endif
    @endif
    {{-- header end --}}

    @yield('content')

    {{-- back to top start --}}
    <div class="back-to-top">
      <a href="#">
        <i class="fal fa-chevron-double-up"></i>
      </a>
    </div>
    {{-- back to top end --}}

    {{-- announcement popup --}}
    @includeIf('frontend.partials.popups')

    {{-- cookie alert --}}
    @if (!is_null($cookieAlertInfo) && $cookieAlertInfo->cookie_alert_status == 1)
      @includeIf('cookieConsent::index')
    @endif

    {{-- include footer --}}
    @if (!request()->routeIs('user.my_course.curriculum'))
      @if ($basicInfo->theme_version == 1 || $basicInfo->theme_version == 3)
        @includeIf('frontend.partials.footer.footer')
      @elseif ($basicInfo->theme_version == 4)
        @includeIf('frontend.partials.footer.footer-v4')
      @else
        @includeIf('frontend.partials.footer.footer-v2')
      @endif
    @endif

    {{-- include scripts --}}
    @includeIf('frontend.partials.scripts')

    {{-- additional script --}}
    @yield('script')
  </body>
</html>
