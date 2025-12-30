<?php

namespace App\Http\Controllers\BackEnd\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadFile;
use App\Http\Requests\Instructor\StoreRequest;
use App\Http\Requests\Instructor\UpdateRequest;
use App\Models\Language;
use App\Models\Teacher\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

class InstructorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // first, get the language info from db
    $language = $request->language ? Language::where('code', $request->language)->first() : Language::where('is_default', 1)->first();

    if (!$language) {
      return redirect()->back()->with('warning', 'Default language not found.');
    }

    $information['language'] = $language;

    $information['instructors'] = Instructor::where('language_id', $language->id)
      ->orderByDesc('id')
      ->get();

    // also, get all the languages from db
    $information['langs'] = Language::all();

    $information['themeInfo'] = DB::table('basic_settings')->select('theme_version')->first();

    return view('backend.instructor.index', $information);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // get all the languages from db
    $information['languages'] = Language::all();

    return view('backend.instructor.create', $information);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request)
  {
    $imageName = UploadFile::store('./assets/img/instructors/', $request->file('image'));

    Instructor::create($request->except('image', 'description') + [
      'image' => $imageName,
      'description' => Purifier::clean($request->description)
    ]);

    $request->session()->flash('success', 'New instructor added successfully!');

    return response()->json(['status' => 'success'], 200);
  }

  /**
   * Update featured status of a specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateFeatured(Request $request, $id)
  {
    $instructor = Instructor::find($id);

    if ($request['is_featured'] == 'yes') {
      $instructor->update(['is_featured' => 'yes']);

      $request->session()->flash('success', 'Instructor featured successfully!');
    } else {
      $instructor->update(['is_featured' => 'no']);

      $request->session()->flash('success', 'Instructor unfeatured successfully!');
    }

    return redirect()->back();
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id)
  {
    $langCode = $request['language'];

    $information['language'] = Language::where('code', $langCode)->first();

    $information['instructor'] = Instructor::find($id);

    return view('backend.instructor.edit', $information);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, $id)
  {
    $instructor = Instructor::find($id);

    if ($request->hasFile('image')) {
      $imageName = UploadFile::update(
        './assets/img/instructors/', 
        $request->file('image'), 
        $instructor->image
      );
    }

    $instructor->update($request->except('image', 'description') + [
      'image' => $request->hasFile('image') ? $imageName : $instructor->image,
      'description' => Purifier::clean($request->description)
    ]);

    $request->session()->flash('success', 'Instructor updated successfully!');

    return response()->json(['status' => 'success'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $instructor = Instructor::find($id);
    $courseCount = $instructor->courseList()->count();

    if ($courseCount > 0) {
      return redirect()->back()->with('warning', 'First delete all the courses of this instructor!');
    } else {
      @unlink('assets/img/instructors/' . $instructor->image);

      $instructor->delete();

      return redirect()->back()->with('success', 'Instructor deleted successfully!');
    }
  }

  /**
   * Remove the selected resources from storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function bulkDestroy(Request $request)
  {
    $ids = $request->ids;

    $errorOccured = false;

    foreach ($ids as $id) {
      $instructor = Instructor::find($id);
      $courseCount = $instructor->courseList()->count();

      if ($courseCount > 0) {
        $errorOccured = true;
        break;
      } else {
        @unlink('assets/img/instructors/' . $instructor->image);

        $instructor->delete();
      }
    }

    if ($errorOccured == true) {
      $request->session()->flash('warning', 'First delete all the courses of those instructors!');
    } else {
      $request->session()->flash('success', 'Instructors deleted successfully!');
    }

    return response()->json(['status' => 'success'], 200);
  }
}
