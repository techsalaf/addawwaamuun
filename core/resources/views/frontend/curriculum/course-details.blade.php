@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->course_details_page_title ?? 'Course Details' }}
  @endif
@endsection

@section('metaKeywords')
  {{ $details->meta_keywords }}
@endsection

@section('metaDescription')
  {{ $details->meta_description }}
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
@endsection

@section('content')
  @php
    $position = $currencyInfo->base_currency_symbol_position;
    $symbol = $currencyInfo->base_currency_symbol;
  @endphp

  <!--====== COURSE TITLE PART START ======-->
  <section class="course-title-area pt-120 pb-120 bg_cover lazy" data-bg="{{ asset('assets/img/courses/covers/' . $details->cover_image) }}">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="course-title-content">
            <div class="course-title-content-title">
              <span>{{ $details->categoryName }}</span>
              <h2 class="title">{{ $details->title }}</h2>
            </div>
            <div class="course-rating d-flex">
              @if (!is_null($details->average_rating))
                <div class="rate">
                  <div class="rating" style="width: {{ $details->average_rating * 20 . '%;' }}"></div>
                </div>
                <p>{{ $details->average_rating . ' (' . $ratingCount . ' ' . __('ratings') . ')' }}</p>
              @endif
              <ul>
                <li><span><i class="fal fa-users"></i> {{ $enrolmentCount . ' ' . __('Students Enrolled') }}</span></li>
              </ul>
            </div>
            <div class="course-info">
              <ul>
                <li><i class="fal fa-user"></i> {{ __('By') . ' ' . $details->instructorName }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== COURSE TITLE PART END ======-->

  <!--====== COURSE DETAILS PART START ======-->
  <section class="course-details-area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="course-details-items white-bg">
            <div class="course-thumb">
              <div class="tab-btns">
                <ul class="nav nav-pills d-flex justify-content-between" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true"><i class="fal fa-list"></i> {{ __('Description') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><i class="fal fa-book"></i> {{ __('Curriculum') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false"><i class="fal fa-user"></i> {{ __('Instructor') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false"><i class="fal fa-stars"></i> {{ __('Reviews') }}</a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="tab-content" id="pills-tabContent">

              <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                <div class="course-details-item pt-4">
                  <div class="summernote-content">
                    {!! replaceBaseUrl($details->description, 'summernote') !!}
                  </div>

                  <div class="course-faq">
                    <h4 class="title">{{ __('Frequently Asked Questions') }}</h4>
                  </div>

                  @php
                    $faqs = DB::table('course_faqs')->where('course_id', $details->id)->where('language_id', $details->language_id)
                      ->orderBy('serial_number', 'asc')
                      ->get();
                  @endphp

                  @if (count($faqs) == 0)
                    <div class="row">
                      <div class="col">
                        <h5 class="text-center bg-light py-5">{{ __('No FAQ Found') . '!' }}</h5>
                      </div>
                    </div>
                  @else
                    <div class="course-accordian">
                      <div class="accordion" id="accordionCourse">
                        @foreach ($faqs as $faq)
                          <div class="card">
                            <div class="card-header">
                              <a class="{{ $loop->first ? '' : 'collapsed' }} title" data-toggle="collapse" data-target="{{ '#collapse-' . $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $faq->question }}
                              </a>
                            </div>
                            <div id="{{ 'collapse-' . $faq->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordionCourse">
                              <div class="card-body">
                                <p>{{ $faq->answer }}</p>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                </div>
              </div>

              <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                <div class="curriculum-accordion">
                  <div class="accordion" id="curriculumAccordion">
                    @php
                      $modules = DB::table('modules')->where('course_information_id', $details->courseInfoId)
                        ->where('status', 'published')
                        ->orderBy('serial_number', 'asc')
                        ->get();
                    @endphp

                    @foreach ($modules as $module)
                      <div class="card">
                        @php
                          $modulePeriod = $module->duration;
                          $array = explode(':', $modulePeriod);
                          $moduleHour = $array[0];
                          $moduleDuration = \Carbon\Carbon::parse($modulePeriod);
                        @endphp

                        <div class="card-header">
                          <a class="{{ $loop->first ? '' : 'collapsed' }} title" data-toggle="collapse" data-target="{{ '#collapse-' . $module->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $module->title }}
                            <span class="badge badge-warning">{{ $moduleHour == '00' ? '' : $moduleDuration->format('h') . 'h ' }}{{ $moduleDuration->format('i') . 'm' }}</span>
                          </a>
                        </div>
                        <div id="{{ __('collapse-') . $module->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="{{ 'heading-' . $module->id }}" data-parent="#curriculumAccordion">
                          @php
                            $lessons = DB::table('lessons')->where('module_id', $module->id)
                              ->where('status', 'published')
                              ->orderBy('serial_number', 'asc')
                              ->get();
                          @endphp

                          <div class="card-body">
                            <ul class="play-list">
                              @foreach ($lessons as $lesson)
                                @php
                                  $lessonPeriod = $lesson->duration;
                                  $lessonDuration = \Carbon\Carbon::parse($lessonPeriod);
                                @endphp

                                <li>
                                  <a><i class="fas fa-play"></i>{{ $lesson->title }}<span class="time">{{ $lessonDuration->format('i') . ':' }}{{ $lessonDuration->format('s') }}</span></a>
                                </li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                <div class="instructor-box">
                  <div class="thumb">
                    <img data-src="{{ asset('assets/img/instructors/' . $details->instructorImage) }}" class="lazy" alt="Instructor">
                  </div>
                  <div class="info">
                    <h5>{{ $details->instructorName }}</h5>
                    <span class="position d-block">{{ $details->instructorJob }}</span>
                    <div class="summernote-content">
                      {!! replaceBaseUrl($details->instructorDetails, 'summernote') !!}
                    </div>

                    @php
                      $socials = DB::table('social_links')->where('instructor_id', $details->instructorId)
                        ->orderBy('serial_number', 'asc')
                        ->get();
                    @endphp

                    @if (count($socials) > 0)
                      <ul class="social-link">
                        @foreach ($socials as $social)
                          <li><a href="{{ $social->url }}" target="_blank"><i class="{{ $social->icon }}"></i></a></li>
                        @endforeach
                      </ul>
                    @endif
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                <div class="reviews-area">
                  @guest('web')
                    <a href="{{ route('user.login', ['redirectPath' => 'course_details']) }}" class="main-btn">{{ __('Login') }}</a>
                  @endguest

                  @auth('web')
                    <div class="rating-form-area">
                      <h4 class="title">{{ __('Ratings') }}</h4>
                      <div class="rating-form mb-35">
                        <form action="{{ route('course.store_feedback', ['id' => $details->id]) }}" method="POST">
                          @csrf
                          <div class="form_rating">
                            <ul class="rating">
                              <li class="review-value review-1">
                                <span class="far fa-star" data-ratingVal="1"></span>
                              </li>
                              <li class="review-value review-2">
                                <span class="far fa-star" data-ratingVal="2"></span>
                                <span class="far fa-star" data-ratingVal="2"></span>
                              </li>
                              <li class="review-value review-3">
                                <span class="far fa-star" data-ratingVal="3"></span>
                                <span class="far fa-star" data-ratingVal="3"></span>
                                <span class="far fa-star" data-ratingVal="3"></span>
                              </li>
                              <li class="review-value review-4">
                                <span class="far fa-star" data-ratingVal="4"></span>
                                <span class="far fa-star" data-ratingVal="4"></span>
                                <span class="far fa-star" data-ratingVal="4"></span>
                                <span class="far fa-star" data-ratingVal="4"></span>
                              </li>
                              <li class="review-value review-5">
                                <span class="far fa-star" data-ratingVal="5"></span>
                                <span class="far fa-star" data-ratingVal="5"></span>
                                <span class="far fa-star" data-ratingVal="5"></span>
                                <span class="far fa-star" data-ratingVal="5"></span>
                                <span class="far fa-star" data-ratingVal="5"></span>
                              </li>
                            </ul>
                          </div>

                          <input type="hidden" id="rating-id" name="rating">

                          <div class="form_group">
                            <textarea class="form_control" name="comment" placeholder="{{ __('Enter Your Feedback') }}">{{ old('comment') }}</textarea>
                          </div>

                          <div class="form_group">
                            <button class="main-btn">{{ __('Submit') }}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  @endauth

                  @if (count($reviews) == 0)
                    <h4 class="mt-25 text-center">{{ __('This course is not reviewed yet') . '.' }}</h4>
                  @else
                    <div class="reviews-list">
                      @foreach ($reviews as $review)
                        <div class="reviews-item">
                          @php $user = $review->userInfo()->first(); @endphp

                          <div class="thumb">
                            @if (is_null($user->image))
                              <img data-src="{{ asset('assets/img/profile.jpg') }}" class="lazy" alt="User">
                            @else
                              <img data-src="{{ asset('assets/img/users/' . $user->image) }}" class="lazy" alt="User">
                            @endif
                          </div>
                          <div class="content">
                            <div class="title-review">
                              <div class="title">
                                <h5>{{ $user->first_name . ' ' . $user->last_name }}</h5>
                                <span class="date">{{ date_format($review->created_at, 'F d, Y') }}</span>
                              </div>
                              <ul class="rating user-rating">
                                @for ($i = 0; $i < $review->rating; $i++)
                                  <li><i class="fas fa-star"></i></li>
                                @endfor
                              </ul>
                            </div>
                            <p>{{ $review->comment }}</p>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>

              @if (!empty(showAd(3)))
                <div class="text-center mt-30">
                  {!! showAd(3) !!}
                </div>
              @endif
              
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-7 col-sm-9">
          <div class="course-details-sidebar white-bg">
            <div class="course-sidebar-thumb">
              <img data-src="{{ asset('assets/img/courses/thumbnails/' . $details->thumbnail_image) }}" class="lazy" alt="image">
              <a class="video-popup" href="{{ $details->video_link }}"><i class="fas fa-play"></i></a>
            </div>

            <div class="course-sidebar-price d-flex justify-content-between align-items-center">
              @if ($details->pricing_type == 'premium')
                <h3 class="title">{{ $position == 'left' ? $symbol : '' }}{{ $details->current_price }}{{ $position == 'right' ? $symbol : '' }} @if (!is_null($details->previous_price)) <span>{{ $position == 'left' ? $symbol : '' }}{{ $details->previous_price }}{{ $position == 'right' ? $symbol : '' }}</span> @endif </h3>
              @else
                <h3 class="title">{{ __('Free') }}</h3>
              @endif
            </div>

            <div class="course-sidebar-price d-none" id="discount-info">
              <h6>{{ __('Discounted Price') . ': ' }}{{ $position == 'left' ? $symbol : '' }}<span id="discount-price"></span>{{ $position == 'right' ? $symbol : '' }}</h6>
            </div>

            <div class="course-sidebar-btns">
              @if (session()->has('profile_warning'))
                <div class="alert alert-warning" role="alert">
                  <strong>{{ session()->get('profile_warning') }} <a href="{{ route('user.edit_profile') }}">here.</a></strong>
                </div>
              @endif

              @error('attachment')
                <div class="alert alert-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror

              @php
                $courseType = '';

                if ($details->pricing_type == 'free') {
                  $courseType = 'free';
                }
              @endphp

              @auth('web')
                @if (($details->pricing_type == 'premium' && (!is_null($enrolmentInfo) && $enrolmentInfo->payment_status == 'completed')) 
                  || ($details->pricing_type == 'free' && !is_null($enrolmentInfo)))
                  <div class="alert alert-success" role="alert">
                    <strong>{{ __('You have already enrolled in this course') . '.' }}</strong>
                  </div>
                @endif
              @endauth

              @if (!Auth::guard('web')->check() || (($details->pricing_type == 'premium' && (is_null($enrolmentInfo) || $enrolmentInfo->payment_status != 'completed')) || ($details->pricing_type == 'free' && is_null($enrolmentInfo))))
                <form action="{{ route('course-enrolment', ['id' => $details->id, 'type' => $courseType]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if ($details->pricing_type == 'premium')
                    <select name="gateway" class="mb-4">
                      <option selected disabled>{{ __('Select Payment Gateway') }}</option>

                      @if (count($onlineGateways) > 0)
                        @foreach ($onlineGateways as $onlineGateway)
                          <option value="{{ $onlineGateway->keyword }}" {{ $onlineGateway->keyword == old('gateway') ? 'selected' : '' }}>
                            {{ $onlineGateway->name }}
                          </option>
                        @endforeach
                      @endif

                      @if (count($offlineGateways) > 0)
                        @foreach ($offlineGateways as $offlineGateway)
                          <option value="{{ $offlineGateway->id }}" {{ $offlineGateway->id == old('gateway') ? 'selected' : '' }}>
                            {{ $offlineGateway->name }}
                          </option>
                        @endforeach
                      @endif
                    </select>

                    @foreach ($onlineGateways as $onlineGateway)
                      @if ($onlineGateway->keyword == 'stripe')
                        <div id="stripe-card-input" class="@if ($errors->has('card_number') || $errors->has('cvc_number') || $errors->has('expiry_month') || $errors->has('expiry_year')) d-block @else d-none @endif">
                          <div class="form-group mb-4">
                            <input type="text" class="form-control" name="card_number" placeholder="{{ __('Enter Your Card Number') }}" autocomplete="off" oninput="checkCard(this.value)">
                            <p class="mt-2 text-danger" id="card-error"></p>

                            @error('card_number')
                              <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                          </div>

                          <div class="form-group mb-4">
                            <input type="text" class="form-control" name="cvc_number" placeholder="{{ __('Enter CVC Number') }}" autocomplete="off" oninput="checkCVC(this.value)">
                            <p class="mt-2 text-danger" id="cvc-error"></p>

                            @error('cvc_number')
                              <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                          </div>

                          <div class="form-group mb-4">
                            <input type="text" class="form-control" name="expiry_month" placeholder="{{ __('Enter Expiry Month') }}">

                            @error('expiry_month')
                              <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                          </div>

                          <div class="form-group mb-4">
                            <input type="text" class="form-control" name="expiry_year" placeholder="{{ __('Enter Expiry Year') }}">

                            @error('expiry_year')
                              <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                      @endif
                    @endforeach

                    @foreach ($offlineGateways as $offlineGateway)
                      <div class="@if ($errors->has('attachment') && request()->session()->get('gatewayId') == $offlineGateway->id) d-block @else d-none @endif offline-gateway-info" id="{{ 'offline-gateway-' . $offlineGateway->id }}">
                        @if (!is_null($offlineGateway->short_description))
                          <div class="form-group mb-4">
                            <label>{{ __('Description') }}</label>
                            <p>{{ $offlineGateway->short_description }}</p>
                          </div>
                        @endif

                        @if (!is_null($offlineGateway->instructions))
                          <div class="form-group mb-4">
                            <label>{{ __('Instructions') }}</label>
                            <p>{!! replaceBaseUrl($offlineGateway->instructions, 'summernote') !!}</p>
                          </div>
                        @endif

                        @if ($offlineGateway->has_attachment == 1)
                          <div class="form-group mb-4">
                            <label>{{ __('Attachment') . '*' }}</label>
                            <br>
                            <input type="file" name="attachment">
                          </div>
                        @endif
                      </div>
                    @endforeach

                    <div class="input-group mb-4">
                      <input type="text" class="form-control" id="coupon-code" placeholder="{{ __('Enter Your Coupon') }}" aria-label="Coupon Code" aria-describedby="coupon-btn">
                      <div class="{{ $currentLanguageInfo->direction == 0 ? 'input-group-append' : 'input-group-prepend' }}">
                        <button class="btn" type="button" id="coupon-btn">{{ __('Apply') }}</button>
                      </div>
                    </div>
                  @endif

                  <button id="enrol-btn" type="submit"><i class="fal fa-user-graduate"></i> {{ __('Enrol Now') }}</button>
                </form>
              @endif

              <h6 class="title">{{ __('This Course Includes') }}</h6>

              @php $features = explode(PHP_EOL, $details->features); @endphp

              <ul>
                @foreach ($features as $feature)
                  <li><i class="fal fa-check"></i> {{ $feature }}</li>
                @endforeach
              </ul>
            </div>

            <div class="course-sidebar-share">
              <a href="//www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a>
              <a href="//twitter.com/intent/tweet?text=my share text&amp;url={{ urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a>
              <a href="//www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ $details->title }}"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>

          @if (count($relatedCourses) > 0)
            <div class="trending-course">
              <h4 class="title"><i class="fal fa-book"></i> {{ __('Related Courses') }}</h4>
              @foreach ($relatedCourses as $relatedCourse)
                <div class="single-courses mt-30">
                  <div class="courses-thumb">
                    <img data-src="{{ asset('assets/img/courses/thumbnails/' . $relatedCourse->thumbnail_image) }}" class="lazy" alt="image">

                    @if (!is_null($relatedCourse->average_rating))
                      <div class="courses-review">
                        <span><i class="fas fa-star"></i> {{ $relatedCourse->average_rating }}</span>
                      </div>
                    @endif

                    <div class="corses-thumb-title item-2">
                      <a class="category" href="{{route('courses', ['category' => $relatedCourse->categorySlug])}}">{{ $relatedCourse->categoryName }}</a>
                    </div>
                  </div>
                  <div class="courses-content">
                    <a href="{{ route('course_details', ['slug' => $relatedCourse->slug]) }}">
                      <h4 class="title">{{ strlen($relatedCourse->title) > 45 ? mb_substr($relatedCourse->title, 0, 45, 'UTF-8') . '...' : $relatedCourse->title }}</h4>
                    </a>
                    <div class="courses-info d-flex justify-content-between">
                      <div class="item">
                        <img data-src="{{ asset('assets/img/instructors/' . $relatedCourse->instructorImage) }}" class="lazy" alt="instructor">
                        <p>{{strlen($relatedCourse->instructorName) > 10 ? mb_substr($relatedCourse->instructorName, 0, 10, 'utf-8') . '...' : $relatedCourse->instructorName}}</p>
                      </div>

                      <div class="price">
                        @if ($relatedCourse->pricing_type == 'premium')
                          <span>{{ $position == 'left' ? $symbol : '' }}{{ $relatedCourse->current_price }}{{ $position == 'right' ? $symbol : '' }}</span>

                          @if (!is_null($relatedCourse->previous_price))
                            <span class="pre-price">{{ $position == 'left' ? $symbol : '' }}{{ $relatedCourse->previous_price }}{{ $position == 'right' ? $symbol : '' }}</span>
                          @endif
                        @else
                          <span>{{ __('Free') }}</span>
                        @endif
                      </div>
                    </div>
                    <ul class="d-flex justify-content-center">
                      <li><i class="fal fa-users"></i> {{ $relatedCourse->enrolmentCount . ' ' . __('Students') }}</li>

                      @php
                        $period = $relatedCourse->duration;
                        $array = explode(':', $period);
                        $hour = $array[0];
                        $courseDuration = \Carbon\Carbon::parse($period);
                      @endphp

                      <li><i class="fal fa-clock"></i> {{ $hour == '00' ? '00' : $courseDuration->format('h') }}h {{ $courseDuration->format('i') }}m</li>
                    </ul>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          <div class="text-center mt-30">
            {!! showAd(2) !!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== COURSE DETAILS PART END ======-->
@endsection

@section('script')
  <script>
    "use strict";
    let courseId = {{ $details->id }};
  </script>

  <script src="{{asset('assets/js/stripe.js')}}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/course-details.js') }}"></script>
@endsection
