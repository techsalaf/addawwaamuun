<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontEnd\HomeController@index')->name('index');
Route::get('/courses', 'FrontEnd\Curriculum\CourseController@courses')->name('courses');
Route::get('/course/{slug}', 'FrontEnd\Curriculum\CourseController@details')->name('course_details');
Route::post('/course-enrolment/{id}', 'FrontEnd\Curriculum\EnrolmentController@enrol')->name('course-enrolment');
Route::get('/login', 'FrontEnd\UserController@login')->name('user.login');
Route::post('/login', 'FrontEnd\UserController@loginSubmit')->name('user.login_submit');
Route::get('/forget-password', 'FrontEnd\UserController@forgetPassword')->name('user.forget_password');
Route::post('/forget-password', 'FrontEnd\UserController@sendMail')->name('user.send_forget_password_mail');
Route::get('/signup', 'FrontEnd\UserController@signup')->name('user.signup');
Route::post('/signup', 'FrontEnd\UserController@signupSubmit')->name('user.signup_submit');
Route::post('/store-subscriber', 'BackEnd\User\SubscriberController@store')->name('store_subscriber');
Route::get('/change-language', 'BackEnd\LanguageController@changeLanguage')->name('change_language');
Route::get('/instructors', 'FrontEnd\InstructorController@index')->name('instructors');
Route::get('/blogs', 'FrontEnd\BlogController@index')->name('blogs');
Route::get('/blog/{slug}', 'FrontEnd\BlogController@details')->name('blog_details');
Route::get('/faqs', 'FrontEnd\FaqController@index')->name('faqs');
Route::get('/contact', 'FrontEnd\ContactController@index')->name('contact');
Route::get('/page/{slug}', 'FrontEnd\PageController@page')->name('dynamic_page');
Route::get('/user/course-curriculum/{id}', 'FrontEnd\UserController@curriculum')->name('user.my_course.curriculum');
Route::get('/service-unavailable', function () {
  return view('errors.503');
})->name('service_unavailable');

// Admin routes
Route::get('/admin', function () {
  return redirect('/admin/login');
});
Route::get('/admin/login', 'BackEnd\AdminController@login')->name('admin.login');
Route::post('/admin/login', 'BackEnd\AdminController@authentication')->name('admin.login_submit');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
  Route::match(['get', 'post', 'put', 'patch'], '/course-categories/update', 'BackEnd\Curriculum\CategoryController@update')->name('admin.course_categories.update');

  // Home Page routes
  Route::post('/home-page/update-section-status', 'BackEnd\HomePage\SectionController@update')->name('admin.home_page.update_section_status');
  Route::post('/home-page/update-section-title', 'BackEnd\HomePage\SectionTitleController@update')->name('admin.home_page.update_section_title');
  Route::post('/home-page/update-video-section', 'BackEnd\HomePage\VideoController@update')->name('admin.home_page.update_video_section');
  Route::post('/home-page/update-testimonial-section-image', 'BackEnd\HomePage\TestimonialController@updateImage')->name('admin.home_page.update_testimonial_section_image');
  Route::post('/home-page/update-feature-section-image', 'BackEnd\HomePage\FeatureController@updateImage')->name('admin.home_page.update_feature_section_image');
  Route::post('/home-page/bulk-delete-testimonial', 'BackEnd\HomePage\TestimonialController@bulkDestroy')->name('admin.home_page.bulk_delete_testimonial');

  // Footer routes
  Route::post('/footer/update-content', 'BackEnd\Footer\ContentController@update')->name('admin.footer.update_content');
  Route::delete('/footer/delete-quick-link/{id}', 'BackEnd\Footer\QuickLinkController@destroy')->name('admin.footer.delete_quick_link');
  Route::post('/footer/create-quick-link', 'BackEnd\Footer\QuickLinkController@store')->name('admin.footer.create_quick_link');

  // Custom Pages routes
  Route::get('/custom-pages/create', 'BackEnd\CustomPageController@create')->name('admin.custom_pages.create_page');
  Route::post('/custom-pages/store', 'BackEnd\CustomPageController@store')->name('admin.custom_pages.store');
  Route::get('/custom-pages/{id}/{language}/edit', 'BackEnd\CustomPageController@edit')->name('admin.custom_pages.edit');
  Route::post('/custom-pages/update', 'BackEnd\CustomPageController@update')->name('admin.custom_pages.update');
  Route::delete('/custom-pages/{id}', 'BackEnd\CustomPageController@destroy')->name('admin.custom_pages.delete');
  Route::post('/custom-pages/bulk-delete', 'BackEnd\CustomPageController@bulkDestroy')->name('admin.custom_pages.bulk_delete_page');
});
Route::get('/admin/forget-password', 'BackEnd\AdminController@forgetPassword')->name('admin.forget_password');
Route::post('/admin/forget-password', 'BackEnd\AdminController@sendMail')->name('admin.mail_for_forget_password');
Route::post('/admin/logout', 'BackEnd\AdminController@logout')->name('admin.logout');
Route::get('/admin/dashboard', 'BackEnd\AdminController@redirectToDashboard')->name('admin.dashboard');
Route::get('/admin/edit-profile', 'BackEnd\AdminController@editProfile')->name('admin.edit_profile');
Route::post('/admin/edit-profile', 'BackEnd\AdminController@updateProfile')->name('admin.update_profile');
Route::get('/admin/change-password', 'BackEnd\AdminController@changePassword')->name('admin.change_password');
Route::post('/admin/change-password', 'BackEnd\AdminController@updatePassword')->name('admin.update_password');
Route::post('/admin/change-theme', 'BackEnd\AdminController@changeTheme')->name('admin.change_theme');

