@extends('frontend.layout')

@section('pageHeading')
  {{ __('Reset Password') }}
@endsection

@section('content')
  @if ($basicInfo->theme_version == 4)
    <!-- ============ V4 RESET PASSWORD SECTION ============ -->
    <section class="auth-section-v4 py-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8">
            <div class="auth-card-v4" data-animation="fade-up">
              <div class="auth-header-v4 mb-4 text-center">
                <h2 class="mb-2">{{ __('Reset Password') }}</h2>
                <p>{{ __('Please enter your new password below') }}</p>
              </div>

              <div class="auth-form-v4">
                <form action="{{ route('user.reset_password_submit') }}" method="POST">
                  @csrf
                  <div class="form_group mb-3">
                    <label class="mb-2">{{ __('New Password') }}</label>
                    <div class="input-with-icon">
                      <i class="fal fa-lock"></i>
                      <input type="password" class="form_control" name="new_password" placeholder="{{ __('Enter new password') }}">
                    </div>
                    @error('new_password')
                      <p class="text-danger mt-1 small">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form_group mb-4">
                    <label class="mb-2">{{ __('Confirm New Password') }}</label>
                    <div class="input-with-icon">
                      <i class="fal fa-shield-check"></i>
                      <input type="password" class="form_control" name="new_password_confirmation" placeholder="{{ __('Repeat new password') }}">
                    </div>
                    @error('new_password_confirmation')
                      <p class="text-danger mt-1 small">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form_group mt-4">
                    <button type="submit" class="btn btn-primary w-100 justify-content-center">
                      <span>{{ __('Update Password') }}</span>
                      <i class="fal fa-check-circle"></i>
                    </button>
                  </div>
                </form>
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
    </style>
  @else
    @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => __('Reset Password')])

    <!--====== Reset Password Part Start ======-->
    <div class="user-area-section pt-120 pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="user-form">
              <form action="{{ route('user.reset_password_submit') }}" method="POST">
                @csrf
                <div class="form_group">
                  <label>{{ __('New Password') . '*' }}</label>
                  <input type="password" class="form_control" name="new_password">
                  @error('new_password')
                    <p class="text-danger mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form_group">
                  <label>{{ __('Confirm New Password') . '*' }}</label>
                  <input type="password" class="form_control" name="new_password_confirmation">
                  @error('new_password_confirmation')
                    <p class="text-danger mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form_group">
                  <button type="submit" class="main-btn">{{ __('Submit') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--====== Reset Password Part End ======-->
  @endif
@endsection
