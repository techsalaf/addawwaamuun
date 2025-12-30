<!--====== PAGE TITLE PART START ======-->
<div class="page-title bg_cover pt-140 pb-140 lazy" <?php if(!empty($breadcrumb)): ?> data-bg="<?php echo e(asset('assets/img/' . $breadcrumb)); ?>" <?php endif; ?>>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="page-title-item text-center">
          <h3 class="title"><?php echo e(!empty($title) ? $title : ''); ?></h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(!empty($title) ? $title : ''); ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!--====== PAGE TITLE PART END ======-->
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/breadcrumb.blade.php ENDPATH**/ ?>