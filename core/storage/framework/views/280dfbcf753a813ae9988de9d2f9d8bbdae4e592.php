<script>
  'use strict';

  const baseUrl = "<?php echo e(url('/')); ?>";
</script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-1.12.4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.timepicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.scrollbar.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-notify.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/sweetalert.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-tagsinput.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/summernote-bs4.min.js')); ?>"></script>

<!-- Select2 JS -->
<script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jscolor.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/fontawesome-iconpicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/datatables-1.10.23.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/datatables.bootstrap4.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/highlight.pack.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/atlantis.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/webfont.min.js')); ?>"></script>

<script>
  "use strict";
  WebFont.load({
    google: {"families": ["Lato:300,400,700,900"]},
    custom: {"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo e(asset("assets/css/fonts.min.css")); ?>']},
    active: function() {
      sessionStorage.fonts = true;
    }
  });
</script>

<?php if(session()->has('success')): ?>
  <script>
    "use strict";
    var content = {};

    content.message = '<?php echo e(session('success')); ?>';
    content.title = 'Success';
    content.icon = 'fa fa-bell';

    $.notify(content, {
      type: 'success',
      placement: {
        from: 'top',
        align: 'right'
      },
      showProgressbar: true,
      time: 1000,
      delay: 4000
    });
  </script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
  <script>
    "use strict";
    var content = {};

    content.message = '<?php echo e(session('warning')); ?>';
    content.title = 'Warning!';
    content.icon = 'fa fa-bell';

    $.notify(content, {
      type: 'warning',
      placement: {
        from: 'top',
        align: 'right'
      },
      showProgressbar: true,
      time: 1000,
      delay: 4000
    });
  </script>
<?php endif; ?>


<script type="text/javascript" src="<?php echo e(asset('assets/js/admin-main.js')); ?>"></script>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/partials/scripts.blade.php ENDPATH**/ ?>