// Admin course management routes
Route::get('/admin/courses/{language}', 'BackEnd\Curriculum\CourseController@index')->name('admin.course_management.courses');
Route::get('/admin/courses/{language}/create', 'BackEnd\Curriculum\CourseController@create')->name('admin.course_management.create_course');
Route::post('/admin/courses/store', 'BackEnd\Curriculum\CourseController@store')->name('admin.course_management.store_course');
Route::get('/admin/courses/{id}/{language}/edit', 'BackEnd\Curriculum\CourseController@edit')->name('admin.course_management.edit_course');
Route::post('/admin/courses/update', 'BackEnd\Curriculum\CourseController@update')->name('admin.course_management.update_course');
Route::delete('/admin/courses/{id}', 'BackEnd\Curriculum\CourseController@destroy')->name('admin.course_management.delete_course');
Route::post('/admin/courses/{id}/update-status', 'BackEnd\Curriculum\CourseController@updateStatus')->name('admin.course_management.course.update_status');
Route::post('/admin/courses/{id}/update-featured', 'BackEnd\Curriculum\CourseController@updateFeatured')->name('admin.course_management.course.update_featured');
Route::get('/admin/courses/{id}/modules/{language}', 'BackEnd\Curriculum\ModuleController@index')->name('admin.course_management.course.modules');
Route::post('/admin/courses/{id}/modules/bulk-delete', 'BackEnd\Curriculum\ModuleController@bulkDestroy')->name('admin.course_management.course.bulk_delete_module');
Route::get('/admin/courses/{id}/faqs/{language}', 'BackEnd\Curriculum\CourseFaqController@index')->name('admin.course_management.course.faqs');
Route::post('/admin/courses/{id}/faqs/bulk-delete', 'BackEnd\Curriculum\CourseFaqController@bulkDestroy')->name('admin.course_management.course.bulk_delete_faq');
Route::get('/admin/courses/{id}/thanks-page', 'BackEnd\Curriculum\CourseController@thanksPage')->name('admin.course_management.course.thanks_page');
Route::get('/admin/courses/{id}/certificate-settings', 'BackEnd\Curriculum\CourseController@certificateSettings')->name('admin.course_management.course.certificate_settings');
Route::post('/admin/courses/{id}/update-certificate-settings', 'BackEnd\Curriculum\CourseController@updateCertificateSettings')->name('admin.course_management.course.update_certificate_settings');
Route::post('/admin/courses/bulk-delete', 'BackEnd\Curriculum\CourseController@bulkDestroy')->name('admin.course_management.bulk_delete_course');
Route::get('/admin/course-categories/{language}', 'BackEnd\Curriculum\CategoryController@index')->name('admin.course_management.categories');
Route::get('/admin/course-categories/{language}/create', 'BackEnd\Curriculum\CategoryController@create')->name('admin.course_management.create_category');
Route::post('/admin/course-categories/store', 'BackEnd\Curriculum\CategoryController@store')->name('admin.course_management.store_category');
Route::get('/admin/course-categories/{id}/{language}/edit', 'BackEnd\Curriculum\CategoryController@edit')->name('admin.course_management.edit_category');
Route::post('/admin/course-categories/update', 'BackEnd\Curriculum\CategoryController@update')->name('admin.course_management.update_category');
Route::delete('/admin/course-categories/{id}', 'BackEnd\Curriculum\CategoryController@destroy')->name('admin.course_management.delete_category');
Route::post('/admin/course-categories/bulk-delete', 'BackEnd\Curriculum\CategoryController@bulkDelete')->name('admin.course_management.bulk_delete_category');
Route::get('/admin/course-enrolments', 'BackEnd\Curriculum\EnrolmentController@index')->name('admin.course_enrolments');
Route::get('/admin/course-enrolments/{id}', 'BackEnd\Curriculum\EnrolmentController@show')->name('admin.course_enrolment.details');
Route::delete('/admin/course-enrolments/{id}', 'BackEnd\Curriculum\EnrolmentController@destroy')->name('admin.course_enrolment.delete');
Route::post('/admin/course-enrolments/bulk-delete', 'BackEnd\Curriculum\EnrolmentController@bulkDelete')->name('admin.course_enrolments.bulk_delete');

