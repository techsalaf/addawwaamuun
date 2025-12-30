<!DOCTYPE html>
<html>
  <head>
    {{-- required meta tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- title --}}
    <title>{{ __('Forget Password') . ' | ' . $websiteInfo->website_title }}</title>

    {{-- fav icon --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}">

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    {{-- fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <style>
      :root {
        --primary: #1866d4;
        --secondary: #580ce3;
        --text-dark: #0f172a;
        --text-secondary: #64748b;
        --text-light: #94a3b8;
        --border: #e2e8f0;
        --shadow-xl: 0 20px 50px -15px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      body {
        background: #f8fafc;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        position: relative;
        overflow: hidden;
      }
      body::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(24, 102, 212, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      body::after {
        content: '';
        position: absolute;
        bottom: -10%;
        left: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(88, 12, 227, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      .login-container {
        width: 100%;
        max-width: 450px;
        padding: 20px;
        position: relative;
        z-index: 1;
      }
      .auth-card {
        background: #fff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: var(--shadow-xl);
        border: 1px solid var(--border);
      }
      .login-logo {
        max-width: 180px;
        margin-bottom: 30px;
      }
      .auth-header h2 {
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 10px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .auth-header p {
        color: var(--text-secondary);
        font-size: 15px;
        margin-bottom: 30px;
      }
      .form_group {
        margin-bottom: 20px;
      }
      .form_group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
      }
      .input-with-icon {
        position: relative;
      }
      .input-with-icon i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        transition: var(--transition);
      }
      .form_control {
        width: 100%;
        height: 55px;
        padding: 10px 20px 10px 50px;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        background: #fff;
        font-size: 15px;
        transition: var(--transition);
        outline: none;
      }
      .form_control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(24, 102, 212, 0.1);
      }
      .form_control:focus + i {
        color: var(--primary);
      }
      .btn-login {
        width: 100%;
        height: 55px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 20px rgba(24, 102, 212, 0.2);
      }
      .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(24, 102, 212, 0.3);
      }
      .back-link {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: var(--text-secondary);
        font-size: 14px;
        text-decoration: none;
        transition: var(--transition);
      }
      .back-link:hover {
        color: var(--primary);
      }
    </style>
  </head>

  <body>
    <div class="login-container">
      <div class="auth-card">
        @if (!empty($websiteInfo->logo))
          <div class="text-center">
            <img class="login-logo" src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="logo">
          </div>
        @endif

        <div class="auth-header text-center">
          <h2>{{ __('Forget Password') }}</h2>
          <p>{{ __('Enter your registered email and we will send you a new password') }}</p>
        </div>

        <form action="{{ route('admin.mail_for_forget_password') }}" method="POST">
          @csrf
          <div class="form_group">
            <label>{{ __('Email Address') }}</label>
            <div class="input-with-icon">
              <input type="email" name="email" class="form_control" placeholder="{{ __('Enter Your Email') }}" value="{{ old('email') }}" required>
              <i class="fal fa-envelope"></i>
            </div>
            @if ($errors->has('email'))
              <p class="text-danger mt-1 small">{{ $errors->first('email') }}</p>
            @endif
          </div>

          <button type="submit" class="btn-login">
            <span>{{ __('Send New Password') }}</span>
            <i class="fal fa-paper-plane"></i>
          </button>
        </form>

        <a class="back-link" href="{{ route('admin.login') }}">
          <i class="fal fa-arrow-left mr-1"></i> {{ __('Back to Login') }}
        </a>
      </div>
    </div>

    {{-- jQuery --}}
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    {{-- popper js --}}
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    {{-- bootstrap js --}}
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    {{-- bootstrap notify --}}
    <script src="{{ asset('assets/js/bootstrap-notify.min.js') }}"></script>

    @if (session()->has('success'))
      <script>
        "use strict";
        $.notify({
          title: 'Success',
          message: '{{ session('success') }}',
          icon: 'fa fa-check-circle'
        }, {
          type: 'success',
          placement: { from: 'top', align: 'right' },
          time: 1000,
          delay: 4000
        });
      </script>
    @endif

    @if (session()->has('warning'))
      <script>
        "use strict";
        $.notify({
          title: 'Warning!',
          message: '{{ session('warning') }}',
          icon: 'fa fa-exclamation-triangle'
        }, {
          type: 'warning',
          placement: { from: 'top', align: 'right' },
          time: 1000,
          delay: 4000
        });
      </script>
    @endif
  </body>
</html>
