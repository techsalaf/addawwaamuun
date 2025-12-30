<?php

namespace App\Listeners;

use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;

class CreateDefaultRoutes
{
    public function handle(LaravelInstallerFinished $event)
    {
        $routesPath = base_path('routes/web.php');
        
        if (!file_exists($routesPath)) {
            $content = <<<'EOT'
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
Route::post('/store-subscriber', 'Controller@storeSubscriber')->name('store_subscriber');
Route::get('/login', 'FrontEnd\UserController@login')->name('user.login');
Route::post('/login', 'FrontEnd\UserController@loginSubmit')->name('user.login_submit');
Route::get('/signup', 'FrontEnd\UserController@signup')->name('user.signup');
Route::post('/signup', 'FrontEnd\UserController@signupSubmit')->name('user.signup_submit');
Route::get('/instructors', 'FrontEnd\InstructorController@index')->name('instructors');
Route::get('/blogs', 'FrontEnd\BlogController@index')->name('blogs');
Route::get('/blog/{slug}', 'FrontEnd\BlogController@details')->name('blog_details');
Route::get('/faqs', 'FrontEnd\FaqController@index')->name('faqs');
Route::get('/contact', 'FrontEnd\ContactController@index')->name('contact');
Route::get('/page/{slug}', 'FrontEnd\PageController@page')->name('dynamic_page');
Route::get('/change-language', 'Controller@changeLanguage')->name('change_language');

// Admin routes
Route::get('/admin', function () {
  return redirect('/admin/login');
});
Route::get('/admin/login', 'BackEnd\AdminController@login')->name('admin.login');
Route::post('/admin/login', 'BackEnd\AdminController@authentication')->name('admin.login_submit');
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
Route::get('/admin/course-categories/{language}', 'BackEnd\Curriculum\CategoryController@index')->name('admin.course_management.categories');
Route::get('/admin/course-categories/{language}/create', 'BackEnd\Curriculum\CategoryController@create')->name('admin.course_management.create_category');
Route::post('/admin/course-categories/store', 'BackEnd\Curriculum\CategoryController@store')->name('admin.course_management.store_category');
Route::get('/admin/course-categories/{id}/{language}/edit', 'BackEnd\Curriculum\CategoryController@edit')->name('admin.course_management.edit_category');
Route::post('/admin/course-categories/update', 'BackEnd\Curriculum\CategoryController@update')->name('admin.course_management.update_category');
Route::delete('/admin/course-categories/{id}', 'BackEnd\Curriculum\CategoryController@destroy')->name('admin.course_management.delete_category');
Route::post('/admin/course-categories/bulk-delete', 'BackEnd\Curriculum\CategoryController@bulkDelete')->name('admin.course_management.bulk_delete_category');
Route::get('/admin/course-enrolments', 'BackEnd\Curriculum\EnrolmentController@index')->name('admin.course_enrolments');
Route::get('/admin/course-enrolments/{id}', 'BackEnd\Curriculum\EnrolmentController@show')->name('admin.course_enrolment.details');
Route::post('/admin/course-enrolments/bulk-delete', 'BackEnd\Curriculum\EnrolmentController@bulkDelete')->name('admin.course_enrolments.bulk_delete');

// Admin instructor routes
Route::get('/admin/instructors/{language}', 'BackEnd\Teacher\InstructorController@index')->name('admin.instructors');
Route::get('/admin/instructors/create', 'BackEnd\Teacher\InstructorController@create')->name('admin.create_instructor');
Route::post('/admin/instructors/store', 'BackEnd\Teacher\InstructorController@store')->name('admin.store_instructor');
Route::get('/admin/instructors/{id}/edit', 'BackEnd\Teacher\InstructorController@edit')->name('admin.edit_instructor');
Route::post('/admin/instructors/update', 'BackEnd\Teacher\InstructorController@update')->name('admin.update_instructor');
Route::delete('/admin/instructors/{id}', 'BackEnd\Teacher\InstructorController@destroy')->name('admin.delete_instructor');
Route::post('/admin/instructors/bulk-delete', 'BackEnd\Teacher\InstructorController@bulkDestroy')->name('admin.bulk_delete_instructor');
Route::post('/admin/instructors/{id}/update-featured', 'BackEnd\Teacher\InstructorController@updateFeatured')->name('admin.instructor.update_featured');
Route::get('/admin/instructors/{id}/social-links', 'BackEnd\Teacher\InstructorController@socialLinks')->name('admin.instructor.social_links');

// Admin blog management routes
Route::get('/admin/blogs/{language}', 'BackEnd\Journal\BlogController@index')->name('admin.blog_management.blogs');

// Admin user management routes
Route::get('/admin/users', 'BackEnd\User\UserController@index')->name('admin.user_management.registered_users');
Route::post('/admin/users/{id}/update-email-status', 'BackEnd\User\UserController@updateEmailStatus')->name('admin.user_management.user.update_email_status');
Route::post('/admin/users/bulk-delete', 'BackEnd\User\UserController@bulkDelete')->name('admin.user_management.bulk_delete_user');
Route::get('/admin/subscribers', 'BackEnd\User\SubscriberController@index')->name('admin.user_management.subscribers');
Route::post('/admin/subscribers/bulk-delete', 'BackEnd\User\SubscriberController@bulkDestroy')->name('admin.user_management.bulk_delete_subscriber');
Route::get('/admin/push-notification-settings', 'BackEnd\User\PushNotificationController@settings')->name('admin.user_management.push_notification.settings');
Route::post('/admin/push-notification-settings/update', 'BackEnd\User\PushNotificationController@updateSettings')->name('admin.user_management.push_notification.update_settings');
Route::get('/admin/push-notification-visitors', 'BackEnd\User\PushNotificationController@writeNotification')->name('admin.user_management.push_notification.notification_for_visitors');

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
Route::get('/admin/home-page/section-titles/{language}', 'BackEnd\HomePage\SectionTitleController@index')->name('admin.home_page.section_titles');
Route::get('/admin/home-page/action-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.action_section');
Route::get('/admin/home-page/features-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.features_section');
Route::get('/admin/home-page/video-section/{language}', 'BackEnd\HomePage\VideoController@index')->name('admin.home_page.video_section');
Route::get('/admin/home-page/fun-facts-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.fun_facts_section');
Route::get('/admin/home-page/testimonials-section/{language}', 'BackEnd\HomePage\TestimonialController@index')->name('admin.home_page.testimonials_section');
Route::get('/admin/home-page/newsletter-section/{language}', 'BackEnd\HomePage\NewsletterController@index')->name('admin.home_page.newsletter_section');
Route::get('/admin/home-page/about-us-section/{language}', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.about_us_section');
Route::get('/admin/home-page/course-categories-section', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.course_categories_section');
Route::get('/admin/home-page/section-customization', 'BackEnd\HomePage\SectionController@index')->name('admin.home_page.section_customization');

// Footer routes
Route::get('/admin/footer-content/{language}', 'BackEnd\Footer\ContentController@index')->name('admin.footer.content');
Route::get('/admin/footer-quick-links/{language}', 'BackEnd\Footer\QuickLinkController@index')->name('admin.footer.quick_links');

// Custom pages
Route::get('/admin/custom-pages/{language}', 'BackEnd\CustomPageController@index')->name('admin.custom_pages');
Route::get('/admin/custom-pages/{language}/create', 'BackEnd\CustomPageController@create')->name('admin.custom_pages.create_page');
Route::post('/admin/custom-pages/store', 'BackEnd\CustomPageController@store')->name('admin.custom_pages.store');
Route::get('/admin/custom-pages/{id}/{language}/edit', 'BackEnd\CustomPageController@edit')->name('admin.custom_pages.edit');
Route::post('/admin/custom-pages/update', 'BackEnd\CustomPageController@update')->name('admin.custom_pages.update');
Route::delete('/admin/custom-pages/{id}', 'BackEnd\CustomPageController@destroy')->name('admin.custom_pages.delete');

// Blog management routes
Route::get('/admin/blog-categories/{language}', 'BackEnd\Journal\CategoryController@index')->name('admin.blog_management.categories');
Route::get('/admin/blog-categories/{language}/create', 'BackEnd\Journal\CategoryController@create')->name('admin.blog_management.create_category');
Route::post('/admin/blog-categories/store', 'BackEnd\Journal\CategoryController@store')->name('admin.blog_management.store_category');
Route::get('/admin/blog-categories/{id}/{language}/edit', 'BackEnd\Journal\CategoryController@edit')->name('admin.blog_management.edit_category');
Route::post('/admin/blog-categories/update', 'BackEnd\Journal\CategoryController@update')->name('admin.blog_management.update_category');
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
Route::post('/admin/faqs/store', 'BackEnd\FaqController@store')->name('admin.faq_management.store');
Route::get('/admin/faqs/{id}/{language}/edit', 'BackEnd\FaqController@edit')->name('admin.faq_management.edit');
Route::post('/admin/faqs/update', 'BackEnd\FaqController@update')->name('admin.faq_management.update');
Route::delete('/admin/faqs/{id}', 'BackEnd\FaqController@destroy')->name('admin.faq_management.delete_faq');
Route::post('/admin/faqs/bulk-delete', 'BackEnd\FaqController@bulkDelete')->name('admin.faq_management.bulk_delete_faq');

// Advertisements
Route::get('/admin/advertisements', 'BackEnd\AdvertisementController@index')->name('admin.advertise.advertisements');
Route::post('/admin/advertisements', 'BackEnd\AdvertisementController@store')->name('admin.advertise.store');
Route::post('/admin/advertisements/update', 'BackEnd\AdvertisementController@update')->name('admin.advertise.update');
Route::post('/admin/advertisements/bulk-delete', 'BackEnd\AdvertisementController@bulkDelete')->name('admin.advertise.bulk_delete_advertisement');

// Announcements/Popups
Route::get('/admin/announcement-popups/{language}', 'BackEnd\PopupController@index')->name('admin.announcement_popups');
Route::get('/admin/announcement-popups/select-type', 'BackEnd\PopupController@selectType')->name('admin.announcement_popups.select_popup_type');
Route::get('/admin/announcement-popups/create/{type}/{language}', 'BackEnd\PopupController@create')->name('admin.announcement_popups.create');
Route::post('/admin/announcement-popups/store', 'BackEnd\PopupController@store')->name('admin.announcement_popups.store');
Route::get('/admin/announcement-popups/{id}/edit/{language}', 'BackEnd\PopupController@edit')->name('admin.announcement_popups.edit');
Route::post('/admin/announcement-popups/update', 'BackEnd\PopupController@update')->name('admin.announcement_popups.update');
Route::delete('/admin/announcement-popups/{id}', 'BackEnd\PopupController@destroy')->name('admin.announcement_popups.delete');
Route::post('/admin/announcement-popups/bulk-delete', 'BackEnd\PopupController@bulkDelete')->name('admin.announcement_popups.bulk_delete_popup');

// Payment gateways
Route::get('/admin/online-gateways', 'BackEnd\PaymentGateway\OnlineGatewayController@index')->name('admin.payment_gateways.online_gateways');
Route::post('/admin/payment-gateways/update-paypal', 'BackEnd\PaymentGateway\OnlineGatewayController@updatePaypal')->name('admin.payment_gateways.update_paypal_info');
Route::post('/admin/payment-gateways/update-instamojo', 'BackEnd\PaymentGateway\OnlineGatewayController@updateInstamojo')->name('admin.payment_gateways.update_instamojo_info');
Route::post('/admin/payment-gateways/update-paystack', 'BackEnd\PaymentGateway\OnlineGatewayController@updatePaystack')->name('admin.payment_gateways.update_paystack_info');
Route::post('/admin/payment-gateways/update-flutterwave', 'BackEnd\PaymentGateway\OnlineGatewayController@updateFlutterwave')->name('admin.payment_gateways.update_flutterwave_info');
Route::post('/admin/payment-gateways/update-razorpay', 'BackEnd\PaymentGateway\OnlineGatewayController@updateRazorpay')->name('admin.payment_gateways.update_razorpay_info');
Route::post('/admin/payment-gateways/update-mercadopago', 'BackEnd\PaymentGateway\OnlineGatewayController@updateMercadopago')->name('admin.payment_gateways.update_mercadopago_info');
Route::post('/admin/payment-gateways/update-mollie', 'BackEnd\PaymentGateway\OnlineGatewayController@updateMollie')->name('admin.payment_gateways.update_mollie_info');
Route::post('/admin/payment-gateways/update-stripe', 'BackEnd\PaymentGateway\OnlineGatewayController@updateStripe')->name('admin.payment_gateways.update_stripe_info');
Route::post('/admin/payment-gateways/update-paytm', 'BackEnd\PaymentGateway\OnlineGatewayController@updatePaytm')->name('admin.payment_gateways.update_paytm_info');
Route::get('/admin/offline-gateways', 'BackEnd\PaymentGateway\OfflineGatewayController@index')->name('admin.payment_gateways.offline_gateways');
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
Route::post('/admin/settings/social-medias/update', 'BackEnd\BasicSettings\SocialMediaController@update')->name('admin.basic_settings.update_social_media');
Route::delete('/admin/settings/social-medias/{id}', 'BackEnd\BasicSettings\SocialMediaController@destroy')->name('admin.basic_settings.delete_social_media');

// Admin management routes
Route::get('/admin/role-permissions', 'BackEnd\Administrator\RolePermissionController@index')->name('admin.admin_management.role_permissions');
Route::get('/admin/role-permissions/create', 'BackEnd\Administrator\RolePermissionController@create')->name('admin.admin_management.create_role');
Route::post('/admin/role-permissions', 'BackEnd\Administrator\RolePermissionController@store')->name('admin.admin_management.store_role');
Route::get('/admin/role-permissions/{id}', 'BackEnd\Administrator\RolePermissionController@show')->name('admin.admin_management.role.permissions');
Route::delete('/admin/role-permissions/{id}', 'BackEnd\Administrator\RolePermissionController@destroy')->name('admin.admin_management.delete_role');
Route::get('/admin/admins', 'BackEnd\Administrator\SiteAdminController@index')->name('admin.admin_management.registered_admins');
Route::get('/admin/admins/create', 'BackEnd\Administrator\SiteAdminController@create')->name('admin.admin_management.create_admin');
Route::post('/admin/admins', 'BackEnd\Administrator\SiteAdminController@store')->name('admin.admin_management.store_admin');
Route::post('/admin/admins/{id}/update-status', 'BackEnd\Administrator\SiteAdminController@updateStatus')->name('admin.admin_management.admin.update_status');
Route::delete('/admin/admins/{id}', 'BackEnd\Administrator\SiteAdminController@destroy')->name('admin.admin_management.delete_admin');

// Language management
Route::get('/admin/languages', 'BackEnd\LanguageController@index')->name('admin.language_management');
Route::get('/admin/languages/create', 'BackEnd\LanguageController@create')->name('admin.language_management.create');
Route::post('/admin/languages', 'BackEnd\LanguageController@store')->name('admin.language_management.store_language');
Route::get('/admin/languages/{id}/edit', 'BackEnd\LanguageController@edit')->name('admin.language_management.edit_keyword');
Route::post('/admin/languages/{id}/update', 'BackEnd\LanguageController@update')->name('admin.language_management.update_keyword');
Route::post('/admin/languages/{id}/make-default', 'BackEnd\LanguageController@makeDefault')->name('admin.language_management.make_default_language');
Route::delete('/admin/languages/{id}', 'BackEnd\LanguageController@destroy')->name('admin.language_management.delete_language');
EOT;
            file_put_contents($routesPath, $content);
        }
    }
}
