<div class="header-navigation">
  <div class="container-fluid">
    <div class="site-menu d-flex align-items-center justify-content-between">
      <div class="logo">
        @if (!is_null($websiteInfo))
          <a href="{{ route('index') }}">
            <img data-src="{{ asset('assets/img/' . $websiteInfo->logo) }}" class="lazy" alt="website logo">
          </a>
        @endif
      </div>

      <div class="primary-menu">
        <div class="nav-menu">
          <!-- Navbar Close Icon -->
          <div class="navbar-close">
            <div class="cross-wrap"><i class="far fa-times"></i></div>
          </div>

          <!-- Nav Menu -->
          <nav class="main-menu">
            <ul>
              @php $menuDatas = json_decode($menuInfos); @endphp

              @foreach ($menuDatas as $menuData)
                @php $href = get_href($menuData); @endphp

                @if (!property_exists($menuData, 'children'))
                  <li class="menu-item">
                    <a href="{{ $href }}">{{ $menuData->text }}</a>
                  </li>
                @else
                  <li class="menu-item menu-item-has-children">
                    <a class="page-scroll" href="{{ $href }}">{{ $menuData->text }}</a>
                    <ul class="sub-menu">
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
          </nav>
        </div>
      </div>

      <div class="navbar-item d-flex align-items-center justify-content-between">
        <div class="menu-btns">
          <ul>
            @guest('web')
              <li><a href="{{ route('user.login') }}"><i class="fal fa-sign-in-alt"></i> <span>{{ __('Login') }}</span></a></li>
              <li><a href="{{ route('user.signup') }}"><i class="fal fa-user-plus"></i> <span>{{ __('Signup') }}</span></a></li>
            @endguest

            @auth('web')
              @php $authUserInfo = Auth::guard('web')->user(); @endphp

              <li><a href="{{ route('user.dashboard') }}"><i class="fal fa-user"></i> <span>{{ $authUserInfo->username }}</span></a></li>
              <li><a href="{{ route('user.logout') }}"><i class="fal fa-sign-out-alt"></i> <span>{{ __('Logout') }}</span></a></li>
            @endauth

            <li>
              <div class="navbar-toggler">
                <span></span><span></span><span></span>
              </div>
            </li>
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
