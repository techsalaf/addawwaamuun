@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->courses_page_title ?? 'Courses' }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_courses }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_courses }}
  @endif
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->courses_page_title ?? 'Courses'])

  <!--====== COURSES PART START ======-->
  <section class="course-grid-area pt-90 pb-120 courses-page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="course-grid mt-30">
            <div class="course-grid-top d-sm-flex d-block justify-content-between align-items-center">
              <div class="course-filter d-block align-items-center d-sm-flex">
                <select id="sort-type">
                  <option selected disabled>{{ __('Sort By') }}</option>
                  <option {{ request()->input('sort') == 'new' ? 'selected' : '' }} value="new">
                    {{ __('New Course') }}
                  </option>
                  <option {{ request()->input('sort') == 'old' ? 'selected' : '' }} value="old">
                    {{ __('Old Course') }}
                  </option>
                  <option {{ request()->input('sort') == 'ascending' ? 'selected' : '' }} value="ascending">
                    {{ __('Price') . ': ' . __('Ascending') }}
                  </option>
                  <option {{ request()->input('sort') == 'descending' ? 'selected' : '' }} value="descending">
                    {{ __('Price') . ': ' . __('Descending') }}
                  </option>
                </select>

                <div class="input-box">
                  <i class="fal fa-search" id="course-search-icon"></i>
                  <input type="text" id="search-input" placeholder="{{ __('Search Course') }}" value="{{ !empty(request()->input('keyword')) ? request()->input('keyword') : '' }}">
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-10">
            @if (count($courses) == 0)
              <div class="col-lg-12">
                <h3 class="text-center mt-30">{{ __('No Course Found') . '!' }}</h3>
              </div>
            @else
              @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6 col-sm-8">
                  <div class="single-courses mt-30">
                    <div class="courses-thumb">
                      <a class="d-block" href="{{ route('course_details', ['slug' => $course->slug]) }}"><img data-src="{{ asset('assets/img/courses/thumbnails/' . $course->thumbnail_image) }}" class="lazy" alt="image"></a>

                      <div class="corses-thumb-title">
                        <a class="category" href="{{route('courses', ['category' => $course->categorySlug])}}">{{ $course->categoryName }}</a>
                      </div>
                    </div>

                    <div class="courses-content">
                      <a href="{{ route('course_details', ['slug' => $course->slug]) }}">
                        <h4 class="title">{{ strlen($course->title) > 45 ? mb_substr($course->title, 0, 45, 'UTF-8') . '...' : $course->title }}</h4>
                      </a>
                      <div class="courses-info d-flex justify-content-between">
                        <div class="item">
                          <p>{{strlen($course->instructorName) > 10 ? mb_substr($course->instructorName, 0, 10, 'utf-8') . '...' : $course->instructorName}}</p>
                        </div>
                        
                        <div class="price">
                          @if ($course->pricing_type == 'premium')
                            <span>{{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}{{ $course->current_price }}{{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}</span>

                            @if (!is_null($course->previous_price))
                              <span class="pre-price">{{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}{{ $course->previous_price }}{{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}</span>
                            @endif
                          @else
                            <span>{{ __('Free') }}</span>
                          @endif
                        </div>
                      </div>
                      <ul class="d-flex justify-content-center">
                        <li><i class="fal fa-users"></i> {{ $course->enrolmentCount . ' ' . __('Students') }}</li>

                        @php
                          $period = $course->duration;
                          $array = explode(':', $period);
                          $hour = $array[0];
                          $courseDuration = \Carbon\Carbon::parse($period);
                        @endphp

                        <li><i class="fal fa-clock"></i> {{ $hour == '00' ? '00' : $courseDuration->format('h') }}h {{ $courseDuration->format('i') }}m</li>
                      </ul>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

            <div class="col-lg-12">
              @if (count($courses) > 0)
                {{ $courses->appends([
                  'type' => request()->input('type'),
                  'category' => request()->input('category'),
                  'min' => request()->input('min'),
                  'max' => request()->input('max'),
                  'keyword' => request()->input('keyword'),
                  'sort' => request()->input('sort')
                ])->links() }}
              @endif

            </div>

            @if (!empty(showAd(3)))
              <div class="col-12 text-center mt-5">
                {!! showAd(3) !!}
              </div>
            @endif
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-8">
          <div class="course-sidebar">
            <div class="course-price-filter white-bg mt-30">
              <div class="course-title">
                <h4 class="title">{{ __('Course Type') }}</h4>
              </div>
              <div class="input-radio-btn">
                <ul class="radio_common-2 radio_style2">
                  <li>
                    <input type="radio" {{ empty(request()->input('type')) ? 'checked' : '' }} name="type" id="radio1" value="">
                    <label for="radio1"><span></span>{{ __('All Courses') }}</label>
                  </li>
                  <li>
                    <input type="radio" {{ request()->input('type') == 'free' ? 'checked' : '' }} name="type" id="radio2" value="free">
                    <label for="radio2"><span></span>{{ __('Free Courses') }}</label>
                  </li>
                  <li>
                    <input type="radio" {{ request()->input('type') == 'premium' ? 'checked' : '' }} name="type" id="radio3" value="premium">
                    <label for="radio3"><span></span>{{ __('Premium Courses') }}</label>
                  </li>
                </ul>
              </div>
            </div>

            @if (count($categories) > 0)
              <div class="course-price-filter white-bg mt-30">
                <div class="course-title">
                  <h4 class="title">{{ __('Categories') }}</h4>
                </div>
                <div class="input-radio-btn">
                  <ul class="radio_common-2 radio_style2">
                    <li>
                      <input type="radio" {{ empty(request()->input('category')) ? 'checked' : '' }} name="category" id="all-category" value="">
                      <label for="all-category"><span></span>{{ __('All Category') }}</label>
                    </li>

                    @foreach ($categories as $category)
                      <li>
                        <input type="radio" {{ request()->input('category') == $category->slug ? 'checked' : '' }} name="category" id="{{ 'radio' . $category->id }}" value="{{ $category->slug }}">
                        <label for="{{ 'radio' . $category->id }}"><span></span>{{ $category->name }}</label>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endif

            <div class="course-price-filter white-bg mt-30">
              <div class="course-title">
                <h4 class="title">{{ __('Filter By Price') }}</h4>
              </div>
              <div class="price-number">
                <ul>
                  <li><span class="amount">{{ __('Price') . ' :' }}</span></li>
                  <li><input type="text" id="amount" readonly></li>
                </ul>
              </div>
              <div id="range-slider"></div>
            </div>

            <div class="course-add mt-30">
              {!! showAd(2) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== COURSES PART END ======-->

  <form id="filtersForm" class="d-none" action="{{ route('courses') }}" method="GET">
    <input type="hidden" id="type-id" name="type" value="{{ !empty(request()->input('type')) ? request()->input('type') : '' }}">

    <input type="hidden" id="category-id" name="category" value="{{ !empty(request()->input('category')) ? request()->input('category') : '' }}">

    <input type="hidden" id="min-id" name="min" value="{{ !empty(request()->input('min')) ? request()->input('min') : '' }}">

    <input type="hidden" id="max-id" name="max" value="{{ !empty(request()->input('max')) ? request()->input('max') : '' }}">

    <input type="hidden" id="keyword-id" name="keyword" value="{{ !empty(request()->input('keyword')) ? request()->input('keyword') : '' }}">

    <input type="hidden" id="sort-id" name="sort" value="{{ !empty(request()->input('sort')) ? request()->input('sort') : '' }}">

    <button type="submit" id="submitBtn"></button>
  </form>
@endsection

@section('script')
  <script>
    "use strict";
    let currency_info = {!! json_encode($currencyInfo) !!};
    let position = currency_info.base_currency_symbol_position;
    let symbol = currency_info.base_currency_symbol;
    let min_price = {!! htmlspecialchars($minPrice) !!};
    let max_price = {!! htmlspecialchars($maxPrice) !!};
    let curr_min = {!! !empty(request()->input('min')) ? htmlspecialchars(request()->input('min')) : htmlspecialchars($minPrice) !!};
    let curr_max = {!! !empty(request()->input('max')) ? htmlspecialchars(request()->input('max')) : htmlspecialchars($maxPrice) !!};
  </script>

  <script type="text/javascript" src="{{ asset('assets/js/course.js') }}"></script>
@endsection
