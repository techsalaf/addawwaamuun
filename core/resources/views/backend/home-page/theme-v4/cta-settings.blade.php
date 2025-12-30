@extends('backend.layout')

@includeIf('backend.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Theme V4 - CTA Section') }}</h4>
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
        <a href="#">{{ __('Theme V4 - CTA Section') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">{{ __('Update CTA Section Settings') }}</div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="ctaForm" action="{{ route('admin.theme_v4.update_cta_settings') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label>{{ __('Title') . '*' }}</label>
                  <input type="text" class="form-control" name="title" value="{{ $data->title ?? '' }}" placeholder="Enter CTA title" required>
                  @error('title') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Subtitle') }}</label>
                  <input type="text" class="form-control" name="subtitle" value="{{ $data->subtitle ?? '' }}" placeholder="Enter subtitle">
                  @error('subtitle') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Description') }}</label>
                  <textarea class="form-control" name="description" rows="4" placeholder="Enter description">{{ $data->description ?? '' }}</textarea>
                  @error('description') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                  <label>{{ __('Background Image') }}</label>
                  <br>
                  <div class="thumb-preview">
                    @if (!empty($data->background_image))
                      <img src="{{ asset('assets/img/action-section/' . $data->background_image) }}" alt="background" class="uploaded-cta-bg-img">
                    @else
                      <img src="{{ asset('assets/img/noimage.jpg') }}" alt="..." class="uploaded-cta-bg-img">
                    @endif
                  </div>
                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm cta-upload-btn">
                      {{ __('Choose Image') }}
                      <input type="file" class="cta-bg-img-input" name="background_image" accept="image/*">
                    </div>
                  </div>
                  @error('background_image') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Primary Button Text') }}</label>
                      <input type="text" class="form-control" name="button_1_text" value="{{ $data->button_1_text ?? '' }}" placeholder="e.g., Join Now">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Primary Button URL') }}</label>
                      <input type="text" class="form-control ltr" name="button_1_url" value="{{ $data->button_1_url ?? '' }}" placeholder="https://example.com">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Secondary Button Text') }}</label>
                      <input type="text" class="form-control" name="button_2_text" value="{{ $data->button_2_text ?? '' }}" placeholder="e.g., Learn More">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Secondary Button URL') }}</label>
                      <input type="text" class="form-control ltr" name="button_2_url" value="{{ $data->button_2_url ?? '' }}" placeholder="https://example.com">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Gradient Color 1') }}</label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color" name="gradient_color_1" value="#{{ $data->gradient_color_1 ?? '1866d4' }}">
                        <span class="input-group-text">#{{ $data->gradient_color_1 ?? '1866d4' }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Gradient Color 2') }}</label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color" name="gradient_color_2" value="#{{ $data->gradient_color_2 ?? '580ce3' }}">
                        <span class="input-group-text">#{{ $data->gradient_color_2 ?? '580ce3' }}</span>
                      </div>
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
              <button type="submit" form="ctaForm" class="btn btn-success">
                {{ __('Save Settings') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.cta-upload-btn').addEventListener('click', function() {
      document.querySelector('.cta-bg-img-input').click();
    });
    document.querySelector('.cta-bg-img-input').addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
          document.querySelector('.uploaded-cta-bg-img').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });

    // Color picker updates
    document.querySelectorAll('input[type="color"]').forEach(input => {
      input.addEventListener('input', function() {
        this.nextElementSibling.textContent = this.value;
      });
    });
  </script>
@endsection
