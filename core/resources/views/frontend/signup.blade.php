@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->signup_page_title ?? 'Sign Up' }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_signup }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_signup }}
  @endif
@endsection

@section('content')
  @if ($basicInfo->theme_version == 4)
    <!-- ============ V4 SIGNUP SECTION ============ -->
    <section class="auth-section-v4 py-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-10">
            <div class="auth-card-v4" data-animation="fade-up">
              <div class="auth-header-v4 mb-4 text-center">
                <h2 class="mb-2">{{ $pageHeading->signup_page_title ?? 'Create Account' }}</h2>
                <p>{{ __('Join our community and start your learning journey today') }}</p>
              </div>

              <div class="auth-form-v4">
                <form action="{{ route('user.signup_submit') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form_group mb-3">
                        <label class="mb-2">{{ __('Username') }}</label>
                        <div class="input-with-icon">
                          <i class="fal fa-user"></i>
                          <input type="text" class="form_control" name="username" value="{{ old('username') }}" placeholder="{{ __('Your username') }}">
                        </div>
                        @error('username')
                          <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form_group mb-3">
                        <label class="mb-2">{{ __('Email Address') }}</label>
                        <div class="input-with-icon">
                          <i class="fal fa-envelope"></i>
                          <input type="email" class="form_control" name="email" value="{{ old('email') }}" placeholder="{{ __('Your email') }}">
                        </div>
                        @error('email')
                          <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form_group mb-3">
                        <label class="mb-2">{{ __('Password') }}</label>
                        <div class="input-with-icon">
                          <i class="fal fa-lock"></i>
                          <input type="password" class="form_control" name="password" placeholder="{{ __('Create password') }}">
                        </div>
                        @error('password')
                          <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form_group mb-3">
                        <label class="mb-2">{{ __('Confirm Password') }}</label>
                        <div class="input-with-icon">
                          <i class="fal fa-shield-check"></i>
                          <input type="password" class="form_control" name="password_confirmation" placeholder="{{ __('Repeat password') }}">
                        </div>
                        @error('password_confirmation')
                          <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                  </div>

                  @if ($recaptchaInfo->google_recaptcha_status == 1)
                    <div class="form_group mt-4 mb-4 d-flex justify-content-center">
                      {!! NoCaptcha::renderJs() !!}
                      {!! NoCaptcha::display() !!}
                    </div>
                    @error('g-recaptcha-response')
                      <p class="text-danger mt-1 small text-center">{{ $message }}</p>
                    @enderror
                  @endif

                  <div class="form_group mt-4">
                    <button type="submit" class="btn btn-primary w-100 justify-content-center">
                      <span>{{ __('Register Now') }}</span>
                      <i class="fal fa-user-plus"></i>
                    </button>
                  </div>
                </form>

                <div class="auth-footer-v4 mt-4 text-center">
                  <p>{{ __("Already have an account?") }} <a href="{{ route('user.login') }}" class="text-primary font-weight-bold">{{ __('Login Here') }}</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <style>
      .auth-section-v4 {
        background: var(--bg-secondary);
        position: relative;
        overflow: hidden;
      }
      .auth-section-v4::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(24, 102, 212, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      .auth-section-v4::after {
        content: '';
        position: absolute;
        bottom: -10%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(88, 12, 227, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      .auth-card-v4 {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-xl);
        position: relative;
        z-index: 1;
        border: 1px solid var(--border);
      }
      .auth-header-v4 h2 {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .input-with-icon {
        position: relative;
      }
      .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        transition: var(--transition);
      }
      .input-with-icon .form_control {
        padding-left: 45px;
        height: 55px;
        border-radius: 10px;
        border: 1.5px solid var(--border);
        transition: var(--transition);
      }
      .input-with-icon .form_control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(24, 102, 212, 0.1);
      }
      .input-with-icon .form_control:focus + i {
        color: var(--primary);
      }
      .btn-primary {
        height: 55px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        box-shadow: 0 4px 15px rgba(24, 102, 212, 0.3);
      }
      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(24, 102, 212, 0.4);
      }
      @media (max-width: 576px) {
        .auth-card-v4 {
          padding: 25px 15px;
        }
      }
    </style>
  @else
    @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->signup_page_title ?? 'Sign Up'])

    <!--====== User Signup Part Start ======-->
    <div class="user-area-section pt-120 pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="user-form">
              <form action="{{ route('user.signup_submit') }}" method="POST">
                @csrf
                <div class="form_group">
                  <label>{{ __('Username') . '*' }}</label>
                  <input type="text" class="form_control" name="username" value="{{ old('username') }}">
                  @error('username')
                    <p class="text-danger mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form_group">
                  <label>{{ __('Email Address') . '*' }}</label>
                  <input type="email" class="form_control" name="email" value="{{ old('email') }}">
                  @error('email')
                    <p class="text-danger mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form_group">
                  <label>{{ __('Password') . '*' }}</label>
                  <input type="password" class="form_control" name="password" value="{{ old('password') }}">
                  @error('password')
                    <p class="text-danger mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form_group">
                  <label>{{ __('Confirm Password') . '*' }}</label>
                  <input type="password" class="form_control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                  @error('password_confirmation')
                    <p class="text-danger mb-3">{{ $message }}</p>
                  @enderror
                </div>

                @if ($recaptchaInfo->google_recaptcha_status == 1)
                  <div class="form_group mt-2 mb-4">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}

                    @error('g-recaptcha-response')
                      <p class="text-danger mt-3">{{ $message }}</p>
                    @enderror
                  </div>
                @endif

                <div class="form_group">
                  <button type="submit" class="main-btn">{{ __('Signup') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--====== User Signup Part End ======-->
  @endif
@endsection