// Admin instructor routes
Route::get('/admin/instructors/{language?}', 'BackEnd\Teacher\InstructorController@index')->name('admin.instructors');
Route::get('/admin/instructors/create', 'BackEnd\Teacher\InstructorController@create')->name('admin.create_instructor');
Route::post('/admin/instructors/store', 'BackEnd\Teacher\InstructorController@store')->name('admin.store_instructor');
Route::get('/admin/instructors/{id}/edit', 'BackEnd\Teacher\InstructorController@edit')->name('admin.edit_instructor');
Route::post('/admin/instructors/update', 'BackEnd\Teacher\InstructorController@update')->name('admin.update_instructor');
Route::delete('/admin/instructors/{id}', 'BackEnd\Teacher\InstructorController@destroy')->name('admin.delete_instructor');
Route::get('/admin/instructors/{id}/social-links', 'BackEnd\Teacher\SocialLinkController@links')->name('admin.instructor.social_links');
Route::post('/admin/instructors/{id}/store-social-link', 'BackEnd\Teacher\SocialLinkController@storeLink')->name('admin.instructor.store_social_link');
Route::get('/admin/instructors/{instructor_id}/edit-social-link/{id}', 'BackEnd\Teacher\SocialLinkController@editLink')->name('admin.instructor.edit_social_link');
Route::post('/admin/instructors/bulk-delete', 'BackEnd\Teacher\InstructorController@bulkDestroy')->name('admin.bulk_delete_instructor');
Route::post('/admin/instructors/{id}/update-featured', 'BackEnd\Teacher\InstructorController@updateFeatured')->name('admin.instructor.update_featured');

// Admin blog management routes
Route::get('/admin/blogs/{language}', 'BackEnd\Journal\BlogController@index')->name('admin.blog_management.blogs');

// Admin user management routes
Route::get('/admin/users', 'BackEnd\User\UserController@index')->name('admin.user_management.registered_users');
Route::get('/admin/users/{id}', 'BackEnd\User\UserController@show')->name('admin.user_management.user_details');
Route::get('/admin/users/{id}/change-password', 'BackEnd\User\UserController@changePassword')->name('admin.user_management.user.change_password');
Route::post('/admin/users/{id}/update-password', 'BackEnd\User\UserController@updatePassword')->name('admin.user_management.user.update_password');
Route::post('/admin/users/{id}/update-email-status', 'BackEnd\User\UserController@updateEmailStatus')->name('admin.user_management.user.update_email_status');
Route::post('/admin/users/{id}/update-account-status', 'BackEnd\User\UserController@updateAccountStatus')->name('admin.user_management.user.update_account_status');
Route::delete('/admin/users/{id}', 'BackEnd\User\UserController@destroy')->name('admin.user_management.user.delete');
Route::post('/admin/users/bulk-delete', 'BackEnd\User\UserController@bulkDelete')->name('admin.user_management.bulk_delete_user');
Route::get('/admin/subscribers', 'BackEnd\User\SubscriberController@index')->name('admin.user_management.subscribers');
Route::delete('/admin/subscribers/{id}', 'BackEnd\User\SubscriberController@destroy')->name('admin.user_management.subscriber.delete');
Route::post('/admin/subscribers/mail', 'BackEnd\User\SubscriberController@sendEmail')->name('admin.user_management.mail_for_subscribers');
Route::post('/admin/subscribers/bulk-delete', 'BackEnd\User\SubscriberController@bulkDestroy')->name('admin.user_management.bulk_delete_subscriber');
Route::get('/admin/push-notification-settings', 'BackEnd\User\PushNotificationController@settings')->name('admin.user_management.push_notification.settings');
Route::post('/admin/push-notification-settings/update', 'BackEnd\User\PushNotificationController@updateSettings')->name('admin.user_management.push_notification.update_settings');
Route::get('/admin/push-notification-visitors', 'BackEnd\User\PushNotificationController@writeNotification')->name('admin.user_management.push_notification.notification_for_visitors');
Route::post('/admin/push-notification/send-notification', 'BackEnd\User\PushNotificationController@sendNotification')->name('admin.user_management.push_notification.send_notification');

// Menu builder
Route::get('/admin/menu-builder/{language}', 'BackEnd\MenuBuilderController@index')->name('admin.menu_builder');
Route::post('/admin/menu-builder/update', 'BackEnd\MenuBuilderController@update')->name('admin.menu_builder.update_menus');

// Course management routes - coupons
Route::get('/admin/coupons', 'BackEnd\Curriculum\CouponController@index')->name('admin.course_management.coupons');
Route::get('/admin/coupons/create', 'BackEnd\Curriculum\CouponController@create')->name('admin.course_management.create_coupon');
Route::post('/admin/coupons/store', 'BackEnd\Curriculum\CouponController@store')->name('admin.course_management.store_coupon');
Route::get('/admin/coupons/{id}/edit', 'BackEnd\Curriculum\CouponController@edit')->name('admin.course_management.edit_coupon');
Route::post('/admin/coupons/update', 'BackEnd\Curriculum\CouponController@update')->name('admin.course_management.update_coupon');
Route::delete('/admin/coupons/{id}', 'BackEnd\Curriculum\CouponController@destroy')->name('admin.course_management.delete_coupon');
Route::get('/admin/course-enrolments-report', 'BackEnd\Curriculum\EnrolmentController@report')->name('admin.course_enrolments.report');
Route::post('/admin/course-enrolments/export', 'BackEnd\Curriculum\EnrolmentController@export')->name('admin.course_enrolments.export');

