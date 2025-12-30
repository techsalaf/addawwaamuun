@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->login_page_title ?? 'Login' }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_login }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_login }}
  @endif
@endsection

@section('content')
  @if ($basicInfo->theme_version == 4)
    <!-- ============ V4 LOGIN SECTION ============ -->
    <section class="auth-section-v4 py-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8">
            <div class="auth-card-v4" data-animation="fade-up">
              <div class="auth-header-v4 mb-4 text-center">
                <h2 class="mb-2">{{ $pageHeading->login_page_title ?? 'Welcome Back' }}</h2>
                <p>{{ __('Please enter your credentials to access your account') }}</p>
              </div>

              <div class="auth-form-v4">
                <form action="{{ route('user.login_submit') }}" method="POST">
                  @csrf
                  <div class="form_group mb-3">
                    <label class="mb-2">{{ __('Email Address') }}</label>
                    <div class="input-with-icon">
                      <i class="fal fa-envelope"></i>
                      <input type="email" class="form_control" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}">
                    </div>
                    @error('email')
                      <p class="text-danger mt-1 small">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form_group mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <label>{{ __('Password') }}</label>
                      <a href="{{ route('user.forget_password') }}" class="forgot-link small">{{ __('Forgot Password?') }}</a>
                    </div>
                    <div class="input-with-icon">
                      <i class="fal fa-lock"></i>
                      <input type="password" class="form_control" name="password" placeholder="{{ __('Enter your password') }}">
                    </div>
                    @error('password')
                      <p class="text-danger mt-1 small">{{ $message }}</p>
                    @enderror
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
                      <span>{{ __('Login Now') }}</span>
                      <i class="fal fa-sign-in-alt"></i>
                    </button>
                  </div>
                </form>

                <div class="auth-footer-v4 mt-4 text-center">
                  <p>{{ __("Don't have an account?") }} <a href="{{ route('user.signup') }}" class="text-primary font-weight-bold">{{ __('Sign Up Free') }}</a></p>
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
      .forgot-link {
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
      }
      .forgot-link:hover {
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
    </style>
  @else
    @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->login_page_title ?? 'Login'])

    <!--====== User Login Part Start ======-->
    <div class="user-area-section pt-120 pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="user-form">
              <form action="{{ route('user.login_submit') }}" method="POST">
                @csrf
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
                    <p class="text-danger mb-4">{{ $message }}</p>
                  @enderror
                </div>

                @if ($recaptchaInfo->google_recaptcha_status == 1)
                  <div class="form_group mt-2 mb-4">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}

                    @error('g-recaptcha-response')
                      <p class="mt-3 text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                @endif

                <div class="form_group d-flex justify-content-between align-items-center">
                  <button type="submit" class="main-btn">{{ __('Login') }}</button>
                  <a href="{{ route('user.forget_password') }}">{{ __('Lost your password') . '?' }}</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--====== User Login Part End ======-->
  @endif
@endsection
