<div class="header-top">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-7 col-sm-5">
        <div class="header-logo d-flex align-items-center justify-content-center justify-content-sm-start">
          <div class="logo">
            @if (!is_null($websiteInfo))
              <a href="{{ route('index') }}">
                <img data-src="{{ asset('assets/img/' . $websiteInfo->logo) }}" class="lazy" alt="website logo">
              </a>
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-5 col-sm-7">
        <div class="header-btns d-flex align-items-center justify-content-center justify-content-sm-end">

          <div class="menu-btns">
            <ul>
              @guest('web')
                <li><a href="{{ route('user.login') }}"><i class="fal fa-sign-in-alt"></i> {{ __('Login') }}</a></li>
                <li><a href="{{ route('user.signup') }}"><i class="fal fa-user-plus"></i> {{ __('Signup') }}</a></li>
              @endguest

              @auth('web')
                @php $authUserInfo = Auth::guard('web')->user(); @endphp

                <li><a href="{{ route('user.dashboard') }}"><i class="fal fa-user"></i> {{ $authUserInfo->username }}</a></li>
                <li><a href="{{ route('user.logout') }}"><i class="fal fa-sign-out-alt"></i> {{ __('Logout') }}</a></li>
              @endauth
            </ul>
          </div>

          <div class="menu-dropdown">
            <form action="{{ route('change_language') }}" method="GET">
              <select class="wide" name="lang_code" onchange="this.form.submit()">
                @foreach ($allLanguageInfos as $languageInfo)
                  <option value="{{ $languageInfo->code }}" {{ $languageInfo->code == $currentLanguageInfo->code ? 'selected' : '' }}>
                    {{ $languageInfo->name }}
                  </option>
                @endforeach
              </select>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
