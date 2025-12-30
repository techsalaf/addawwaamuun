<footer class="footer-v4">
  <div class="footer-v4-wrapper">
    <div class="container">
      <div class="footer-v4-top">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="footer-v4-section">
              <div class="footer-v4-brand">
                @if (!is_null($basicInfo->footer_logo))
                  <div class="footer-v4-logo">
                    <img data-src="{{ asset('assets/img/' . $basicInfo->footer_logo) }}" class="lazy" alt="footer logo">
                  </div>
                @endif
                @if (!is_null($footerInfo))
                  <p class="footer-v4-desc">{{ $footerInfo->about_company }}</p>
                @endif
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6">
            <div class="footer-v4-section">
              <h4 class="footer-v4-title">Quick Links</h4>
              @if (count($quickLinkInfos) > 0)
                <ul class="footer-v4-list">
                  @foreach ($quickLinkInfos as $quickLinkInfo)
                    <li>
                      <a href="{{ $quickLinkInfo->url }}">
                        <i class="fal fa-angle-right"></i> {{ $quickLinkInfo->title }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="text-muted">No links found</p>
              @endif
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-v4-section">
              <h4 class="footer-v4-title">Contact Info</h4>
              <ul class="footer-v4-contact">
                @if (!is_null($contactInfo->phone))
                  <li><i class="fal fa-phone"></i> <a href="tel:{{ $contactInfo->phone }}">{{ $contactInfo->phone }}</a></li>
                @endif
                @if (!is_null($contactInfo->email))
                  <li><i class="fal fa-envelope"></i> <a href="mailto:{{ $contactInfo->email }}">{{ $contactInfo->email }}</a></li>
                @endif
                @if (!is_null($contactInfo->address))
                  <li><i class="fal fa-map-marker-alt"></i> {{ $contactInfo->address }}</li>
                @endif
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-v4-section">
              <h4 class="footer-v4-title">Follow Us</h4>
              @if (count($socialMediaInfos) > 0)
                <div class="footer-v4-social">
                  @foreach ($socialMediaInfos as $socialMediaInfo)
                    <a href="{{ $socialMediaInfo->url }}" target="_blank" rel="noopener" class="social-link-v4">
                      <i class="{{ $socialMediaInfo->icon }}"></i>
                    </a>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="footer-v4-divider"></div>

      <div class="footer-v4-bottom">
        <div class="row align-items-center">
          <div class="col-md-6">
            <p class="footer-v4-copyright">
              {!! !empty($footerInfo->copyright_text)
                ? $footerInfo->copyright_text
                : 'Copyright © ' . date('Y') . ' All Rights Reserved' !!}
            </p>
          </div>
          <div class="col-md-6 text-right">
            <div class="footer-v4-bottom-links">
              <a href="#">Privacy Policy</a>
              <span class="divider">|</span>
              <a href="#">Terms of Service</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>