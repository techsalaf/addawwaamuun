<div class="header-v4-wrapper">
  <div class="container">
    <div class="header-v4-content">
      <div class="header-v4-logo">
        @if (!is_null($websiteInfo))
          <a href="{{ route('index') }}" class="logo-link">
            <img data-src="{{ asset('assets/img/' . $websiteInfo->logo) }}" class="lazy" alt="website logo">
          </a>
        @endif
      </div>

      <nav class="header-v4-nav">
        <ul class="nav-menu-v4">
          @php $menuDatas = json_decode($menuInfos); @endphp

          @foreach ($menuDatas as $menuData)
            @php $href = get_href($menuData); @endphp

            @if (!property_exists($menuData, 'children'))
              <li class="nav-item-v4">
                <a href="{{ $href }}" class="nav-link-v4">{{ $menuData->text }}</a>
              </li>
            @else
              <li class="nav-item-v4 nav-item-dropdown-v4">
                <a href="{{ $href }}" class="nav-link-v4">
                  {{ $menuData->text }} <i class="fal fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu-v4">
                  @php $childMenuDatas = $menuData->children; @endphp
                  @foreach ($childMenuDatas as $childMenuData)
                    @php $child_href = get_href($childMenuData); @endphp
                    <li>
                      <a href="{{ $child_href }}">{{ $childMenuData->text }}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
            @endif
          @endforeach
        </ul>

        <button class="nav-toggle-v4">
          <span></span><span></span><span></span>
        </button>
      </nav>

      <div class="header-v4-actions">
        <div class="language-selector-v4">
          <form action="{{ route('change_language') }}" method="GET">
            <select class="lang-select-v4" name="lang_code" onchange="this.form.submit()">
              @foreach ($allLanguageInfos as $languageInfo)
                <option value="{{ $languageInfo->code }}"
                  {{ $languageInfo->code == $currentLanguageInfo->code ? 'selected' : '' }}>
                  {{ $languageInfo->name }}
                </option>
              @endforeach
            </select>
          </form>
        </div>

        <div class="auth-buttons-v4">
          @guest('web')
            <a href="{{ route('user.login') }}" class="btn-auth-v4 btn-login-v4" title="Login">
              <i class="fal fa-sign-in-alt"></i>
            </a>
            <a href="{{ route('user.signup') }}" class="btn-auth-v4 btn-signup-v4" title="Sign Up">
              <i class="fal fa-user-plus"></i>
            </a>
          @endguest

          @auth('web')
            @php $authUserInfo = Auth::guard('web')->user(); @endphp
            <div class="user-menu-v4">
              <button class="user-button-v4">{{ $authUserInfo->username }}</button>
              <ul class="user-dropdown-v4">
                <li>
                  <a href="{{ route('user.dashboard') }}">
                    <i class="fal fa-user"></i> Dashboard
                  </a>
                </li>
                <li>
                  <a href="{{ route('user.logout') }}">
                    <i class="fal fa-sign-out-alt"></i> Logout
                  </a>
                </li>
              </ul>
            </div>
          @endauth
        </div>

        @if (count($socialMediaInfos) > 0)
          <div class="social-icons-v4">
            <ul>
              @foreach ($socialMediaInfos as $socialMediaInfo)
                <li>
                  <a href="{{ $socialMediaInfo->url }}" target="_blank">
                    <i class="{{ $socialMediaInfo->icon }}"></i>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>
  <div class="mobile-menu-overlay-v4"></div>
</div>
