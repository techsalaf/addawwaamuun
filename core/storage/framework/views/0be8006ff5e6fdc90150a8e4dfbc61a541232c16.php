<div class="sidebar sidebar-style-2" data-background-color="<?php echo e($settings->admin_theme_version == 'light' ? 'white' : 'dark2'); ?>">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <?php if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->image != null): ?>
            <img src="<?php echo e(asset('assets/img/admins/' . Auth::guard('admin')->user()->image)); ?>" alt="Admin Image" class="avatar-img rounded-circle">
          <?php else: ?>
            <img src="<?php echo e(asset('assets/img/blank_user.jpg')); ?>" alt="" class="avatar-img rounded-circle">
          <?php endif; ?>
        </div>

        <div class="info">
          <a data-toggle="collapse" href="#adminProfileMenu" aria-expanded="true">
            <span>
              <?php if(Auth::guard('admin')->check()): ?>
                <?php echo e(Auth::guard('admin')->user()->first_name); ?>

              <?php endif; ?>

              <?php if(is_null($roleInfo)): ?>
                <span class="user-level"><?php echo e(__('Super Admin')); ?></span>
              <?php else: ?>
                <span class="user-level"><?php echo e($roleInfo->name); ?></span>
              <?php endif; ?>

              <span class="caret"></span>
            </span>
          </a>

          <div class="clearfix"></div>

          <div class="collapse in" id="adminProfileMenu">
            <ul class="nav">
              <li>
                <a href="<?php echo e(route('admin.edit_profile')); ?>">
                  <span class="link-collapse"><?php echo e(__('Edit Profile')); ?></span>
                </a>
              </li>

              <li>
                <a href="<?php echo e(route('admin.change_password')); ?>">
                  <span class="link-collapse"><?php echo e(__('Change Password')); ?></span>
                </a>
              </li>

              <li>
                <a href="<?php echo e(route('admin.logout')); ?>">
                  <span class="link-collapse"><?php echo e(__('Logout')); ?></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <?php
        if (!is_null($roleInfo)) {
          $rolePermissions = json_decode($roleInfo->permissions);
        }
      ?>

      <ul class="nav nav-primary">
        
        <div class="row mb-3">
          <div class="col-12">
            <form action="">
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control sidebar-search ltr" placeholder="Search Menu Here...">
              </div>
            </form>
          </div>
        </div>

        
        <li class="nav-item <?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="la flaticon-paint-palette"></i>
            <p><?php echo e(__('Dashboard')); ?></p>
          </a>
        </li>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Menu Builder', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.menu_builder')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.menu_builder', ['language' => $defaultLang->code])); ?>">
              <i class="fal fa-bars"></i>
              <p><?php echo e(__('Menu Builder')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Instructors', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.instructors')): ?> active 
            <?php elseif(request()->routeIs('admin.create_instructor')): ?> active 
            <?php elseif(request()->routeIs('admin.edit_instructor')): ?> active 
            <?php elseif(request()->routeIs('admin.instructor.social_links')): ?> active 
            <?php elseif(request()->routeIs('admin.instructor.edit_social_link')): ?> active <?php endif; ?>"
          >
            <a href="<?php echo e(route('admin.instructors', ['language' => $defaultLang->code])); ?>">
              <i class="fal fa-chalkboard-teacher"></i>
              <p><?php echo e(__('Instructors')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Management', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.course_management.categories')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.courses')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.create_course')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.edit_course')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.course.faqs')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.course.thanks_page')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.course.certificate_settings')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.course.modules')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.lesson.contents')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.lesson.create_quiz')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.lesson.manage_quiz')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.lesson.edit_quiz')): ?> active 
            <?php elseif(request()->routeIs('admin.course_management.coupons')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#course">
              <i class="fal fa-book"></i>
              <p><?php echo e(__('Courses Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="course" class="collapse 
              <?php if(request()->routeIs('admin.course_management.categories')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.courses')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.create_course')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.edit_course')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.course.faqs')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.course.thanks_page')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.course.certificate_settings')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.course.modules')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.lesson.contents')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.lesson.create_quiz')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.lesson.manage_quiz')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.lesson.edit_quiz')): ?> show 
              <?php elseif(request()->routeIs('admin.course_management.coupons')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.course_management.categories') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_management.categories', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Categories')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.course_management.coupons') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_management.coupons')); ?>">
                    <span class="sub-item"><?php echo e(__('Coupons')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->routeIs('admin.course_management.courses')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.create_course')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.edit_course')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.course.faqs')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.course.thanks_page')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.course.certificate_settings')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.course.modules')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.lesson.contents')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.lesson.create_quiz')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.lesson.manage_quiz')): ?> active 
                  <?php elseif(request()->routeIs('admin.course_management.lesson.edit_quiz')): ?> active <?php endif; ?>"
                >
                  <a href="<?php echo e(route('admin.course_management.courses', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Courses')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Enrolments', $rolePermissions))): ?>
          <li class="nav-item 
          <?php if(request()->routeIs('admin.course_enrolments')): ?> active 
          <?php elseif(request()->routeIs('admin.course_enrolment.details')): ?> active 
          <?php elseif(request()->routeIs('admin.course_enrolments.report')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#enrolment">
              <i class="fal fa-users-class"></i>
              <p><?php echo e(__('Course Enrolments')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="enrolment" class="collapse 
            <?php if(request()->routeIs('admin.course_enrolments')): ?> show 
            <?php elseif(request()->routeIs('admin.course_enrolment.details')): ?> show 
            <?php elseif(request()->routeIs('admin.course_enrolments.report')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.course_enrolments') && empty(request()->input('status')) ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_enrolments')); ?>">
                    <span class="sub-item"><?php echo e(__('All Enrolments')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.course_enrolments') && request()->input('status') == 'completed' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_enrolments', ['status' => 'completed'])); ?>">
                    <span class="sub-item"><?php echo e(__('Completed Enrolments')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.course_enrolments') && request()->input('status') == 'pending' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_enrolments', ['status' => 'pending'])); ?>">
                    <span class="sub-item"><?php echo e(__('Pending Enrolments')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.course_enrolments') && request()->input('status') == 'rejected' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_enrolments', ['status' => 'rejected'])); ?>">
                    <span class="sub-item"><?php echo e(__('Rejected Enrolments')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.course_enrolments.report') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.course_enrolments.report')); ?>">
                    <span class="sub-item"><?php echo e(__('Report')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('User Management', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.user_management.registered_users')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.user_details')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.user.change_password')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.subscribers')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.push_notification.settings')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#user">
              <i class="la flaticon-users"></i>
              <p><?php echo e(__('User Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="user" class="collapse 
              <?php if(request()->routeIs('admin.user_management.registered_users')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.user_details')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.user.change_password')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.subscribers')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.push_notification.settings')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->routeIs('admin.user_management.registered_users')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.user_details')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.user.change_password')): ?> active <?php endif; ?>"
                >
                  <a href="<?php echo e(route('admin.user_management.registered_users')); ?>">
                    <span class="sub-item"><?php echo e(__('Registered Users')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->routeIs('admin.user_management.subscribers')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> active <?php endif; ?>"
                >
                  <a href="<?php echo e(route('admin.user_management.subscribers')); ?>">
                    <span class="sub-item"><?php echo e(__('Subscribers')); ?></span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#push_notification">
                    <span class="sub-item"><?php echo e(__('Push Notification')); ?></span>
                    <span class="caret"></span>
                  </a>

                  <div id="push_notification" class="collapse 
                    <?php if(request()->routeIs('admin.user_management.push_notification.settings')): ?> show 
                    <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> show <?php endif; ?>"
                  >
                    <ul class="nav nav-collapse subnav">
                      <li class="<?php echo e(request()->routeIs('admin.user_management.push_notification.settings') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.user_management.push_notification.settings')); ?>">
                          <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                        </a>
                      </li>

                      <li class="<?php echo e(request()->routeIs('admin.user_management.push_notification.notification_for_visitors') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.user_management.push_notification.notification_for_visitors')); ?>">
                          <span class="sub-item"><?php echo e(__('Send Notification')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Home Page', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.home_page.hero_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.section_titles')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.action_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.features_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.video_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.fun_facts_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.testimonials_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.newsletter_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.about_us_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.course_categories_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.section_customization')): ?> active 
            <?php elseif(request()->routeIs('admin.theme_v4.hero_settings')): ?> active 
            <?php elseif(request()->routeIs('admin.theme_v4.search_settings')): ?> active 
            <?php elseif(request()->routeIs('admin.theme_v4.cta_settings')): ?> active 
            <?php elseif(request()->routeIs('admin.theme_v4.about_settings')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#home_page">
              <i class="fal fa-layer-group"></i>
              <p><?php echo e(__('Home Page')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="home_page" class="collapse 
              <?php if(request()->routeIs('admin.home_page.hero_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.section_titles')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.action_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.features_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.video_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.fun_facts_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.testimonials_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.newsletter_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.about_us_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.course_categories_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.section_customization')): ?> show 
              <?php elseif(request()->routeIs('admin.theme_v4.hero_settings')): ?> show 
              <?php elseif(request()->routeIs('admin.theme_v4.search_settings')): ?> show 
              <?php elseif(request()->routeIs('admin.theme_v4.cta_settings')): ?> show 
              <?php elseif(request()->routeIs('admin.theme_v4.about_settings')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.home_page.hero_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.hero_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Hero Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.section_titles') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.section_titles', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Section Titles')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.action_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.action_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Call To Action Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.features_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.features_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Features Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.video_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.video_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Video Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.fun_facts_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.fun_facts_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Fun Facts Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.testimonials_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.testimonials_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Testimonials Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.newsletter_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.newsletter_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Newsletter Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.about_us_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.about_us_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('About Us Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.course_categories_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.course_categories_section')); ?>">
                    <span class="sub-item"><?php echo e(__('Course Categories Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.section_customization') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.section_customization')); ?>">
                    <span class="sub-item"><?php echo e(__('Section Customization')); ?></span>
                  </a>
                </li>
                <li class="submenu">
                  <a data-toggle="collapse" href="#theme_v4_settings">
                    <span class="sub-item"><?php echo e(__('Theme V4 Settings')); ?></span>
                    <span class="caret"></span>
                  </a>

                  <div id="theme_v4_settings" class="collapse 
                    <?php if(request()->routeIs('admin.theme_v4.hero_settings')): ?> show 
                    <?php elseif(request()->routeIs('admin.theme_v4.search_settings')): ?> show 
                    <?php elseif(request()->routeIs('admin.theme_v4.cta_settings')): ?> show 
                    <?php elseif(request()->routeIs('admin.theme_v4.about_settings')): ?> show <?php endif; ?>"
                  >
                    <ul class="nav nav-collapse subnav">
                      <li class="<?php echo e(request()->routeIs('admin.theme_v4.hero_settings') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.theme_v4.hero_settings')); ?>">
                          <span class="sub-item"><?php echo e(__('Hero Section')); ?></span>
                        </a>
                      </li>

                      <li class="<?php echo e(request()->routeIs('admin.theme_v4.search_settings') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.theme_v4.search_settings')); ?>">
                          <span class="sub-item"><?php echo e(__('Search Section')); ?></span>
                        </a>
                      </li>

                      <li class="<?php echo e(request()->routeIs('admin.theme_v4.cta_settings') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.theme_v4.cta_settings')); ?>">
                          <span class="sub-item"><?php echo e(__('Call To Action')); ?></span>
                        </a>
                      </li>

                      <li class="<?php echo e(request()->routeIs('admin.theme_v4.about_settings') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.theme_v4.about_settings')); ?>">
                          <span class="sub-item"><?php echo e(__('About Section')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Footer', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.footer.content')): ?> active 
            <?php elseif(request()->routeIs('admin.footer.quick_links')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#footer">
              <i class="fal fa-shoe-prints"></i>
              <p><?php echo e(__('Footer')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="footer" class="collapse <?php if(request()->routeIs('admin.footer.content')): ?> show 
              <?php elseif(request()->routeIs('admin.footer.quick_links')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.footer.content') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.footer.content', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Content & Color')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.footer.quick_links') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.footer.quick_links', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Quick Links')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Custom Pages', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.custom_pages')): ?> active 
            <?php elseif(request()->routeIs('admin.custom_pages.create_page')): ?> active 
            <?php elseif(request()->routeIs('admin.custom_pages.edit_page')): ?> active <?php endif; ?>"
          >
            <a href="<?php echo e(route('admin.custom_pages', ['language' => $defaultLang->code])); ?>">
              <i class="la flaticon-file"></i>
              <p><?php echo e(__('Custom Pages')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.blog_management.categories')): ?> active 
            <?php elseif(request()->routeIs('admin.blog_management.blogs')): ?> active 
            <?php elseif(request()->routeIs('admin.blog_management.create_blog')): ?> active 
            <?php elseif(request()->routeIs('admin.blog_management.edit_blog')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#blog">
              <i class="fal fa-blog"></i>
              <p><?php echo e(__('Blog Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="blog" class="collapse 
              <?php if(request()->routeIs('admin.blog_management.categories')): ?> show 
              <?php elseif(request()->routeIs('admin.blog_management.blogs')): ?> show 
              <?php elseif(request()->routeIs('admin.blog_management.create_blog')): ?> show 
              <?php elseif(request()->routeIs('admin.blog_management.edit_blog')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.blog_management.categories') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.blog_management.categories', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Categories')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->routeIs('admin.blog_management.blogs')): ?> active 
                  <?php elseif(request()->routeIs('admin.blog_management.create_blog')): ?> active 
                  <?php elseif(request()->routeIs('admin.blog_management.edit_blog')): ?> active <?php endif; ?>"
                >
                  <a href="<?php echo e(route('admin.blog_management.blogs', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Blog')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('FAQ Management', $rolePermissions))): ?>
          <li class="nav-item <?php echo e(request()->routeIs('admin.faq_management') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.faq_management', ['language' => $defaultLang->code])); ?>">
              <i class="la flaticon-round"></i>
              <p><?php echo e(__('FAQ Management')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Advertise', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.advertise.advertisements')): ?> active <?php endif; ?>"
          >
            <a href="<?php echo e(route('admin.advertise.advertisements')); ?>">
              <i class="fab fa-buysellads"></i>
              <p><?php echo e(__('Ads')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Announcement Popups', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.announcement_popups')): ?> active 
            <?php elseif(request()->routeIs('admin.announcement_popups.select_popup_type')): ?> active 
            <?php elseif(request()->routeIs('admin.announcement_popups.create_popup')): ?> active 
            <?php elseif(request()->routeIs('admin.announcement_popups.edit_popup')): ?> active <?php endif; ?>"
          >
            <a href="<?php echo e(route('admin.announcement_popups', ['language' => $defaultLang->code])); ?>">
              <i class="fal fa-bullhorn"></i>
              <p><?php echo e(__('Announcement Popups')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Payment Gateways', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.payment_gateways.online_gateways')): ?> active 
            <?php elseif(request()->routeIs('admin.payment_gateways.offline_gateways')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#payment_gateways">
              <i class="la flaticon-paypal"></i>
              <p><?php echo e(__('Payment Gateways')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="payment_gateways" class="collapse 
              <?php if(request()->routeIs('admin.payment_gateways.online_gateways')): ?> show 
              <?php elseif(request()->routeIs('admin.payment_gateways.offline_gateways')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.payment_gateways.online_gateways') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.payment_gateways.online_gateways')); ?>">
                    <span class="sub-item"><?php echo e(__('Online Gateways')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.payment_gateways.offline_gateways') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.payment_gateways.offline_gateways')); ?>">
                    <span class="sub-item"><?php echo e(__('Offline Gateways')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Basic Settings', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.basic_settings.favicon')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.logo')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.information')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.theme_and_home')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.currency')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.appearance')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.breadcrumb')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.page_headings')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.plugins')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.seo')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.maintenance_mode')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.cookie_alert')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.footer_logo')): ?> active 
            <?php elseif(request()->routeIs('admin.basic_settings.social_medias')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#basic_settings">
              <i class="la flaticon-settings"></i>
              <p><?php echo e(__('Basic Settings')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="basic_settings" class="collapse 
              <?php if(request()->routeIs('admin.basic_settings.favicon')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.logo')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.information')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.theme_and_home')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.currency')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.appearance')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.breadcrumb')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.page_headings')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.plugins')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.seo')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.maintenance_mode')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.cookie_alert')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.footer_logo')): ?> show 
              <?php elseif(request()->routeIs('admin.basic_settings.social_medias')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.basic_settings.favicon') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.favicon')); ?>">
                    <span class="sub-item"><?php echo e(__('Favicon')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.logo') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.logo')); ?>">
                    <span class="sub-item"><?php echo e(__('Logo')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.information') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.information')); ?>">
                    <span class="sub-item"><?php echo e(__('Information')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.theme_and_home') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.theme_and_home')); ?>">
                    <span class="sub-item"><?php echo e(__('Theme & Home')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.currency') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.currency')); ?>">
                    <span class="sub-item"><?php echo e(__('Currency')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.appearance') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.appearance')); ?>">
                    <span class="sub-item"><?php echo e(__('Website Appearance')); ?></span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#mail_settings">
                    <span class="sub-item"><?php echo e(__('Email Settings')); ?></span>
                    <span class="caret"></span>
                  </a>

                  <div id="mail_settings" class="collapse 
                    <?php if(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> show 
                    <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> show <?php endif; ?>"
                  >
                    <ul class="nav nav-collapse subnav">
                      <li class="<?php echo e(request()->routeIs('admin.basic_settings.mail_from_admin') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.basic_settings.mail_from_admin')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail From Admin')); ?></span>
                        </a>
                      </li>

                      <li class="<?php echo e(request()->routeIs('admin.basic_settings.mail_to_admin') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.basic_settings.mail_to_admin')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail To Admin')); ?></span>
                        </a>
                      </li>

                      <li class="<?php if(request()->routeIs('admin.basic_settings.mail_templates')): ?> active 
                        <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> active <?php endif; ?>"
                      >
                        <a href="<?php echo e(route('admin.basic_settings.mail_templates')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail Templates')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.breadcrumb') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.breadcrumb')); ?>">
                    <span class="sub-item"><?php echo e(__('Breadcrumb')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.page_headings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.page_headings', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Page Headings')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.plugins') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.plugins')); ?>">
                    <span class="sub-item"><?php echo e(__('Plugins')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.seo') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.seo', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('SEO Informations')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.maintenance_mode') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.maintenance_mode')); ?>">
                    <span class="sub-item"><?php echo e(__('Maintenance Mode')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.cookie_alert') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.cookie_alert', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Cookie Alert')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.footer_logo') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.footer_logo')); ?>">
                    <span class="sub-item"><?php echo e(__('Footer Logo')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.social_medias') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.social_medias')); ?>">
                    <span class="sub-item"><?php echo e(__('Social Medias')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Admin Management', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> active 
            <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> active 
            <?php elseif(request()->routeIs('admin.admin_management.registered_admins')): ?> active <?php endif; ?>"
          >
            <a data-toggle="collapse" href="#admin">
              <i class="fal fa-users-cog"></i>
              <p><?php echo e(__('Admin Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="admin" class="collapse 
              <?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> show 
              <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> show 
              <?php elseif(request()->routeIs('admin.admin_management.registered_admins')): ?> show <?php endif; ?>"
            >
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> active 
                  <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> active <?php endif; ?>"
                >
                  <a href="<?php echo e(route('admin.admin_management.role_permissions')); ?>">
                    <span class="sub-item"><?php echo e(__('Role & Permissions')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.admin_management.registered_admins') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.admin_management.registered_admins')); ?>">
                    <span class="sub-item"><?php echo e(__('Registered Admins')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Language Management', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.language_management')): ?> active 
            <?php elseif(request()->routeIs('admin.language_management.edit_keyword')): ?> active <?php endif; ?>"
          >
            <a href="<?php echo e(route('admin.language_management')); ?>">
              <i class="fal fa-language"></i>
              <p><?php echo e(__('Language Management')); ?></p>
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/partials/side-navbar.blade.php ENDPATH**/ ?>