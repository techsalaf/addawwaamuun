@extends('backend.layout')

@includeIf('backend.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Theme V4 - About Section') }}</h4>
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
        <a href="#">{{ __('Theme V4 - About Section') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">{{ __('Update About Section Settings') }}</div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="aboutForm" action="{{ route('admin.theme_v4.update_about_settings') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label>{{ __('Title') . '*' }}</label>
                  <input type="text" class="form-control" name="title" value="{{ $data->title ?? '' }}" placeholder="Enter title" required>
                  @error('title') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Subtitle') }}</label>
                  <input type="text" class="form-control" name="subtitle" value="{{ $data->subtitle ?? '' }}" placeholder="Enter subtitle">
                  @error('subtitle') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Description') . '*' }}</label>
                  <textarea class="form-control" name="description" rows="5" placeholder="Enter description" required>{{ $data->description ?? '' }}</textarea>
                  @error('description') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Image') }}</label>
                  <br>
                  <div class="thumb-preview">
                    @if (!empty($data->image))
                      <img src="{{ asset('assets/img/about-section/' . $data->image) }}" alt="image" class="uploaded-about-img">
                    @else
                      <img src="{{ asset('assets/img/noimage.jpg') }}" alt="..." class="uploaded-about-img">
                    @endif
                  </div>
                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm about-upload-btn">
                      {{ __('Choose Image') }}
                      <input type="file" class="about-img-input" name="image" accept="image/*">
                    </div>
                  </div>
                  @error('image') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Button Text') }}</label>
                      <input type="text" class="form-control" name="button_text" value="{{ $data->button_text ?? '' }}" placeholder="e.g., Learn More">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Button URL') }}</label>
                      <input type="text" class="form-control ltr" name="button_url" value="{{ $data->button_url ?? '' }}" placeholder="https://example.com">
                    </div>
                  </div>
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
              <button type="submit" form="aboutForm" class="btn btn-success">
                {{ __('Save Settings') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.about-upload-btn').addEventListener('click', function() {
      document.querySelector('.about-img-input').click();
    });
    document.querySelector('.about-img-input').addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
          document.querySelector('.uploaded-about-img').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  </script>
@endsection
