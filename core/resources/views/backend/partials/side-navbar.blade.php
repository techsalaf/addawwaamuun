<div class="sidebar sidebar-style-2" data-background-color="{{ $settings->admin_theme_version == 'light' ? 'white' : 'dark2' }}">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          @if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->image != null)
            <img src="{{ asset('assets/img/admins/' . Auth::guard('admin')->user()->image) }}" alt="Admin Image" class="avatar-img rounded-circle">
          @else
            <img src="{{ asset('assets/img/blank_user.jpg') }}" alt="" class="avatar-img rounded-circle">
          @endif
        </div>

        <div class="info">
          <a data-toggle="collapse" href="#adminProfileMenu" aria-expanded="true">
            <span>
              @if (Auth::guard('admin')->check())
                {{ Auth::guard('admin')->user()->first_name }}
              @endif

              @if (is_null($roleInfo))
                <span class="user-level">{{ __('Super Admin') }}</span>
              @else
                <span class="user-level">{{ $roleInfo->name }}</span>
              @endif

              <span class="caret"></span>
            </span>
          </a>

          <div class="clearfix"></div>

          <div class="collapse in" id="adminProfileMenu">
            <ul class="nav">
              <li>
                <a href="{{ route('admin.edit_profile') }}">
                  <span class="link-collapse">{{ __('Edit Profile') }}</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.change_password') }}">
                  <span class="link-collapse">{{ __('Change Password') }}</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.logout') }}">
                  <span class="link-collapse">{{ __('Logout') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      @php
        if (!is_null($roleInfo)) {
          $rolePermissions = json_decode($roleInfo->permissions);
        }
      @endphp

      <ul class="nav nav-primary">
        {{-- search --}}
        <div class="row mb-3">
          <div class="col-12">
            <form action="">
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control sidebar-search ltr" placeholder="Search Menu Here...">
              </div>
            </form>
          </div>
        </div>

        {{-- dashboard --}}
        <li class="nav-item @if (request()->routeIs('admin.dashboard')) active @endif">
          <a href="{{ route('admin.dashboard') }}">
            <i class="la flaticon-paint-palette"></i>
            <p>{{ __('Dashboard') }}</p>
          </a>
        </li>

        {{-- menu builder --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Menu Builder', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.menu_builder')) active @endif">
            <a href="{{ route('admin.menu_builder', ['language' => $defaultLang->code]) }}">
              <i class="fal fa-bars"></i>
              <p>{{ __('Menu Builder') }}</p>
            </a>
          </li>
        @endif

        {{-- instructor --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Instructors', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.instructors')) active 
            @elseif (request()->routeIs('admin.create_instructor')) active 
            @elseif (request()->routeIs('admin.edit_instructor')) active 
            @elseif (request()->routeIs('admin.instructor.social_links')) active 
            @elseif (request()->routeIs('admin.instructor.edit_social_link')) active @endif"
          >
            <a href="{{ route('admin.instructors', ['language' => $defaultLang->code]) }}">
              <i class="fal fa-chalkboard-teacher"></i>
              <p>{{ __('Instructors') }}</p>
            </a>
          </li>
        @endif

        {{-- course --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Management', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.course_management.categories')) active 
            @elseif (request()->routeIs('admin.course_management.courses')) active 
            @elseif (request()->routeIs('admin.course_management.create_course')) active 
            @elseif (request()->routeIs('admin.course_management.edit_course')) active 
            @elseif (request()->routeIs('admin.course_management.course.faqs')) active 
            @elseif (request()->routeIs('admin.course_management.course.thanks_page')) active 
            @elseif (request()->routeIs('admin.course_management.course.certificate_settings')) active 
            @elseif (request()->routeIs('admin.course_management.course.modules')) active 
            @elseif (request()->routeIs('admin.course_management.lesson.contents')) active 
            @elseif (request()->routeIs('admin.course_management.lesson.create_quiz')) active 
            @elseif (request()->routeIs('admin.course_management.lesson.manage_quiz')) active 
            @elseif (request()->routeIs('admin.course_management.lesson.edit_quiz')) active 
            @elseif (request()->routeIs('admin.course_management.coupons')) active @endif"
          >
            <a data-toggle="collapse" href="#course">
              <i class="fal fa-book"></i>
              <p>{{ __('Courses Management') }}</p>
              <span class="caret"></span>
            </a>

            <div id="course" class="collapse 
              @if (request()->routeIs('admin.course_management.categories')) show 
              @elseif (request()->routeIs('admin.course_management.courses')) show 
              @elseif (request()->routeIs('admin.course_management.create_course')) show 
              @elseif (request()->routeIs('admin.course_management.edit_course')) show 
              @elseif (request()->routeIs('admin.course_management.course.faqs')) show 
              @elseif (request()->routeIs('admin.course_management.course.thanks_page')) show 
              @elseif (request()->routeIs('admin.course_management.course.certificate_settings')) show 
              @elseif (request()->routeIs('admin.course_management.course.modules')) show 
              @elseif (request()->routeIs('admin.course_management.lesson.contents')) show 
              @elseif (request()->routeIs('admin.course_management.lesson.create_quiz')) show 
              @elseif (request()->routeIs('admin.course_management.lesson.manage_quiz')) show 
              @elseif (request()->routeIs('admin.course_management.lesson.edit_quiz')) show 
              @elseif (request()->routeIs('admin.course_management.coupons')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.course_management.categories') ? 'active' : '' }}">
                  <a href="{{ route('admin.course_management.categories', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Categories') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.course_management.coupons') ? 'active' : '' }}">
                  <a href="{{ route('admin.course_management.coupons') }}">
                    <span class="sub-item">{{ __('Coupons') }}</span>
                  </a>
                </li>

                <li class="@if (request()->routeIs('admin.course_management.courses')) active 
                  @elseif (request()->routeIs('admin.course_management.create_course')) active 
                  @elseif (request()->routeIs('admin.course_management.edit_course')) active 
                  @elseif (request()->routeIs('admin.course_management.course.faqs')) active 
                  @elseif (request()->routeIs('admin.course_management.course.thanks_page')) active 
                  @elseif (request()->routeIs('admin.course_management.course.certificate_settings')) active 
                  @elseif (request()->routeIs('admin.course_management.course.modules')) active 
                  @elseif (request()->routeIs('admin.course_management.lesson.contents')) active 
                  @elseif (request()->routeIs('admin.course_management.lesson.create_quiz')) active 
                  @elseif (request()->routeIs('admin.course_management.lesson.manage_quiz')) active 
                  @elseif (request()->routeIs('admin.course_management.lesson.edit_quiz')) active @endif"
                >
                  <a href="{{ route('admin.course_management.courses', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Courses') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- course enrolments --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Enrolments', $rolePermissions)))
          <li class="nav-item 
          @if (request()->routeIs('admin.course_enrolments')) active 
          @elseif (request()->routeIs('admin.course_enrolment.details')) active 
          @elseif (request()->routeIs('admin.course_enrolments.report')) active @endif"
          >
            <a data-toggle="collapse" href="#enrolment">
              <i class="fal fa-users-class"></i>
              <p>{{ __('Course Enrolments') }}</p>
              <span class="caret"></span>
            </a>

            <div id="enrolment" class="collapse 
            @if (request()->routeIs('admin.course_enrolments')) show 
            @elseif (request()->routeIs('admin.course_enrolment.details')) show 
            @elseif (request()->routeIs('admin.course_enrolments.report')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.course_enrolments') && empty(request()->input('status')) ? 'active' : '' }}">
                  <a href="{{ route('admin.course_enrolments') }}">
                    <span class="sub-item">{{ __('All Enrolments') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.course_enrolments') && request()->input('status') == 'completed' ? 'active' : '' }}">
                  <a href="{{ route('admin.course_enrolments', ['status' => 'completed']) }}">
                    <span class="sub-item">{{ __('Completed Enrolments') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.course_enrolments') && request()->input('status') == 'pending' ? 'active' : '' }}">
                  <a href="{{ route('admin.course_enrolments', ['status' => 'pending']) }}">
                    <span class="sub-item">{{ __('Pending Enrolments') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.course_enrolments') && request()->input('status') == 'rejected' ? 'active' : '' }}">
                  <a href="{{ route('admin.course_enrolments', ['status' => 'rejected']) }}">
                    <span class="sub-item">{{ __('Rejected Enrolments') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.course_enrolments.report') ? 'active' : '' }}">
                  <a href="{{ route('admin.course_enrolments.report') }}">
                    <span class="sub-item">{{ __('Report') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- user --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('User Management', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.user_management.registered_users')) active 
            @elseif (request()->routeIs('admin.user_management.user_details')) active 
            @elseif (request()->routeIs('admin.user_management.user.change_password')) active 
            @elseif (request()->routeIs('admin.user_management.subscribers')) active 
            @elseif (request()->routeIs('admin.user_management.mail_for_subscribers')) active 
            @elseif (request()->routeIs('admin.user_management.push_notification.settings')) active 
            @elseif (request()->routeIs('admin.user_management.push_notification.notification_for_visitors')) active @endif"
          >
            <a data-toggle="collapse" href="#user">
              <i class="la flaticon-users"></i>
              <p>{{ __('User Management') }}</p>
              <span class="caret"></span>
            </a>

            <div id="user" class="collapse 
              @if (request()->routeIs('admin.user_management.registered_users')) show 
              @elseif (request()->routeIs('admin.user_management.user_details')) show 
              @elseif (request()->routeIs('admin.user_management.user.change_password')) show 
              @elseif (request()->routeIs('admin.user_management.subscribers')) show 
              @elseif (request()->routeIs('admin.user_management.mail_for_subscribers')) show 
              @elseif (request()->routeIs('admin.user_management.push_notification.settings')) show 
              @elseif (request()->routeIs('admin.user_management.push_notification.notification_for_visitors')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="@if (request()->routeIs('admin.user_management.registered_users')) active 
                  @elseif (request()->routeIs('admin.user_management.user_details')) active 
                  @elseif (request()->routeIs('admin.user_management.user.change_password')) active @endif"
                >
                  <a href="{{ route('admin.user_management.registered_users') }}">
                    <span class="sub-item">{{ __('Registered Users') }}</span>
                  </a>
                </li>

                <li class="@if (request()->routeIs('admin.user_management.subscribers')) active 
                  @elseif (request()->routeIs('admin.user_management.mail_for_subscribers')) active @endif"
                >
                  <a href="{{ route('admin.user_management.subscribers') }}">
                    <span class="sub-item">{{ __('Subscribers') }}</span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#push_notification">
                    <span class="sub-item">{{ __('Push Notification') }}</span>
                    <span class="caret"></span>
                  </a>

                  <div id="push_notification" class="collapse 
                    @if (request()->routeIs('admin.user_management.push_notification.settings')) show 
                    @elseif (request()->routeIs('admin.user_management.push_notification.notification_for_visitors')) show @endif"
                  >
                    <ul class="nav nav-collapse subnav">
                      <li class="{{ request()->routeIs('admin.user_management.push_notification.settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.user_management.push_notification.settings') }}">
                          <span class="sub-item">{{ __('Settings') }}</span>
                        </a>
                      </li>

                      <li class="{{ request()->routeIs('admin.user_management.push_notification.notification_for_visitors') ? 'active' : '' }}">
                        <a href="{{ route('admin.user_management.push_notification.notification_for_visitors') }}">
                          <span class="sub-item">{{ __('Send Notification') }}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- home page --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Home Page', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.home_page.hero_section')) active 
            @elseif (request()->routeIs('admin.home_page.section_titles')) active 
            @elseif (request()->routeIs('admin.home_page.action_section')) active 
            @elseif (request()->routeIs('admin.home_page.features_section')) active 
            @elseif (request()->routeIs('admin.home_page.video_section')) active 
            @elseif (request()->routeIs('admin.home_page.fun_facts_section')) active 
            @elseif (request()->routeIs('admin.home_page.testimonials_section')) active 
            @elseif (request()->routeIs('admin.home_page.newsletter_section')) active 
            @elseif (request()->routeIs('admin.home_page.about_us_section')) active 
            @elseif (request()->routeIs('admin.home_page.course_categories_section')) active 
            @elseif (request()->routeIs('admin.home_page.section_customization')) active 
            @elseif (request()->routeIs('admin.theme_v4.hero_settings')) active 
            @elseif (request()->routeIs('admin.theme_v4.search_settings')) active 
            @elseif (request()->routeIs('admin.theme_v4.cta_settings')) active 
            @elseif (request()->routeIs('admin.theme_v4.about_settings')) active @endif"
          >
            <a data-toggle="collapse" href="#home_page">
              <i class="fal fa-layer-group"></i>
              <p>{{ __('Home Page') }}</p>
              <span class="caret"></span>
            </a>

            <div id="home_page" class="collapse 
              @if (request()->routeIs('admin.home_page.hero_section')) show 
              @elseif (request()->routeIs('admin.home_page.section_titles')) show 
              @elseif (request()->routeIs('admin.home_page.action_section')) show 
              @elseif (request()->routeIs('admin.home_page.features_section')) show 
              @elseif (request()->routeIs('admin.home_page.video_section')) show 
              @elseif (request()->routeIs('admin.home_page.fun_facts_section')) show 
              @elseif (request()->routeIs('admin.home_page.testimonials_section')) show 
              @elseif (request()->routeIs('admin.home_page.newsletter_section')) show 
              @elseif (request()->routeIs('admin.home_page.about_us_section')) show 
              @elseif (request()->routeIs('admin.home_page.course_categories_section')) show 
              @elseif (request()->routeIs('admin.home_page.section_customization')) show 
              @elseif (request()->routeIs('admin.theme_v4.hero_settings')) show 
              @elseif (request()->routeIs('admin.theme_v4.search_settings')) show 
              @elseif (request()->routeIs('admin.theme_v4.cta_settings')) show 
              @elseif (request()->routeIs('admin.theme_v4.about_settings')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.home_page.hero_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.hero_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Hero Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.section_titles') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.section_titles', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Section Titles') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.action_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.action_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Call To Action Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.features_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.features_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Features Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.video_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.video_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Video Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.fun_facts_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.fun_facts_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Fun Facts Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.testimonials_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.testimonials_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Testimonials Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.newsletter_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.newsletter_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Newsletter Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.about_us_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.about_us_section', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('About Us Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.course_categories_section') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.course_categories_section') }}">
                    <span class="sub-item">{{ __('Course Categories Section') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.home_page.section_customization') ? 'active' : '' }}">
                  <a href="{{ route('admin.home_page.section_customization') }}">
                    <span class="sub-item">{{ __('Section Customization') }}</span>
                  </a>
                </li>
                <li class="submenu">
                  <a data-toggle="collapse" href="#theme_v4_settings">
                    <span class="sub-item">{{ __('Theme V4 Settings') }}</span>
                    <span class="caret"></span>
                  </a>

                  <div id="theme_v4_settings" class="collapse 
                    @if (request()->routeIs('admin.theme_v4.hero_settings')) show 
                    @elseif (request()->routeIs('admin.theme_v4.search_settings')) show 
                    @elseif (request()->routeIs('admin.theme_v4.cta_settings')) show 
                    @elseif (request()->routeIs('admin.theme_v4.about_settings')) show @endif"
                  >
                    <ul class="nav nav-collapse subnav">
                      <li class="{{ request()->routeIs('admin.theme_v4.hero_settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.theme_v4.hero_settings') }}">
                          <span class="sub-item">{{ __('Hero Section') }}</span>
                        </a>
                      </li>

                      <li class="{{ request()->routeIs('admin.theme_v4.search_settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.theme_v4.search_settings') }}">
                          <span class="sub-item">{{ __('Search Section') }}</span>
                        </a>
                      </li>

                      <li class="{{ request()->routeIs('admin.theme_v4.cta_settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.theme_v4.cta_settings') }}">
                          <span class="sub-item">{{ __('Call To Action') }}</span>
                        </a>
                      </li>

                      <li class="{{ request()->routeIs('admin.theme_v4.about_settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.theme_v4.about_settings') }}">
                          <span class="sub-item">{{ __('About Section') }}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- footer --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Footer', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.footer.content')) active 
            @elseif (request()->routeIs('admin.footer.quick_links')) active @endif"
          >
            <a data-toggle="collapse" href="#footer">
              <i class="fal fa-shoe-prints"></i>
              <p>{{ __('Footer') }}</p>
              <span class="caret"></span>
            </a>

            <div id="footer" class="collapse @if (request()->routeIs('admin.footer.content')) show 
              @elseif (request()->routeIs('admin.footer.quick_links')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.footer.content') ? 'active' : '' }}">
                  <a href="{{ route('admin.footer.content', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Content & Color') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.footer.quick_links') ? 'active' : '' }}">
                  <a href="{{ route('admin.footer.quick_links', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Quick Links') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- custom page --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Custom Pages', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.custom_pages')) active 
            @elseif (request()->routeIs('admin.custom_pages.create_page')) active 
            @elseif (request()->routeIs('admin.custom_pages.edit_page')) active @endif"
          >
            <a href="{{ route('admin.custom_pages', ['language' => $defaultLang->code]) }}">
              <i class="la flaticon-file"></i>
              <p>{{ __('Custom Pages') }}</p>
            </a>
          </li>
        @endif

        {{-- blog --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.blog_management.categories')) active 
            @elseif (request()->routeIs('admin.blog_management.blogs')) active 
            @elseif (request()->routeIs('admin.blog_management.create_blog')) active 
            @elseif (request()->routeIs('admin.blog_management.edit_blog')) active @endif"
          >
            <a data-toggle="collapse" href="#blog">
              <i class="fal fa-blog"></i>
              <p>{{ __('Blog Management') }}</p>
              <span class="caret"></span>
            </a>

            <div id="blog" class="collapse 
              @if (request()->routeIs('admin.blog_management.categories')) show 
              @elseif (request()->routeIs('admin.blog_management.blogs')) show 
              @elseif (request()->routeIs('admin.blog_management.create_blog')) show 
              @elseif (request()->routeIs('admin.blog_management.edit_blog')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.blog_management.categories') ? 'active' : '' }}">
                  <a href="{{ route('admin.blog_management.categories', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Categories') }}</span>
                  </a>
                </li>

                <li class="@if (request()->routeIs('admin.blog_management.blogs')) active 
                  @elseif (request()->routeIs('admin.blog_management.create_blog')) active 
                  @elseif (request()->routeIs('admin.blog_management.edit_blog')) active @endif"
                >
                  <a href="{{ route('admin.blog_management.blogs', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Blog') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- faq --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('FAQ Management', $rolePermissions)))
          <li class="nav-item {{ request()->routeIs('admin.faq_management') ? 'active' : '' }}">
            <a href="{{ route('admin.faq_management', ['language' => $defaultLang->code]) }}">
              <i class="la flaticon-round"></i>
              <p>{{ __('FAQ Management') }}</p>
            </a>
          </li>
        @endif

        {{-- advertise --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Advertise', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.advertise.advertisements')) active @endif"
          >
            <a href="{{ route('admin.advertise.advertisements') }}">
              <i class="fab fa-buysellads"></i>
              <p>{{ __('Ads') }}</p>
            </a>
          </li>
        @endif

        {{-- announcement popup --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Announcement Popups', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.announcement_popups')) active 
            @elseif (request()->routeIs('admin.announcement_popups.select_popup_type')) active 
            @elseif (request()->routeIs('admin.announcement_popups.create_popup')) active 
            @elseif (request()->routeIs('admin.announcement_popups.edit_popup')) active @endif"
          >
            <a href="{{ route('admin.announcement_popups', ['language' => $defaultLang->code]) }}">
              <i class="fal fa-bullhorn"></i>
              <p>{{ __('Announcement Popups') }}</p>
            </a>
          </li>
        @endif

        {{-- payment gateway --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Payment Gateways', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.payment_gateways.online_gateways')) active 
            @elseif (request()->routeIs('admin.payment_gateways.offline_gateways')) active @endif"
          >
            <a data-toggle="collapse" href="#payment_gateways">
              <i class="la flaticon-paypal"></i>
              <p>{{ __('Payment Gateways') }}</p>
              <span class="caret"></span>
            </a>

            <div id="payment_gateways" class="collapse 
              @if (request()->routeIs('admin.payment_gateways.online_gateways')) show 
              @elseif (request()->routeIs('admin.payment_gateways.offline_gateways')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.payment_gateways.online_gateways') ? 'active' : '' }}">
                  <a href="{{ route('admin.payment_gateways.online_gateways') }}">
                    <span class="sub-item">{{ __('Online Gateways') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.payment_gateways.offline_gateways') ? 'active' : '' }}">
                  <a href="{{ route('admin.payment_gateways.offline_gateways') }}">
                    <span class="sub-item">{{ __('Offline Gateways') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- basic settings --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Basic Settings', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.basic_settings.favicon')) active
            @elseif (request()->routeIs('admin.basic_settings.logo')) active
            @elseif (request()->routeIs('admin.basic_settings.information')) active
            @elseif (request()->routeIs('admin.basic_settings.theme_and_home')) active
            @elseif (request()->routeIs('admin.basic_settings.currency')) active
            @elseif (request()->routeIs('admin.basic_settings.appearance')) active
            @elseif (request()->routeIs('admin.basic_settings.mail_from_admin')) active
            @elseif (request()->routeIs('admin.basic_settings.mail_to_admin')) active
            @elseif (request()->routeIs('admin.basic_settings.mail_templates')) active
            @elseif (request()->routeIs('admin.basic_settings.edit_mail_template')) active
            @elseif (request()->routeIs('admin.basic_settings.breadcrumb')) active
            @elseif (request()->routeIs('admin.basic_settings.page_headings')) active
            @elseif (request()->routeIs('admin.basic_settings.plugins')) active
            @elseif (request()->routeIs('admin.basic_settings.seo')) active
            @elseif (request()->routeIs('admin.basic_settings.maintenance_mode')) active
            @elseif (request()->routeIs('admin.basic_settings.cookie_alert')) active
            @elseif (request()->routeIs('admin.basic_settings.footer_logo')) active 
            @elseif (request()->routeIs('admin.basic_settings.social_medias')) active @endif"
          >
            <a data-toggle="collapse" href="#basic_settings">
              <i class="la flaticon-settings"></i>
              <p>{{ __('Basic Settings') }}</p>
              <span class="caret"></span>
            </a>

            <div id="basic_settings" class="collapse 
              @if (request()->routeIs('admin.basic_settings.favicon')) show
              @elseif (request()->routeIs('admin.basic_settings.logo')) show
              @elseif (request()->routeIs('admin.basic_settings.information')) show
              @elseif (request()->routeIs('admin.basic_settings.theme_and_home')) show
              @elseif (request()->routeIs('admin.basic_settings.currency')) show
              @elseif (request()->routeIs('admin.basic_settings.appearance')) show
              @elseif (request()->routeIs('admin.basic_settings.mail_from_admin')) show
              @elseif (request()->routeIs('admin.basic_settings.mail_to_admin')) show
              @elseif (request()->routeIs('admin.basic_settings.mail_templates')) show
              @elseif (request()->routeIs('admin.basic_settings.edit_mail_template')) show
              @elseif (request()->routeIs('admin.basic_settings.breadcrumb')) show
              @elseif (request()->routeIs('admin.basic_settings.page_headings')) show
              @elseif (request()->routeIs('admin.basic_settings.plugins')) show
              @elseif (request()->routeIs('admin.basic_settings.seo')) show
              @elseif (request()->routeIs('admin.basic_settings.maintenance_mode')) show
              @elseif (request()->routeIs('admin.basic_settings.cookie_alert')) show
              @elseif (request()->routeIs('admin.basic_settings.footer_logo')) show 
              @elseif (request()->routeIs('admin.basic_settings.social_medias')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('admin.basic_settings.favicon') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.favicon') }}">
                    <span class="sub-item">{{ __('Favicon') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.logo') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.logo') }}">
                    <span class="sub-item">{{ __('Logo') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.information') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.information') }}">
                    <span class="sub-item">{{ __('Information') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.theme_and_home') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.theme_and_home') }}">
                    <span class="sub-item">{{ __('Theme & Home') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.currency') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.currency') }}">
                    <span class="sub-item">{{ __('Currency') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.appearance') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.appearance') }}">
                    <span class="sub-item">{{ __('Website Appearance') }}</span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#mail_settings">
                    <span class="sub-item">{{ __('Email Settings') }}</span>
                    <span class="caret"></span>
                  </a>

                  <div id="mail_settings" class="collapse 
                    @if (request()->routeIs('admin.basic_settings.mail_from_admin')) show 
                    @elseif (request()->routeIs('admin.basic_settings.mail_to_admin')) show
                    @elseif (request()->routeIs('admin.basic_settings.mail_templates')) show
                    @elseif (request()->routeIs('admin.basic_settings.edit_mail_template')) show @endif"
                  >
                    <ul class="nav nav-collapse subnav">
                      <li class="{{ request()->routeIs('admin.basic_settings.mail_from_admin') ? 'active' : '' }}">
                        <a href="{{ route('admin.basic_settings.mail_from_admin') }}">
                          <span class="sub-item">{{ __('Mail From Admin') }}</span>
                        </a>
                      </li>

                      <li class="{{ request()->routeIs('admin.basic_settings.mail_to_admin') ? 'active' : '' }}">
                        <a href="{{ route('admin.basic_settings.mail_to_admin') }}">
                          <span class="sub-item">{{ __('Mail To Admin') }}</span>
                        </a>
                      </li>

                      <li class="@if (request()->routeIs('admin.basic_settings.mail_templates')) active 
                        @elseif (request()->routeIs('admin.basic_settings.edit_mail_template')) active @endif"
                      >
                        <a href="{{ route('admin.basic_settings.mail_templates') }}">
                          <span class="sub-item">{{ __('Mail Templates') }}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.breadcrumb') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.breadcrumb') }}">
                    <span class="sub-item">{{ __('Breadcrumb') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.page_headings') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.page_headings', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Page Headings') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.plugins') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.plugins') }}">
                    <span class="sub-item">{{ __('Plugins') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.seo') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.seo', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('SEO Informations') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.maintenance_mode') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.maintenance_mode') }}">
                    <span class="sub-item">{{ __('Maintenance Mode') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.cookie_alert') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.cookie_alert', ['language' => $defaultLang->code]) }}">
                    <span class="sub-item">{{ __('Cookie Alert') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.footer_logo') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.footer_logo') }}">
                    <span class="sub-item">{{ __('Footer Logo') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.basic_settings.social_medias') ? 'active' : '' }}">
                  <a href="{{ route('admin.basic_settings.social_medias') }}">
                    <span class="sub-item">{{ __('Social Medias') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- admin --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Admin Management', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.admin_management.role_permissions')) active 
            @elseif (request()->routeIs('admin.admin_management.role.permissions')) active 
            @elseif (request()->routeIs('admin.admin_management.registered_admins')) active @endif"
          >
            <a data-toggle="collapse" href="#admin">
              <i class="fal fa-users-cog"></i>
              <p>{{ __('Admin Management') }}</p>
              <span class="caret"></span>
            </a>

            <div id="admin" class="collapse 
              @if (request()->routeIs('admin.admin_management.role_permissions')) show 
              @elseif (request()->routeIs('admin.admin_management.role.permissions')) show 
              @elseif (request()->routeIs('admin.admin_management.registered_admins')) show @endif"
            >
              <ul class="nav nav-collapse">
                <li class="@if (request()->routeIs('admin.admin_management.role_permissions')) active 
                  @elseif (request()->routeIs('admin.admin_management.role.permissions')) active @endif"
                >
                  <a href="{{ route('admin.admin_management.role_permissions') }}">
                    <span class="sub-item">{{ __('Role & Permissions') }}</span>
                  </a>
                </li>

                <li class="{{ request()->routeIs('admin.admin_management.registered_admins') ? 'active' : '' }}">
                  <a href="{{ route('admin.admin_management.registered_admins') }}">
                    <span class="sub-item">{{ __('Registered Admins') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        {{-- language --}}
        @if (is_null($roleInfo) || (!empty($rolePermissions) && in_array('Language Management', $rolePermissions)))
          <li class="nav-item @if (request()->routeIs('admin.language_management')) active 
            @elseif (request()->routeIs('admin.language_management.edit_keyword')) active @endif"
          >
            <a href="{{ route('admin.language_management') }}">
              <i class="fal fa-language"></i>
              <p>{{ __('Language Management') }}</p>
            </a>
          </li>
        @endif

      </ul>
    </div>
  </div>
</div>
