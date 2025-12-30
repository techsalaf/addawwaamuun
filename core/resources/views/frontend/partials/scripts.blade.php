<script>
  "use strict";
  const baseURL = "{{ url('/') }}";
  const vapid_public_key = "{{ env('VAPID_PUBLIC_KEY') }}";
  const langDir = {{ $currentLanguageInfo->direction }};
</script>

{{-- jQuery --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>

{{-- modernizr js --}}
<script type="text/javascript" src="{{ asset('assets/js/modernizr-3.6.0.min.js') }}"></script>

{{-- popper js --}}
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>

{{-- bootstrap js --}}
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

{{-- slick js --}}
<script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>

{{-- isotope-pkgd js --}}
<script type="text/javascript" src="{{ asset('assets/js/isotope-pkgd-3.0.6.min.js') }}"></script>

{{-- imagesloaded-pkgd js --}}
<script type="text/javascript" src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>

{{-- magnific-popup js --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>

{{-- owl-carousel js --}}
<script type="text/javascript" src="{{ asset('assets/js/owl-carousel.min.js') }}"></script>

{{-- nice-select js --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>

{{-- wow js --}}
<script type="text/javascript" src="{{ asset('assets/js/wow.min.js') }}"></script>

{{-- jquery-counterup js --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>

{{-- waypoints js --}}
<script type="text/javascript" src="{{ asset('assets/js/waypoints.min.js') }}"></script>

{{-- toastr js --}}
<script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>

{{-- datatables js --}}
<script type="text/javascript" src="{{ asset('assets/js/datatables-1.10.23.min.js') }}"></script>

{{-- datatables bootstrap js --}}
<script type="text/javascript" src="{{ asset('assets/js/datatables.bootstrap4.min.js') }}"></script>

{{-- highlight js --}}
<script type="text/javascript" src="{{ asset('assets/js/highlight.pack.js') }}"></script>

{{-- jQuery-ui js --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

{{-- jQuery-syotimer js --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery-syotimer.min.js') }}"></script>

@if (session()->has('success'))
  <script>
    "use strict";
    toastr['success']("{{ __(session('success')) }}");
  </script>
@endif

@if (session()->has('error'))
  <script>
    "use strict";
    toastr['error']("{{ __(session('error')) }}");
  </script>
@endif

@if (session()->has('warning'))
  <script>
    "use strict";
    toastr['warning']("{{ __(session('warning')) }}");
  </script>
@endif

{{-- vanilla-lazyload js --}}
<script type="text/javascript" src="{{ asset('assets/js/vanilla-lazyload.min.js') }}"></script>

@if (request()->routeIs('user.my_course.curriculum'))
  {{-- video js --}}
  <script type="text/javascript" src="{{ asset('assets/js/video.min.js') }}"></script>
@endif

{{-- main js --}}
<script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>

{{-- push-notification js --}}
<script type="text/javascript" src="{{ asset('assets/js/push-notification.js') }}"></script>

@if ($basicInfo->theme_version == 4)
  {{-- theme-v4 js --}}
  <script type="text/javascript" src="{{ asset('assets/js/theme-v4.js') }}"></script>
@endif
