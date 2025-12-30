@if ($footerSecStatus == 1)
  <footer class="footer-area">
    <div class="container">
      <div class="row pb-5">
        <div class="col-lg-4 col-md-5">
          <div class="footer-item about-footer-item mt-30">
            @if (!is_null($basicInfo->footer_logo))
              <div class="footer-title">
                <img data-src="{{ asset('assets/img/' . $basicInfo->footer_logo) }}" class="lazy" alt="website logo">
              </div>
            @endif

            @if (!is_null($footerInfo))
              <div class="about-content">
                <p>{{ $footerInfo->about_company }}</p>
              </div>
            @endif
          </div>
        </div>

        <div class="col-lg-4 col-md-7">
          <div class="footer-item mt-30">
            <div class="footer-title item-2">
              <i class="fal fa-link"></i>
              <h4 class="title">{{ __('Useful Links') }}</h4>
            </div>

            <div class="footer-list-area">
              @if (count($quickLinkInfos) == 0)
                <h6 class="text-light">{{ __('No Link Found') . '!' }}</h6>
              @else
                <div class="footer-list d-block d-sm-flex">
                  <ul>
                    @foreach ($quickLinkInfos as $quickLinkInfo)
                      <li><a href="{{ $quickLinkInfo->url }}"><i class="fal fa-angle-right"></i> {{ $quickLinkInfo->title }}</a></li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          @if ($basicInfo->theme_version == 1)
            @includeIf('frontend.partials.footer.latest-blogs')
          @elseif ($basicInfo->theme_version == 3 || $basicInfo->theme_version == 4)
            @includeIf('frontend.partials.footer.contact-info')
          @endif
        </div>
      </div>

      <div class="row border-top text-center pt-5">
        <div class="col">
          <p class="text-light">
            {!! !empty($footerInfo->copyright_text) ? $footerInfo->copyright_text : '' !!}
          </p>
        </div>
      </div>
    </div>
  </footer>
@endif
