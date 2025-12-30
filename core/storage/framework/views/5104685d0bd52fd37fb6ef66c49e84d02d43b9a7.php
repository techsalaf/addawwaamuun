<!DOCTYPE html>
<html lang="<?php echo e($currentLanguageInfo->code); ?>" <?php if($currentLanguageInfo->direction == 1): ?> dir="rtl" <?php endif; ?>>
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo $__env->yieldContent('pageHeading'); ?> <?php echo e('| ' . config('app.name')); ?></title>

    <meta name="keywords" content="<?php echo $__env->yieldContent('metaKeywords'); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('metaDescription'); ?>">

    
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/img/' . ($websiteInfo->favicon ?? 'favicon.png'))); ?>">

    
    <?php if ($__env->exists('frontend.partials.styles')) echo $__env->make('frontend.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->yieldContent('style'); ?>
  </head>

  <body>
    
    <?php if($basicInfo->theme_version == 4): ?>
      <?php if ($__env->exists('frontend.partials.preloader-v4')) echo $__env->make('frontend.partials.preloader-v4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
      <div id="preloader">
        <div id="status">
          <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    

    
    <?php if(!request()->routeIs('user.my_course.curriculum')): ?>
      <?php if($basicInfo->theme_version == 1): ?>
        <header class="header-area header-area-one">
          
          <?php if ($__env->exists('frontend.partials.header.header-top-v1')) echo $__env->make('frontend.partials.header.header-top-v1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          
          <?php if ($__env->exists('frontend.partials.header.header-nav-v1')) echo $__env->make('frontend.partials.header.header-nav-v1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </header>
      <?php elseif($basicInfo->theme_version == 2): ?>
        <header class="header-area header-area-two">
          
          <?php if ($__env->exists('frontend.partials.header.header-nav-v2')) echo $__env->make('frontend.partials.header.header-nav-v2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </header>
      <?php elseif($basicInfo->theme_version == 4): ?>
        <header class="header-area header-area-v4">
          
          <?php if ($__env->exists('frontend.partials.header.header-nav-v4')) echo $__env->make('frontend.partials.header.header-nav-v4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </header>
      <?php else: ?>
        <header class="header-area header-area-three">
          
          <?php if ($__env->exists('frontend.partials.header.header-top-v3')) echo $__env->make('frontend.partials.header.header-top-v3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          
          <?php if ($__env->exists('frontend.partials.header.header-nav-v3')) echo $__env->make('frontend.partials.header.header-nav-v3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </header>
      <?php endif; ?>
    <?php endif; ?>
    

    <?php echo $__env->yieldContent('content'); ?>

    
    <div class="back-to-top">
      <a href="#">
        <i class="fal fa-chevron-double-up"></i>
      </a>
    </div>
    

    
    <?php if ($__env->exists('frontend.partials.popups')) echo $__env->make('frontend.partials.popups', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if(!is_null($cookieAlertInfo) && $cookieAlertInfo->cookie_alert_status == 1): ?>
      <?php if ($__env->exists('cookieConsent::index')) echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    
    <?php if(!request()->routeIs('user.my_course.curriculum')): ?>
      <?php if($basicInfo->theme_version == 1 || $basicInfo->theme_version == 3): ?>
        <?php if ($__env->exists('frontend.partials.footer.footer')) echo $__env->make('frontend.partials.footer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php elseif($basicInfo->theme_version == 4): ?>
        <?php if ($__env->exists('frontend.partials.footer.footer-v4')) echo $__env->make('frontend.partials.footer.footer-v4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php else: ?>
        <?php if ($__env->exists('frontend.partials.footer.footer-v2')) echo $__env->make('frontend.partials.footer.footer-v2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
    <?php endif; ?>

    
    <?php if ($__env->exists('frontend.partials.scripts')) echo $__env->make('frontend.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->yieldContent('script'); ?>
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/layout.blade.php ENDPATH**/ ?>