<?php

namespace App\Http\Controllers\BackEnd\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadFile;
use App\Http\Requests\CountInformationRequest;
use App\Models\HomePage\Fact\CountInformation;
use App\Models\HomePage\Fact\FunFactSection;
use App\Models\Language;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FunFactController extends Controller
{
  public function index(Request $request)
  {
    $language = Language::where('code', $request->language)->first();
    if (!$language) {
      $language = Language::getDefaultLanguage();
    }
    $information['language'] = $language;

    $information['data'] = $language ? $language->funFactSec()->first() : null;

    $information['countInfos'] = $language ? $language->countInfo()->orderByDesc('id')->get() : collect();

    $information['langs'] = Language::all();

    $information['themeInfo'] = DB::table('basic_settings')->select('theme_version')->first();

    return view('backend.home-page.fun-fact-section.index', $information);
  }

  public function updateSection(Request $request)
  {
    $language = Language::where('code', $request->language)->first();
    if (!$language) {
      $language = Language::getDefaultLanguage();
    }

    $factInfo = $language->funFactSec()->first();

    $themeInfo = DB::table('basic_settings')->select('theme_version')->first();

    $rules = [];

    if ($themeInfo->theme_version == 1 || $themeInfo->theme_version == 2) {
      if (empty($factInfo->background_image)) {
        $rules['background_image'] = 'required';
      }
      if ($request->hasFile('background_image')) {
        $rules['background_image'] = new ImageMimeTypeRule();
      }
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    // store data in db start
    if (empty($factInfo)) {
      if ($themeInfo->theme_version == 1 || $themeInfo->theme_version == 2) {
        $backgroundImageName = UploadFile::store('./assets/img/fact-section/', $request->file('background_image'));
      }

      FunFactSection::create($request->except('language_id', 'background_image') + [
        'language_id' => $language->id,
        'background_image' => isset($backgroundImageName) ? $backgroundImageName : NULL
      ]);

      $request->session()->flash('success', 'Information added successfully!');

      return redirect()->back();
    } else {
      if ($themeInfo->theme_version == 1 || $themeInfo->theme_version == 2) {
        if ($request->hasFile('background_image')) {
          $backgroundImageName = UploadFile::update('./assets/img/fact-section/', $request->file('background_image'), $factInfo->background_image);
        }
      }

      $factInfo->update($request->except('background_image') + [
        'background_image' => isset($backgroundImageName) ? $backgroundImageName : $factInfo->background_image
      ]);

      $request->session()->flash('success', 'Information updated successfully!');

      return redirect()->back();
    }
  }


  public function store(CountInformationRequest $request)
  {
    CountInformation::create($request->all());

    $request->session()->flash('success', 'New information added successfully!');

    return response()->json(['status' => 'success'], 200);
  }

  public function update(CountInformationRequest $request)
  {
    CountInformation::find($request->id)->update($request->all());

    $request->session()->flash('success', 'Information updated successfully!');

    return response()->json(['status' => 'success'], 200);
  }

  public function destroy($id)
  {
    CountInformation::find($id)->delete();

    return redirect()->back()->with('success', 'Information deleted successfully!');
  }

  public function bulkDestroy(Request $request)
  {
    $ids = $request->ids;

    foreach ($ids as $id) {
      CountInformation::find($id)->delete();
    }

    $request->session()->flash('success', 'Informations deleted successfully!');

    return response()->json(['status' => 'success'], 200);
  }
}
