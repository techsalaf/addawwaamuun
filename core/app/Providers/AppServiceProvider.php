<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!file_exists('core/storage/installed') && !request()->is('install') && !request()->is('install/*')) {
            header("Location: install/");
            exit;
        }

        View::composer('*', function ($view) {
            $websiteInfo = DB::table('basic_settings')->first();
            $settings = DB::table('basic_settings')->first();
            $footerTextInfo = DB::table('basic_settings')->first();
            $defaultLang = DB::table('languages')->where('is_default', 1)->first();
            
            $locale = null;
            if (\Session::has('currentLocaleCode')) {
                $locale = \Session::get('currentLocaleCode');
            }
            if (empty($locale)) {
                $currentLanguageInfo = DB::table('languages')->where('is_default', 1)->first();
            } else {
                $currentLanguageInfo = DB::table('languages')->where('code', $locale)->first();
                if (empty($currentLanguageInfo)) {
                    $currentLanguageInfo = DB::table('languages')->where('is_default', 1)->first();
                }
            }
            
            $basicInfo = $websiteInfo;
            $footerInfo = $currentLanguageInfo ? DB::table('footer_contents')->where('language_id', $currentLanguageInfo->id)->first() : (object)[] ;
            $language = $currentLanguageInfo ?: $defaultLang;
            
            $roleInfo = null;
            $user = \Auth::guard('admin')->user();
            if ($user) {
                $roleInfo = $user->role;
            }
            
            $allLanguageInfos = DB::table('languages')->get();
            
            $socialMediaInfos = DB::table('social_medias')->orderBy('serial_number', 'asc')->get();
            
            $popupInfos = $currentLanguageInfo ? DB::table('popups')->where('language_id', $currentLanguageInfo->id)->where('status', 1)->get() : collect();
            
            $cookieAlertInfo = $currentLanguageInfo ? DB::table('cookie_alerts')->where('language_id', $currentLanguageInfo->id)->first() : (object)[];
            
            $footerSecStatus = 1;
            
            $quickLinkInfos = $currentLanguageInfo ? DB::table('quick_links')->where('language_id', $currentLanguageInfo->id)->orderBy('serial_number', 'asc')->get() : collect();
            
            $latestBlogInfos = $currentLanguageInfo ? DB::table('blogs')
                ->join('blog_informations', 'blogs.id', '=', 'blog_informations.blog_id')
                ->where('blog_informations.language_id', '=', $currentLanguageInfo->id)
                ->select('blogs.image', 'blogs.created_at', 'blog_informations.title', 'blog_informations.slug')
                ->orderByDesc('blogs.created_at')
                ->limit(3)
                ->get() : collect();

            $menuInfo = $currentLanguageInfo ? DB::table('menu_builders')->where('language_id', $currentLanguageInfo->id)->first() : null;
            $menuInfos = $menuInfo ? $menuInfo->menus : '[]';

            $contactInfo = $currentLanguageInfo ? DB::table('contact_infos')->where('language_id', $currentLanguageInfo->id)->first() : (object)[];
            
            $view->with([
                'websiteInfo' => $websiteInfo,
                'settings' => $settings,
                'footerTextInfo' => $footerTextInfo,
                'defaultLang' => $defaultLang,
                'roleInfo' => $roleInfo,
                'currentLanguageInfo' => $currentLanguageInfo,
                'basicInfo' => $basicInfo,
                'footerInfo' => $footerInfo,
                'language' => $language,
                'allLanguageInfos' => $allLanguageInfos,
                'socialMediaInfos' => $socialMediaInfos,
                'popupInfos' => $popupInfos,
                'cookieAlertInfo' => $cookieAlertInfo,
                'footerSecStatus' => $footerSecStatus,
                'quickLinkInfos' => $quickLinkInfos,
                'latestBlogInfos' => $latestBlogInfos,
                'menuInfos' => $menuInfos,
                'contactInfo' => $contactInfo,
            ]);
        });
    }
}
