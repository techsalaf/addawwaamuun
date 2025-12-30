@extends('frontend.layout')

@section('pageHeading')
  {{ __('Payment Success') }}
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => __('Success')])

  <!--====== Purchase Success Section Start ======-->
  @if ($paidVia == 'offline')
    <div class="purchase-message">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="purchase-success">
              <div class="icon text-success"><i class="far fa-check-circle"></i></div>
              <h2>{{ __('Success') . '!' }}</h2>
              <p>{{ __('Your transaction request was received and sent for review') . '.' }}</p>
              <p>{{ __('We answer every request as quickly as we can') . ', ' . __('usually within 24–48 hours') . '.' }}</p>
              <p class="mt-4">{{ __('Thank you') . '.' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    @if (empty($courseInfo->thanks_page_content))
      <div class="purchase-message">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="purchase-success">
                <div class="icon text-success"><i class="far fa-check-circle"></i></div>
                <h2>{{ __('Success') . '!' }}</h2>
                <p>{{ __('Your transaction was successful') . '.' }}</p>
                <p>{{ __('We have sent you a mail with an invoice') . '.' }}</p>
                <p class="mt-4">{{ __('Thank you') . '.' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @else
      <section class="payment-success-page-area pt-100 pb-100">
        <div class="container">
          <div class="row bg-light py-5">
            <div class="col">
              <div class="summernote-content">
                {!! replaceBaseUrl($courseInfo->thanks_page_content, 'summernote') !!}
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif
  @endif
  <!--====== Purchase Success Section End ======-->
@endsection

@section('script')
  <script type="text/javascript">
    sessionStorage.removeItem('course_id');
    sessionStorage.removeItem('new_price');
  </script>
@endsection