// Home page routes
Route::get('/admin/home-page/hero-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.hero_section');
Route::post('/home-page/update-hero-section', 'BackEnd\HomePage\HeroController@update')->name('admin.home_page.update_hero_section');
Route::get('/admin/home-page/section-titles/{language}', 'BackEnd\HomePage\SectionTitleController@index')->name('admin.home_page.section_titles');
Route::get('/admin/home-page/action-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.action_section');
Route::post('/home-page/update-action-section', 'BackEnd\HomePage\ActionController@update')->name('admin.home_page.update_action_section');
Route::get('/admin/home-page/features-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.features_section');
Route::post('/home-page/features/store', 'BackEnd\HomePage\FeatureController@store')->name('admin.home_page.store_feature');
Route::post('/home-page/features/update', 'BackEnd\HomePage\FeatureController@update')->name('admin.home_page.update_feature');
Route::delete('/home-page/features/{id}', 'BackEnd\HomePage\FeatureController@destroy')->name('admin.home_page.delete_feature');
Route::post('/home-page/bulk-delete-feature', 'BackEnd\HomePage\FeatureController@bulkDestroy')->name('admin.home_page.bulk_delete_feature');
Route::get('/admin/home-page/video-section/{language}', 'BackEnd\HomePage\VideoController@index')->name('admin.home_page.video_section');
Route::get('/admin/home-page/fun-facts-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.fun_facts_section');
Route::post('/home-page/update-fun-facts-section', 'BackEnd\HomePage\FunFactController@updateSection')->name('admin.home_page.update_fun_facts_section');
Route::post('/home-page/counter-infos/store', 'BackEnd\HomePage\FunFactController@store')->name('admin.home_page.store_counter_info');
Route::post('/home-page/counter-infos/update', 'BackEnd\HomePage\FunFactController@update')->name('admin.home_page.update_counter_info');
Route::delete('/home-page/counter-infos/{id}', 'BackEnd\HomePage\FunFactController@destroy')->name('admin.home_page.delete_counter_info');
Route::post('/home-page/bulk-delete-counter-info', 'BackEnd\HomePage\FunFactController@bulkDestroy')->name('admin.home_page.bulk_delete_counter_info');
Route::get('/admin/home-page/testimonials-section/{language}', 'BackEnd\HomePage\TestimonialController@index')->name('admin.home_page.testimonials_section');
Route::get('/admin/home-page/testimonials-section/{language}/create', 'BackEnd\HomePage\TestimonialController@create')->name('admin.home_page.create_testimonial');
Route::post('/admin/home-page/testimonials/store', 'BackEnd\HomePage\TestimonialController@store')->name('admin.home_page.store_testimonial');
Route::get('/admin/home-page/testimonials/{id}/edit/{language}', 'BackEnd\HomePage\TestimonialController@edit')->name('admin.home_page.edit_testimonial');
Route::post('/admin/home-page/testimonials/update', 'BackEnd\HomePage\TestimonialController@update')->name('admin.home_page.update_testimonial');
Route::delete('/admin/home-page/testimonials/{id}', 'BackEnd\HomePage\TestimonialController@destroy')->name('admin.home_page.delete_testimonial');
Route::get('/admin/home-page/newsletter-section/{language}', 'BackEnd\HomePage\NewsletterController@index')->name('admin.home_page.newsletter_section');
Route::post('/home-page/update-newsletter-section', 'BackEnd\HomePage\NewsletterController@update')->name('admin.home_page.update_newsletter_section');
Route::get('/admin/home-page/about-us-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.about_us_section');
Route::post('/home-page/update-about-us-section', 'BackEnd\HomePage\AboutUsController@update')->name('admin.home_page.update_about_us_section');
Route::get('/admin/home-page/course-categories-section', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.course_categories_section');
Route::post('/home-page/update-course-category-section-image', 'BackEnd\HomePage\CourseCategoryController@updateImage')->name('admin.home_page.update_course_category_section_image');
Route::get('/admin/home-page/section-customization', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.section_customization');

// Theme V4 routes
Route::get('/admin/theme-v4/hero-settings', 'BackEnd\HomePage\ThemeV4Controller@heroSettings')->name('admin.theme_v4.hero_settings');
Route::post('/admin/theme-v4/hero-settings', 'BackEnd\HomePage\ThemeV4Controller@updateHeroSettings')->name('admin.theme_v4.update_hero_settings');
Route::get('/admin/theme-v4/search-settings', 'BackEnd\HomePage\ThemeV4Controller@searchSettings')->name('admin.theme_v4.search_settings');
Route::post('/admin/theme-v4/search-settings', 'BackEnd\HomePage\ThemeV4Controller@updateSearchSettings')->name('admin.theme_v4.update_search_settings');
Route::get('/admin/theme-v4/cta-settings', 'BackEnd\HomePage\ThemeV4Controller@ctaSettings')->name('admin.theme_v4.cta_settings');
Route::post('/admin/theme-v4/cta-settings', 'BackEnd\HomePage\ThemeV4Controller@updateCtaSettings')->name('admin.theme_v4.update_cta_settings');
Route::get('/admin/theme-v4/about-settings', 'BackEnd\HomePage\ThemeV4Controller@aboutSettings')->name('admin.theme_v4.about_settings');
Route::post('/admin/theme-v4/about-settings', 'BackEnd\HomePage\ThemeV4Controller@updateAboutSettings')->name('admin.theme_v4.update_about_settings');

// Footer routes
Route::get('/admin/footer-content/{language}', 'BackEnd\Footer\ContentController@index')->name('admin.footer.content');
Route::get('/admin/footer-quick-links/{language}', 'BackEnd\Footer\QuickLinkController@index')->name('admin.footer.quick_links');
Route::get('/admin/footer-quick-links/create', 'BackEnd\Footer\QuickLinkController@create')->name('admin.footer.create_quick_link');
Route::post('/admin/footer/update-quick-link', 'BackEnd\Footer\QuickLinkController@update')->name('admin.footer.update_quick_link');
Route::post('/admin/footer/create-quick-link', 'BackEnd\Footer\QuickLinkController@store')->name('admin.footer.store_quick_link');
Route::get('/admin/custom-pages/{language?}', 'BackEnd\CustomPageController@index')->name('admin.custom_pages');
Route::get('/admin/custom-pages/{language}/create', 'BackEnd\CustomPageController@create')->name('admin.custom_pages.create_page');
Route::post('/admin/custom-pages/store', 'BackEnd\CustomPageController@store')->name('admin.custom_pages.store');
Route::get('/admin/custom-pages/{id}/{language}/edit', 'BackEnd\CustomPageController@edit')->name('admin.custom_pages.edit_page');
Route::post('/admin/custom-pages/update', 'BackEnd\CustomPageController@update')->name('admin.custom_pages.update');
Route::delete('/admin/custom-pages/{id}', 'BackEnd\CustomPageController@destroy')->name('admin.custom_pages.delete_page');

// Blog management routes
Route::get('/admin/blog-categories/{language}', 'BackEnd\Journal\CategoryController@index')->name('admin.blog_management.categories');
Route::get('/admin/blog-categories/{language}/create', 'BackEnd\Journal\CategoryController@create')->name('admin.blog_management.create_category');
Route::post('/admin/blog-categories/store', 'BackEnd\Journal\CategoryController@store')->name('admin.blog_management.store_category');
Route::get('/admin/blog-categories/{id}/{language}/edit', 'BackEnd\Journal\CategoryController@edit')->name('admin.blog_management.edit_category');
Route::match(['post', 'put'], '/admin/blog-categories/update', 'BackEnd\Journal\CategoryController@update')->name('admin.blog_management.update_category');
Route::delete('/admin/blog-categories/{id}', 'BackEnd\Journal\CategoryController@destroy')->name('admin.blog_management.delete_category');
Route::post('/admin/blog-categories/bulk-delete', 'BackEnd\Journal\CategoryController@bulkDelete')->name('admin.blog_management.bulk_delete_category');
Route::get('/admin/blogs/{language}', 'BackEnd\Journal\BlogController@index')->name('admin.blog_management.blogs');
Route::get('/admin/blogs/{language}/create', 'BackEnd\Journal\BlogController@create')->name('admin.blog_management.create_blog');
Route::post('/admin/blogs/store', 'BackEnd\Journal\BlogController@store')->name('admin.blog_management.store_blog');
Route::get('/admin/blogs/{id}/{language}/edit', 'BackEnd\Journal\BlogController@edit')->name('admin.blog_management.edit_blog');
Route::post('/admin/blogs/update', 'BackEnd\Journal\BlogController@update')->name('admin.blog_management.update_blog');
Route::delete('/admin/blogs/{id}', 'BackEnd\Journal\BlogController@destroy')->name('admin.blog_management.delete_blog');
Route::post('/admin/blogs/bulk-delete', 'BackEnd\Journal\BlogController@bulkDelete')->name('admin.blog_management.bulk_delete_blog');

// FAQ management
Route::get('/admin/faqs/{language}', 'BackEnd\FaqController@index')->name('admin.faq_management');
Route::get('/admin/faqs/{language}/create', 'BackEnd\FaqController@create')->name('admin.faq_management.create');
Route::post('/admin/faqs/store', 'BackEnd\FaqController@store')->name('admin.faq_management.store_faq');
Route::get('/admin/faqs/{id}/{language}/edit', 'BackEnd\FaqController@edit')->name('admin.faq_management.edit');
Route::post('/admin/faqs/update', 'BackEnd\FaqController@update')->name('admin.faq_management.update_faq');
Route::delete('/admin/faqs/{id}', 'BackEnd\FaqController@destroy')->name('admin.faq_management.delete_faq');
Route::post('/admin/faqs/bulk-delete', 'BackEnd\FaqController@bulkDelete')->name('admin.faq_management.bulk_delete_faq');

// Advertisements
Route::get('/admin/advertisements', 'BackEnd\AdvertisementController@index')->name('admin.advertise.advertisements');
Route::get('/admin/advertisements/create', 'BackEnd\AdvertisementController@create')->name('admin.advertise.create_advertisement');
Route::post('/admin/advertisements', 'BackEnd\AdvertisementController@store')->name('admin.advertise.store_advertisement');
Route::get('/admin/advertisements/{id}/edit', 'BackEnd\AdvertisementController@edit')->name('admin.advertise.edit_advertisement');
Route::post('/admin/advertisements/update', 'BackEnd\AdvertisementController@update')->name('admin.advertise.update_advertisement');
Route::delete('/admin/advertisements/{id}', 'BackEnd\AdvertisementController@destroy')->name('admin.advertise.delete_advertisement');
Route::delete('/admin/advertisements/{id}', 'BackEnd\AdvertisementController@destroy')->name('admin.advertise.delete_advertisement');
Route::post('/admin/advertisements/bulk-delete', 'BackEnd\AdvertisementController@bulkDelete')->name('admin.advertise.bulk_delete_advertisement');

// Announcements/Popups
Route::get('/admin/announcement-popups/{language}', 'BackEnd\PopupController@index')->name('admin.announcement_popups');
Route::get('/admin/announcement-popups/select-type', 'BackEnd\PopupController@popupType')->name('admin.announcement_popups.select_popup_type');
Route::get('/admin/announcement-popups/create/{type}/{language}', 'BackEnd\PopupController@create')->name('admin.announcement_popups.create');
Route::post('/admin/announcement-popups/store', 'BackEnd\PopupController@store')->name('admin.announcement_popups.store');
Route::get('/admin/announcement-popups/{id}/edit/{language}', 'BackEnd\PopupController@edit')->name('admin.announcement_popups.edit_popup');
Route::post('/admin/announcement-popups/update', 'BackEnd\PopupController@update')->name('admin.announcement_popups.update');
Route::post('/admin/announcement-popups/{id}/update', 'BackEnd\PopupController@update')->name('admin.announcement_popups.update_popup');
Route::post('/admin/announcement-popups/{id}/update-status', 'BackEnd\PopupController@updateStatus')->name('admin.announcement_popups.update_popup_status');
Route::delete('/admin/announcement-popups/{id}', 'BackEnd\PopupController@destroy')->name('admin.announcement_popups.delete_popup');
Route::post('/admin/announcement-popups/bulk-delete', 'BackEnd\PopupController@bulkDelete')->name('admin.announcement_popups.bulk_delete_popup');

// Payment gateways
Route::get('/admin/online-gateways', 'BackEnd\PaymentGateway\OnlineGatewayController@index')->name('admin.payment_gateways.online_gateways');
Route::post('/admin/payment-gateways/update-paypal', 'BackEnd\PaymentGateway\OnlineGatewayController@updatePayPalInfo')->name('admin.payment_gateways.update_paypal_info');
Route::post('/admin/payment-gateways/update-instamojo', 'BackEnd\PaymentGateway\OnlineGatewayController@updateInstamojoInfo')->name('admin.payment_gateways.update_instamojo_info');
Route::post('/admin/payment-gateways/update-paystack', 'BackEnd\PaymentGateway\OnlineGatewayController@updatePaystackInfo')->name('admin.payment_gateways.update_paystack_info');
Route::post('/admin/payment-gateways/update-flutterwave', 'BackEnd\PaymentGateway\OnlineGatewayController@updateFlutterwaveInfo')->name('admin.payment_gateways.update_flutterwave_info');
Route::post('/admin/payment-gateways/update-razorpay', 'BackEnd\PaymentGateway\OnlineGatewayController@updateRazorpayInfo')->name('admin.payment_gateways.update_razorpay_info');
Route::post('/admin/payment-gateways/update-mercadopago', 'BackEnd\PaymentGateway\OnlineGatewayController@updateMercadoPagoInfo')->name('admin.payment_gateways.update_mercadopago_info');
Route::post('/admin/payment-gateways/update-mollie', 'BackEnd\PaymentGateway\OnlineGatewayController@updateMollieInfo')->name('admin.payment_gateways.update_mollie_info');
Route::post('/admin/payment-gateways/update-stripe', 'BackEnd\PaymentGateway\OnlineGatewayController@updateStripeInfo')->name('admin.payment_gateways.update_stripe_info');
Route::post('/admin/payment-gateways/update-paytm', 'BackEnd\PaymentGateway\OnlineGatewayController@updatePaytmInfo')->name('admin.payment_gateways.update_paytm_info');
Route::get('/admin/offline-gateways', 'BackEnd\PaymentGateway\OfflineGatewayController@index')->name('admin.payment_gateways.offline_gateways');
Route::post('/admin/payment-gateways/store-offline-gateway', 'BackEnd\PaymentGateway\OfflineGatewayController@store')->name('admin.payment_gateways.store_offline_gateway');
Route::post('/admin/payment-gateways/update-status/{id}', 'BackEnd\PaymentGateway\OfflineGatewayController@updateStatus')->name('admin.payment_gateways.update_status');
Route::post('/admin/payment-gateways/update-offline-gateway', 'BackEnd\PaymentGateway\OfflineGatewayController@update')->name('admin.payment_gateways.update_offline_gateway');
Route::delete('/admin/payment-gateways/delete-offline-gateway/{id}', 'BackEnd\PaymentGateway\OfflineGatewayController@destroy')->name('admin.payment_gateways.delete_offline_gateway');

// Basic settings routes
Route::get('/admin/settings/favicon', 'BackEnd\BasicSettings\BasicController@favicon')->name('admin.basic_settings.favicon');
Route::get('/admin/settings/logo', 'BackEnd\BasicSettings\BasicController@logo')->name('admin.basic_settings.logo');
Route::get('/admin/settings/information', 'BackEnd\BasicSettings\BasicController@information')->name('admin.basic_settings.information');
Route::get('/admin/settings/theme-and-home', 'BackEnd\BasicSettings\BasicController@themeAndHome')->name('admin.basic_settings.theme_and_home');
Route::get('/admin/settings/currency', 'BackEnd\BasicSettings\BasicController@currency')->name('admin.basic_settings.currency');
Route::get('/admin/settings/appearance', 'BackEnd\BasicSettings\BasicController@appearance')->name('admin.basic_settings.appearance');
Route::get('/admin/settings/mail-from-admin', 'BackEnd\BasicSettings\BasicController@mailFromAdmin')->name('admin.basic_settings.mail_from_admin');
Route::get('/admin/settings/mail-to-admin', 'BackEnd\BasicSettings\BasicController@mailToAdmin')->name('admin.basic_settings.mail_to_admin');
Route::get('/admin/settings/mail-templates', 'BackEnd\BasicSettings\MailTemplateController@index')->name('admin.basic_settings.mail_templates');
Route::get('/admin/settings/breadcrumb', 'BackEnd\BasicSettings\BasicController@breadcrumb')->name('admin.basic_settings.breadcrumb');
Route::get('/admin/settings/page-headings/{language}', 'BackEnd\BasicSettings\PageHeadingController@pageHeadings')->name('admin.basic_settings.page_headings');
Route::get('/admin/settings/plugins', 'BackEnd\BasicSettings\BasicController@plugins')->name('admin.basic_settings.plugins');
Route::get('/admin/settings/seo/{language}', 'BackEnd\BasicSettings\SEOController@index')->name('admin.basic_settings.seo');
Route::get('/admin/settings/maintenance-mode', 'BackEnd\BasicSettings\BasicController@maintenance')->name('admin.basic_settings.maintenance_mode');
Route::get('/admin/settings/cookie-alert/{language}', 'BackEnd\BasicSettings\CookieAlertController@cookieAlert')->name('admin.basic_settings.cookie_alert');
Route::get('/admin/settings/footer-logo', 'BackEnd\BasicSettings\BasicController@footerLogo')->name('admin.basic_settings.footer_logo');
Route::get('/admin/settings/social-medias', 'BackEnd\BasicSettings\SocialMediaController@index')->name('admin.basic_settings.social_medias');

// Basic settings update routes
Route::post('/admin/settings/update-favicon', 'BackEnd\BasicSettings\BasicController@updateFavicon')->name('admin.basic_settings.update_favicon');
Route::post('/admin/settings/update-logo', 'BackEnd\BasicSettings\BasicController@updateLogo')->name('admin.basic_settings.update_logo');
Route::post('/admin/settings/update-info', 'BackEnd\BasicSettings\BasicController@updateInfo')->name('admin.basic_settings.update_info');
Route::post('/admin/settings/update-theme-and-home', 'BackEnd\BasicSettings\BasicController@updateThemeAndHome')->name('admin.basic_settings.update_theme_and_home');
Route::post('/admin/settings/update-currency', 'BackEnd\BasicSettings\BasicController@updateCurrency')->name('admin.basic_settings.update_currency');
Route::post('/admin/settings/update-appearance', 'BackEnd\BasicSettings\BasicController@updateAppearance')->name('admin.basic_settings.update_appearance');
Route::post('/admin/settings/update-mail-from-admin', 'BackEnd\BasicSettings\BasicController@updateMailFromAdmin')->name('admin.basic_settings.update_mail_from_admin');
Route::post('/admin/settings/update-mail-to-admin', 'BackEnd\BasicSettings\BasicController@updateMailToAdmin')->name('admin.basic_settings.update_mail_to_admin');
Route::post('/admin/settings/update-breadcrumb', 'BackEnd\BasicSettings\BasicController@updateBreadcrumb')->name('admin.basic_settings.update_breadcrumb');
Route::post('/admin/settings/update-disqus', 'BackEnd\BasicSettings\BasicController@updateDisqus')->name('admin.basic_settings.update_disqus');
Route::post('/admin/settings/update-recaptcha', 'BackEnd\BasicSettings\BasicController@updateRecaptcha')->name('admin.basic_settings.update_recaptcha');
Route::post('/admin/settings/update-seo', 'BackEnd\BasicSettings\SEOController@update')->name('admin.basic_settings.update_seo');
Route::post('/admin/settings/update-maintenance-mode', 'BackEnd\BasicSettings\BasicController@updateMaintenance')->name('admin.basic_settings.update_maintenance_mode');
Route::post('/admin/settings/update-cookie-alert', 'BackEnd\BasicSettings\CookieAlertController@updateCookieAlert')->name('admin.basic_settings.update_cookie_alert');
Route::post('/admin/settings/update-footer-logo', 'BackEnd\BasicSettings\BasicController@updateFooterLogo')->name('admin.basic_settings.update_footer_logo');
Route::post('/admin/settings/update-page-headings', 'BackEnd\BasicSettings\PageHeadingController@updatePageHeadings')->name('admin.basic_settings.update_page_headings');
Route::get('/admin/settings/mail-templates/{id}/edit', 'BackEnd\BasicSettings\MailTemplateController@edit')->name('admin.basic_settings.edit_mail_template');
Route::post('/admin/settings/mail-templates/{id}/update', 'BackEnd\BasicSettings\MailTemplateController@update')->name('admin.basic_settings.update_mail_template');
Route::post('/admin/settings/social-medias', 'BackEnd\BasicSettings\SocialMediaController@store')->name('admin.basic_settings.store_social_media');
Route::match(['post', 'put'], '/admin/settings/social-medias/update', 'BackEnd\BasicSettings\SocialMediaController@update')->name('admin.basic_settings.update_social_media');
Route::delete('/admin/settings/social-medias/{id}', 'BackEnd\BasicSettings\SocialMediaController@destroy')->name('admin.basic_settings.delete_social_media');

// Admin management routes
Route::get('/admin/role-permissions', 'BackEnd\Administrator\RolePermissionController@index')->name('admin.admin_management.role_permissions');
Route::get('/admin/role-permissions/create', 'BackEnd\Administrator\RolePermissionController@create')->name('admin.admin_management.create_role');
Route::post('/admin/role-permissions', 'BackEnd\Administrator\RolePermissionController@store')->name('admin.admin_management.store_role');
Route::get('/admin/role-permissions/{id}', 'BackEnd\Administrator\RolePermissionController@show')->name('admin.admin_management.role.permissions');
Route::post('/admin/role-permissions/update', 'BackEnd\Administrator\RolePermissionController@update')->name('admin.admin_management.update_role');
Route::delete('/admin/role-permissions/{id}', 'BackEnd\Administrator\RolePermissionController@destroy')->name('admin.admin_management.delete_role');
Route::get('/admin/admins', 'BackEnd\Administrator\SiteAdminController@index')->name('admin.admin_management.registered_admins');
Route::get('/admin/admins/create', 'BackEnd\Administrator\SiteAdminController@create')->name('admin.admin_management.create_admin');
Route::post('/admin/admins', 'BackEnd\Administrator\SiteAdminController@store')->name('admin.admin_management.store_admin');
Route::post('/admin/admins/update', 'BackEnd\Administrator\SiteAdminController@update')->name('admin.admin_management.update_admin');
Route::post('/admin/admins/{id}/update-status', 'BackEnd\Administrator\SiteAdminController@updateStatus')->name('admin.admin_management.admin.update_status');
Route::delete('/admin/admins/{id}', 'BackEnd\Administrator\SiteAdminController@destroy')->name('admin.admin_management.delete_admin');

// Language management
Route::get('/admin/languages', 'BackEnd\LanguageController@index')->name('admin.language_management');
Route::get('/admin/languages/create', 'BackEnd\LanguageController@create')->name('admin.language_management.create');
Route::post('/admin/languages', 'BackEnd\LanguageController@store')->name('admin.language_management.store_language');
Route::get('/admin/languages/{id}/edit', 'BackEnd\LanguageController@edit')->name('admin.language_management.edit_keyword');
Route::post('/admin/languages/update', 'BackEnd\LanguageController@update')->name('admin.language_management.update_language');
Route::post('/admin/languages/{id}/update-keyword', 'BackEnd\LanguageController@updateKeyword')->name('admin.language_management.update_keyword');
Route::post('/admin/languages/{id}/make-default', 'BackEnd\LanguageController@makeDefault')->name('admin.language_management.make_default_language');
Route::delete('/admin/languages/{id}', 'BackEnd\LanguageController@destroy')->name('admin.language_management.delete_language');
