<div class="container">
  <div class="header-navigation">
    <div class="site-menu d-flex align-items-center justify-content-between">
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

        <!-- Navbar Toggler -->
        <div class="navbar-toggler">
          <span></span><span></span><span></span>
        </div>
      </div>

      @if (count($socialMediaInfos) > 0)
        <div class="navbar-item float-right">
          <div class="menu-icon">
            <ul>
              @foreach ($socialMediaInfos as $socialMediaInfo)
                <li><a href="{{ $socialMediaInfo->url }}"><i class="{{ $socialMediaInfo->icon }}"></i></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
