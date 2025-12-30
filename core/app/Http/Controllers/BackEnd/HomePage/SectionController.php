<?php

namespace App\Http\Controllers\BackEnd\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionStatusRequest;
use App\Models\HomePage\Section;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
  public function index(Request $request)
  {
    $sectionInfo = Section::first();

    $themeInfo = DB::table('basic_settings')->select('theme_version')->first();

    // Get the current route name to determine which view to show
    $routeName = \Route::currentRouteName();

    switch ($routeName) {
      case 'admin.home_page.hero_section':
        $language = Language::where('code', $request->language)->first();
        if (!$language) {
          $language = Language::getDefaultLanguage();
        }
        $information['language'] = $language;
        $information['data'] = $language ? $language->heroSec()->first() : null;
        $information['langs'] = Language::all();
        $information['themeInfo'] = $themeInfo;
        return view('backend.home-page.hero-section', $information);
      case 'admin.home_page.action_section':
        $view = 'backend.home-page.action-section';
        break;
      case 'admin.home_page.features_section':
        $language = Language::where('code', $request->language)->first();
        if (!$language) {
          $language = Language::getDefaultLanguage();
        }
        $information['language'] = $language;
        $information['data'] = DB::table('basic_settings')->select('features_section_image')->first();
        $information['features'] = $language ? $language->feature()->orderByDesc('id')->get() : collect();
        $information['langs'] = Language::all();
        $information['themeInfo'] = $themeInfo;
        $information['sectionInfo'] = $sectionInfo;
        return view('backend.home-page.feature-section.index', $information);
      case 'admin.home_page.fun_facts_section':
        $language = Language::where('code', $request->language)->first();
        if (!$language) {
          $language = Language::getDefaultLanguage();
        }
        $information['language'] = $language;
        $information['data'] = $language ? $language->funFactSec()->first() : null;
        $information['countInfos'] = $language ? $language->countInfo()->orderByDesc('id')->get() : collect();
        $information['langs'] = Language::all();
        $information['themeInfo'] = $themeInfo;
        $information['sectionInfo'] = $sectionInfo;
        return view('backend.home-page.fun-fact-section.index', $information);
      case 'admin.home_page.about_us_section':
        $view = 'backend.home-page.about-us-section';
        break;
      case 'admin.home_page.course_categories_section':
        $information['data'] = DB::table('basic_settings')->select('course_categories_section_image')->first();
        $information['themeInfo'] = $themeInfo;
        $information['sectionInfo'] = $sectionInfo;
        return view('backend.home-page.course-category-section', $information);
      case 'admin.home_page.section_customization':
      default:
        $view = 'backend.home-page.section-customization';
        break;
    }

    return view($view, compact('sectionInfo', 'themeInfo'));
  }

  public function update(SectionStatusRequest $request)
  {
    $sectionInfo = Section::first();

    if (empty($sectionInfo)) {
      Section::query()->create($request->all());
    } else {
      $sectionInfo->update($request->all());
    }

    $request->session()->flash('success', 'Section status updated successfully!');

    return redirect()->back();
  }
}
