

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($pageInfo->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($pageInfo->meta_keywords); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e($pageInfo->meta_description); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageInfo->title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageInfo->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!--====== PAGE CONTENT PART START ======-->
  <section class="custom-page-area pt-100 pb-90">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="summernote-content">
            <?php echo replaceBaseUrl($pageInfo->content, 'summernote'); ?>

          </div>
        </div>
      </div>

      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-30">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
  <!--====== PAGE CONTENT PART END ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/custom-page.blade.php ENDPATH**/ ?>