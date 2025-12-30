<script>
  "use strict";
  const baseURL = "<?php echo e(url('/')); ?>";
  const vapid_public_key = "<?php echo e(env('VAPID_PUBLIC_KEY')); ?>";
  const langDir = <?php echo e($currentLanguageInfo->direction); ?>;
</script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-1.12.4.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/modernizr-3.6.0.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/slick.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/isotope-pkgd-3.0.6.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/imagesloaded.pkgd.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.magnific-popup.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/owl-carousel.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.nice-select.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.counterup.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/waypoints.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/datatables-1.10.23.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/datatables.bootstrap4.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/highlight.pack.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-syotimer.min.js')); ?>"></script>

<?php if(session()->has('success')): ?>
  <script>
    "use strict";
    toastr['success']("<?php echo e(__(session('success'))); ?>");
  </script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
  <script>
    "use strict";
    toastr['error']("<?php echo e(__(session('error'))); ?>");
  </script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
  <script>
    "use strict";
    toastr['warning']("<?php echo e(__(session('warning'))); ?>");
  </script>
<?php endif; ?>


<script type="text/javascript" src="<?php echo e(asset('assets/js/vanilla-lazyload.min.js')); ?>"></script>

<?php if(request()->routeIs('user.my_course.curriculum')): ?>
  
  <script type="text/javascript" src="<?php echo e(asset('assets/js/video.min.js')); ?>"></script>
<?php endif; ?>


<script type="text/javascript" src="<?php echo e(asset('assets/js/main.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/push-notification.js')); ?>"></script>

<?php if($basicInfo->theme_version == 4): ?>
  
  <script type="text/javascript" src="<?php echo e(asset('assets/js/theme-v4.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/scripts.blade.php ENDPATH**/ ?>