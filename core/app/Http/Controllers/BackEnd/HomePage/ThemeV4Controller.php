<?php

namespace App\Http\Controllers\BackEnd\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadFile;
use App\Models\ThemeV4HeroSetting;
use App\Models\ThemeV4SearchSetting;
use App\Models\ThemeV4CtaSetting;
use App\Models\ThemeV4AboutSetting;
use App\Models\ThemeV4CustomContent;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ThemeV4Controller extends Controller
{
  public function heroSettings()
  {
    $data = ThemeV4HeroSetting::first() ?? new ThemeV4HeroSetting();
    return view('backend.home-page.theme-v4.hero-settings', ['data' => $data]);
  }

  public function updateHeroSettings(Request $request)
  {
    $rules = [
      'title' => 'required|max:200',
      'subtitle' => 'required|max:500',
      'description' => 'required|max:1000',
      'button_1_text' => 'max:100',
      'button_1_url' => 'max:500',
      'button_2_text' => 'max:100',
      'button_2_url' => 'max:500',
    ];

    if ($request->hasFile('background_image')) {
      $rules['background_image'] = new ImageMimeTypeRule();
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $data = ThemeV4HeroSetting::first();

    if (!$data) {
      $data = new ThemeV4HeroSetting();
    }

    if ($request->hasFile('background_image')) {
      if ($data->background_image) {
        UploadFile::delete('./assets/img/hero-section/', $data->background_image);
      }
      $imageName = UploadFile::store('./assets/img/hero-section/', $request->file('background_image'));
      $data->background_image = $imageName;
    }

    $data->title = $request->title;
    $data->subtitle = $request->subtitle;
    $data->description = $request->description;
    $data->button_1_text = $request->button_1_text;
    $data->button_1_url = $request->button_1_url;
    $data->button_2_text = $request->button_2_text;
    $data->button_2_url = $request->button_2_url;
    $data->gradient_color_1 = $request->gradient_color_1 ? ltrim($request->gradient_color_1, '#') : '1866d4';
    $data->gradient_color_2 = $request->gradient_color_2 ? ltrim($request->gradient_color_2, '#') : '580ce3';
    $data->status = $request->has('status') ? 1 : 0;
    $data->save();

    $request->session()->flash('success', 'Hero section updated successfully!');
    return redirect()->back();
  }

  public function searchSettings()
  {
    $data = ThemeV4SearchSetting::first() ?? new ThemeV4SearchSetting();
    return view('backend.home-page.theme-v4.search-settings', ['data' => $data]);
  }

  public function updateSearchSettings(Request $request)
  {
    $rules = [
      'title' => 'required|max:200',
      'subtitle' => 'max:500',
      'search_placeholder' => 'max:100',
      'category_placeholder' => 'max:100',
      'button_text' => 'max:50',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $data = ThemeV4SearchSetting::first();

    if (!$data) {
      $data = new ThemeV4SearchSetting();
    }

    $data->title = $request->title;
    $data->subtitle = $request->subtitle;
    $data->search_placeholder = $request->search_placeholder;
    $data->category_placeholder = $request->category_placeholder;
    $data->button_text = $request->button_text;
    $data->status = $request->has('status') ? 1 : 0;
    $data->save();

    $request->session()->flash('success', 'Search section updated successfully!');
    return redirect()->back();
  }

  public function ctaSettings()
  {
    $data = ThemeV4CtaSetting::first() ?? new ThemeV4CtaSetting();
    return view('backend.home-page.theme-v4.cta-settings', ['data' => $data]);
  }

  public function updateCtaSettings(Request $request)
  {
    $rules = [
      'title' => 'required|max:200',
      'subtitle' => 'max:500',
      'description' => 'max:1000',
      'button_1_text' => 'max:100',
      'button_1_url' => 'max:500',
      'button_2_text' => 'max:100',
      'button_2_url' => 'max:500',
    ];

    if ($request->hasFile('background_image')) {
      $rules['background_image'] = new ImageMimeTypeRule();
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $data = ThemeV4CtaSetting::first();

    if (!$data) {
      $data = new ThemeV4CtaSetting();
    }

    if ($request->hasFile('background_image')) {
      if ($data->background_image) {
        UploadFile::delete('./assets/img/action-section/', $data->background_image);
      }
      $imageName = UploadFile::store('./assets/img/action-section/', $request->file('background_image'));
      $data->background_image = $imageName;
    }

    $data->title = $request->title;
    $data->subtitle = $request->subtitle;
    $data->description = $request->description;
    $data->button_1_text = $request->button_1_text;
    $data->button_1_url = $request->button_1_url;
    $data->button_2_text = $request->button_2_text;
    $data->button_2_url = $request->button_2_url;
    $data->gradient_color_1 = $request->gradient_color_1 ? ltrim($request->gradient_color_1, '#') : '1866d4';
    $data->gradient_color_2 = $request->gradient_color_2 ? ltrim($request->gradient_color_2, '#') : '580ce3';
    $data->status = $request->has('status') ? 1 : 0;
    $data->save();

    $request->session()->flash('success', 'CTA section updated successfully!');
    return redirect()->back();
  }

  public function aboutSettings()
  {
    $data = ThemeV4AboutSetting::first() ?? new ThemeV4AboutSetting();
    return view('backend.home-page.theme-v4.about-settings', ['data' => $data]);
  }

  public function updateAboutSettings(Request $request)
  {
    $rules = [
      'title' => 'required|max:200',
      'subtitle' => 'max:500',
      'description' => 'max:1000',
    ];

    if ($request->hasFile('image')) {
      $rules['image'] = new ImageMimeTypeRule();
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $data = ThemeV4AboutSetting::first();

    if (!$data) {
      $data = new ThemeV4AboutSetting();
    }

    if ($request->hasFile('image')) {
      if ($data->image) {
        UploadFile::delete('./assets/img/about-section/', $data->image);
      }
      $imageName = UploadFile::store('./assets/img/about-section/', $request->file('image'));
      $data->image = $imageName;
    }

    $data->title = $request->title;
    $data->subtitle = $request->subtitle;
    $data->description = $request->description;
    $data->button_text = $request->button_text;
    $data->button_url = $request->button_url;
    $data->status = $request->has('status') ? 1 : 0;
    $data->save();

    $request->session()->flash('success', 'About section updated successfully!');
    return redirect()->back();
  }
}
