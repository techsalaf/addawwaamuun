@extends('backend.layout')

@includeIf('backend.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Theme V4 - Search Section') }}</h4>
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
        <a href="#">{{ __('Home Page') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Theme V4 - Search Section') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">{{ __('Update Search Section Settings') }}</div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="searchForm" action="{{ route('admin.theme_v4.update_search_settings') }}" method="POST">
                @csrf

                <div class="form-group">
                  <label>{{ __('Title') . '*' }}</label>
                  <input type="text" class="form-control" name="title" value="{{ $data->title ?? '' }}" placeholder="e.g., Find Your Dream Course" required>
                  @error('title') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Subtitle') }}</label>
                  <input type="text" class="form-control" name="subtitle" value="{{ $data->subtitle ?? '' }}" placeholder="Enter subtitle">
                  @error('subtitle') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Search Field Placeholder') }}</label>
                  <input type="text" class="form-control" name="search_placeholder" value="{{ $data->search_placeholder ?? '' }}" placeholder="e.g., Search courses by name...">
                  @error('search_placeholder') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Category Dropdown Placeholder') }}</label>
                  <input type="text" class="form-control" name="category_placeholder" value="{{ $data->category_placeholder ?? '' }}" placeholder="e.g., Select Category">
                  @error('category_placeholder') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Search Button Text') }}</label>
                  <input type="text" class="form-control" name="button_text" value="{{ $data->button_text ?? '' }}" placeholder="e.g., Search">
                  @error('button_text') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" {{ ($data->status ?? true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">
                      {{ __('Enable this section') }}
                    </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="searchForm" class="btn btn-success">
                {{ __('Save Settings') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
