@extends('frontend.layout')

@section('pageHeading')
  {{ __('My Courses') }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => __('My Courses')])

  <!-- Start User Enrolled Course Section -->
  <section class="user-dashboard">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="account-info">
                <div class="title">
                  <h4>{{ __('All Courses') }}</h4>
                </div>

                <div class="main-info">
                  <div class="main-table">
                    @if (count($enrolments) == 0)
                      <h5 class="text-center mt-3">{{ __('No Course Found') . '!' }}</h5>
                    @else
                      <div class="table-responsive">
                        <table id="user-dataTable" class="dataTables_wrapper dt-responsive table-striped dt-bootstrap4">
                          <thead>
                            <tr>
                              <th>{{ __('Course') }}</th>
                              <th>{{ __('Duration') }}</th>
                              <th>{{ __('Price') }}</th>
                              <th>{{ __('Action') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($enrolments as $enrolment)
                              <tr>
                                <td>
                                  <a target="_blank" href="{{ route('course_details', ['slug' => $enrolment->slug]) }}">
                                    {{ $enrolment->title }}
                                  </a>
                                </td>

                                @php
                                  $period = $enrolment->course->duration;
                                  $array = explode(':', $period);
                                  $hour = $array[0];
                                  $courseDuration = \Carbon\Carbon::parse($period);
                                @endphp

                                <td class="pl-3">{{ $hour == '00' ? '00' : $courseDuration->format('h') }}h {{ $courseDuration->format('i') }}m</td>
                                <td>
                                  @if (!is_null($enrolment->course_price))
                                    {{ $enrolment->currency_symbol_position == 'left' ? $enrolment->currency_symbol : '' }}{{ $enrolment->course_price }}{{ $enrolment->currency_symbol_position == 'right' ? $enrolment->currency_symbol : '' }}
                                  @else
                                    <span class="{{ $currentLanguageInfo->direction == 1 ? 'mr-2' : 'ml-1' }}">{{ __('Free') }}</span>
                                  @endif
                                </td>

                                <td>
                                  <a href="{{ route('user.my_course.curriculum', ['id' => $enrolment->course_id, 'lesson_id' => $enrolment->lesson_id]) }}" class="btn">
                                    {{ __('Curriculum') }}
                                  </a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End User Enrolled Course Section -->
@endsection
