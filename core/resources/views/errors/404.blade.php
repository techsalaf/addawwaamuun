<!DOCTYPE html>
<html>
  <head>
    {{-- required meta tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- csrf-token for ajax request --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title --}}
    <title>404</title>

    {{-- fav icon --}}
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}"> --}}

    {{-- include styles --}}
    @includeIf('frontend.partials.styles')

    {{-- additional style --}}
    @yield('style')
  </head>

  <body>
    
      <!--====== 404 PART START ======-->
      <section class="error-area d-flex align-items-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="error-content">
                <span>
                  {{ __('404! Page Not Found') }}
                </span>
                <h2 class="title">{{ __('Oops! Looks Like You Are Lost in Ocean') }}</h2>
                <ul>
                  <li><a href="{{ route('index') }}">{{ __('Get Back to Home') }}</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    
        <div class="error-thumb">
          <img src="{{ asset('assets/img/error.png') }}" alt="error">
        </div>
      </section>
      <!--====== 404 PART ENDS ======-->
  </body>

</html>