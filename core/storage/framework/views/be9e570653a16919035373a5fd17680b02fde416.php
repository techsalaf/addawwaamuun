<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title>404</title>

    
    

    
    <?php if ($__env->exists('frontend.partials.styles')) echo $__env->make('frontend.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->yieldContent('style'); ?>
  </head>

  <body>
    
      <!--====== 404 PART START ======-->
      <section class="error-area d-flex align-items-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="error-content">
                <span>
                  <?php echo e(__('404! Page Not Found')); ?>

                </span>
                <h2 class="title"><?php echo e(__('Oops! Looks Like You Are Lost in Ocean')); ?></h2>
                <ul>
                  <li><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Get Back to Home')); ?></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    
        <div class="error-thumb">
          <img src="<?php echo e(asset('assets/img/error.png')); ?>" alt="error">
        </div>
      </section>
      <!--====== 404 PART ENDS ======-->
  </body>

</html><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/errors/404.blade.php ENDPATH**/ ?>