@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->contact_page_title ?? 'Contact Us' }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_contact }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_contact }}
  @endif
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->contact_page_title ?? 'Contact Us'])

  <!--====== CONTACT INFO PART START ======-->
  <section class="contact-info-area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col">
          <div class="contact-info-content">
            <div class="single-contact-info">
              <div class="info-icon">
                <i class="fal fa-phone"></i>
              </div>
              <div class="info-contact">
                <h4 class="title">{{ __('Phone Number') }}</h4>
                <span>{{ !empty($info->contact_number) ? $info->contact_number : '' }}</span>
              </div>
            </div>

            <div class="single-contact-info item-2 d-flex align-items-center">
              <div class="info-icon">
                <i class="fal fa-envelope"></i>
              </div>
              <div class="info-contact">
                <h4 class="title">{{ __('Email Address') }}</h4>
                <span>{{ !empty($info->email_address) ? $info->email_address : '' }}</span>
              </div>
            </div>

            <div class="single-contact-info item-3 d-flex align-items-center">
              <div class="info-icon">
                <i class="fal fa-map-marker-alt"></i>
              </div>
              <div class="info-contact">
                <h4 class="title">{{ __('Location') }}</h4>
                <span>{{ !empty($info->address) ? $info->address : '' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== CONTACT INFO PART END ======-->

  <!--====== CONTACT ACTION PART START ======-->
  <section class="contact-action-area pt-0 pb-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="contact-action-item">
            <h2 class="title">{{ __('Get In Touch') }}</h2>
            <form action="{{ route('contact.send_mail') }}" method="post">
              @csrf
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-box mt-20">
                    <input name="name" type="text" placeholder="{{ __('Enter Your Full Name') }}">
                    <i class="fal fa-user"></i>
                  </div>
                  @error('name')
                    <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-lg-6">
                  <div class="input-box mt-20">
                    <input name="email" type="email" placeholder="{{ __('Enter Your Email') }}">
                    <i class="fal fa-envelope"></i>
                  </div>
                  @error('email')
                    <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <div class="input-box mt-20">
                <input name="subject" type="text" placeholder="{{ __('Enter Email Subject') }}">
                <i class="fal fa-edit"></i>
              </div>
              @error('subject')
                <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
              @enderror

              <div class="input-box mt-20">
                <textarea name="message" cols="30" rows="10" placeholder="{{ __('Write Your Message') }}"></textarea>
                <i class="fal fa-edit"></i>
              </div>
              @error('message')
                <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
              @enderror

              @if ($info->google_recaptcha_status == 1)
                <div class="mt-20">
                  {!! NoCaptcha::renderJs() !!}
                  {!! NoCaptcha::display() !!}
                </div>
                @error('g-recaptcha-response')
                  <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                @enderror
              @endif

              <button class="contact-form-btn" type="submit">{{ __('Send') }}</button>
            </form>
          </div>
        </div>

        <div class="col-lg-6">
          @if (!empty($info->latitude) && !empty($info->longitude))
            <div class="map">
              <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $info->latitude }},%20{{ $info->longitude }}+({{ $websiteInfo->website_title }})&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
          @endif
        </div>
      </div>

      @if (!empty(showAd(3)))
        <div class="text-center mt-30">
          {!! showAd(3) !!}
        </div>
      @endif
    </div>
  </section>
  <!--====== CONTACT ACTION PART END ======-->
@endsection
