@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Course Enrolments') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Course Enrolments') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title">{{ __('Course Enrolments') }}</div>
            </div>

            <div class="col-lg-6 offset-lg-2">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete ml-3 mt-1" data-href="{{ route('admin.course_enrolments.bulk_delete') }}">
                <i class="flaticon-interface-5"></i> {{ __('Delete') }}
              </button>

              <form class="float-right ml-3" action="{{ route('admin.course_enrolments') }}" method="GET">
                <input name="order_id" type="text" class="form-control" placeholder="Search By Order ID" value="{{ !empty(request()->input('order_id')) ? request()->input('order_id') : '' }}">
              </form>

              <form id="searchByStatusForm" class="float-right d-flex flex-row align-items-center" action="{{ route('admin.course_enrolments') }}" method="GET">
                <label class="mr-2">{{ __('Payment') }}</label>
                <select class="form-control" name="status" onchange="document.getElementById('searchByStatusForm').submit()">
                  <option value="" {{ empty(request()->input('status')) ? 'selected' : '' }}>
                    {{ __('All') }}
                  </option>
                  <option value="completed" {{ request()->input('status') == 'completed' ? 'selected' : '' }}>
                    {{ __('Completed') }}
                  </option>
                  <option value="pending" {{ request()->input('status') == 'pending' ? 'selected' : '' }}>
                    {{ __('Pending') }}
                  </option>
                  <option value="rejected" {{ request()->input('status') == 'rejected' ? 'selected' : '' }}>
                    {{ __('Rejected') }}
                  </option>
                </select>
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($enrolments) == 0)
                <h3 class="text-center mt-2">{{ __('NO ENROLMENT FOUND') . '!' }}</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">{{ __('Order ID.') }}</th>
                        <th scope="col">{{ __('Course') }}</th>
                        <th scope="col">{{ __('Username') }}</th>
                        <th scope="col">{{ __('Paid via') }}</th>
                        <th scope="col">{{ __('Payment Status') }}</th>
                        <th scope="col">{{ __('Attachment') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($enrolments as $enrolment)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{ $enrolment->id }}">
                          </td>
                          <td>{{ '#' . $enrolment->order_id }}</td>

                          @php
                            $course = $enrolment->course()->first();
                            $courseInfo = $course->information()->where('language_id', $defaultLang->id)->first();
                            $title = $courseInfo->title;
                            $slug = $courseInfo->slug;
                          @endphp

                          <td>
                            <a href="{{ url('/course/' . $slug) }}" target="_blank">
                              {{ strlen($title) > 35 ? mb_substr($title, 0, 35, 'utf-8') . '...' : $title }}
                            </a>
                          </td>

                          @php
                            $user = $enrolment->userInfo()->first();
                          @endphp

                          <td>{{ $user->username }}</td>
                          <td>{{ !is_null($enrolment->payment_method) ? $enrolment->payment_method : '-' }}</td>
                          <td>
                            @if ($enrolment->gateway_type == 'online')
                              <h2 class="d-inline-block"><span class="badge badge-success">{{ __('Completed') }}</span></h2>
                            @elseif ($enrolment->gateway_type == 'offline')
                              <form id="paymentStatusForm-{{ $enrolment->id }}" class="d-inline-block" action="{{ route('admin.course_enrolment.update_payment_status', ['id' => $enrolment->id]) }}" method="post">
                                @csrf
                                <select class="form-control form-control-sm @if ($enrolment->payment_status == 'completed') bg-success @elseif ($enrolment->payment_status == 'pending') bg-warning text-dark @else bg-danger @endif" name="payment_status" onchange="document.getElementById('paymentStatusForm-{{ $enrolment->id }}').submit()">
                                  <option value="completed" {{ $enrolment->payment_status == 'completed' ? 'selected' : '' }}>
                                    {{ __('Completed') }}
                                  </option>
                                  <option value="pending" {{ $enrolment->payment_status == 'pending' ? 'selected' : '' }}>
                                    {{ __('Pending') }}
                                  </option>
                                  <option value="rejected" {{ $enrolment->payment_status == 'rejected' ? 'selected' : '' }}>
                                    {{ __('Rejected') }}
                                  </option>
                                </select>
                              </form>
                            @else
                              -
                            @endif
                          </td>
                          <td>
                            @if (!is_null($enrolment->attachment))
                              <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#attachmentModal-{{ $enrolment->id }}">
                                {{ __('Show') }}
                              </a>
                            @else
                              -
                            @endif
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Select') }}
                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{ route('admin.course_enrolment.details', ['id' => $enrolment->id]) }}" class="dropdown-item">
                                  {{ __('Details') }}
                                </a>

                                <a href="{{ asset('assets/file/invoices/' . $enrolment->invoice) }}" class="dropdown-item" target="_blank">
                                  {{ __('Invoice') }}
                                </a>

                                <form class="deleteForm d-block" action="{{ route('admin.course_enrolment.delete', ['id' => $enrolment->id]) }}" method="post">
                                  
                                  @csrf
                                  <button type="submit" class="deleteBtn">
                                    {{ __('Delete') }}
                                  </button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>

                        @includeIf('backend.curriculum.enrolment.show-attachment')
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="card-footer text-center">
          <div class="d-inline-block mt-3">
            {{ $enrolments->appends([
              'order_id' => request()->input('order_id'),
              'status' => request()->input('status')
            ])->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
