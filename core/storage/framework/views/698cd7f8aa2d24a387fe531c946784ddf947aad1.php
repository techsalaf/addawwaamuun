
<link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/all.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/flaticon.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/magnific-popup.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/owl-carousel.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/nice-select.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/toastr.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/datatables-1.10.23.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/datatables.bootstrap4.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/monokai-sublime.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/jquery-ui.min.css')); ?>">

<?php if(request()->routeIs('user.my_course.curriculum')): ?>
  
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/video.min.css')); ?>">
<?php endif; ?>


<link rel="stylesheet" href="<?php echo e(asset('assets/css/default.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/css/mega-menu.css')); ?>">

<?php if($currentLanguageInfo->direction == 1): ?>
  
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/rtl.css')); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/rtl-responsive.css')); ?>">
<?php endif; ?>

<?php
  $primaryColor = '2079FF';

  if (!empty($basicInfo->primary_color)) {
    $primaryColor = $basicInfo->primary_color;
  }

  $secondaryColor = 'F16001';

  if (!empty($basicInfo->secondary_color)) {
    $secondaryColor = $basicInfo->secondary_color;
  }

  $footerBackgroundColor = '001B61';

  if (!empty($footerInfo->footer_background_color)) {
    $footerBackgroundColor = $footerInfo->footer_background_color;
  }

  $copyrightBackgroundColor = '003A91';

  if (!empty($footerInfo->copyright_background_color)) {
    $copyrightBackgroundColor = $footerInfo->copyright_background_color;
  }

  $breadcrumbOverlayColor = '001B61';

  if (!empty($basicInfo->breadcrumb_overlay_color)) {
    $breadcrumbOverlayColor = $basicInfo->breadcrumb_overlay_color;
  }

  $breadcrumbOverlayOpacity = 0.5;

  if (!empty($basicInfo->breadcrumb_overlay_opacity)) {
    $breadcrumbOverlayOpacity = $basicInfo->breadcrumb_overlay_opacity;
  }
?>


<link rel="stylesheet" href="<?php echo e(asset("assets/css/website-color.php?primary_color=$primaryColor&secondary_color=$secondaryColor&footer_background_color=$footerBackgroundColor&copyright_background_color=$copyrightBackgroundColor&breadcrumb_overlay_color=$breadcrumbOverlayColor&breadcrumb_overlay_opacity=$breadcrumbOverlayOpacity")); ?>">

<?php if($basicInfo->theme_version == 4): ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/theme-v4.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/header-footer-v4.css')); ?>">
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/styles.blade.php ENDPATH**/ ?>