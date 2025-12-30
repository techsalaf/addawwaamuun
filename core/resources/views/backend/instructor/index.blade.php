@extends('backend.layout')

{{-- this style will be applied when the direction of language is right-to-left --}}
@includeIf('backend.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Instructors') }}</h4>
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
        <a href="#">{{ __('Instructors') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block">{{ __('Instructors') }}</div>
            </div>

            <div class="col-lg-3">
              @includeIf('backend.partials.languages')
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="{{ route('admin.create_instructor') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> {{ __('Add Instructor') }}</a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete" data-href="{{ route('admin.bulk_delete_instructor') }}">
                <i class="flaticon-interface-5"></i> {{ __('Delete') }}
              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($instructors) == 0)
                <h3 class="text-center mt-3">{{ __('NO INSTRUCTOR FOUND') . '!' }}</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">{{ __('Image') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Occupation') }}</th>

                        @if ($themeInfo->theme_version == 2)
                          <th scope="col">{{ __('Featured') }}</th>
                        @endif

                        <th scope="col">{{ __('Actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($instructors as $instructor)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{ $instructor->id }}">
                          </td>
                          <td>
                            <img src="{{ asset('assets/img/instructors/' . $instructor->image) }}" alt="instructor image" width="45">
                          </td>
                          <td>{{ $instructor->name }}</td>
                          <td>{{ $instructor->occupation }}</td>

                          @if ($themeInfo->theme_version == 2)
                            <td>
                              <form id="featuredForm-{{ $instructor->id }}" class="d-inline-block" action="{{ route('admin.instructor.update_featured', ['id' => $instructor->id]) }}" method="post">
                                
                                @csrf
                                <select class="form-control form-control-sm {{ $instructor->is_featured == 'yes' ? 'bg-success' : 'bg-danger' }}" name="is_featured" onchange="document.getElementById('featuredForm-{{ $instructor->id }}').submit()">
                                  <option value="yes" {{ $instructor->is_featured == 'yes' ? 'selected' : '' }}>
                                    {{ __('Yes') }}
                                  </option>
                                  <option value="no" {{ $instructor->is_featured == 'no' ? 'selected' : '' }}>
                                    {{ __('No') }}
                                  </option>
                                </select>
                              </form>
                            </td>
                          @endif

                          <td>
                            <a class="btn btn-secondary btn-sm mr-1" href="{{ route('admin.edit_instructor', ['id' => $instructor->id, 'language' => request()->input('language')]) }}">
                              <i class="fas fa-edit"></i>
                            </a>

                            <a class="btn btn-success btn-sm mr-1" href="{{ route('admin.instructor.social_links', ['id' => $instructor->id]) }}">
                              <i class="fas fa-share-alt"></i>
                            </a>

                            <form class="deleteForm d-inline-block" action="{{ route('admin.delete_instructor', ['id' => $instructor->id]) }}" method="post">
                              
                              @csrf
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
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

        <div class="card-footer"></div>
      </div>
    </div>
  </div>
@endsection
