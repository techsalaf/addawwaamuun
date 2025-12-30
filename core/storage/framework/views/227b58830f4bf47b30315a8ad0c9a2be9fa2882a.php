

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <h4 class="page-title"><?php echo e(__('Footer Logo')); ?></h4>
  <ul class="breadcrumbs">
    <li class="nav-home">
      <a href="<?php echo e(route('admin.dashboard')); ?>">
        <i class="flaticon-home"></i>
      </a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#"><?php echo e(__('Basic Settings')); ?></a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#"><?php echo e(__('Footer Logo')); ?></a>
    </li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-4">
            <div class="card-title"><?php echo e(__('Update Footer Logo')); ?></div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="imageForm" action="<?php echo e(route('admin.basic_settings.update_footer_logo')); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="form-group">
                <label for=""><?php echo e(__('Footer Logo') . '*'); ?></label>
                <br>
                <div class="thumb-preview">
                  <?php if(!empty($data->footer_logo)): ?>
                    <img src="<?php echo e(asset('assets/img/' . $data->footer_logo)); ?>" alt="footer logo" class="uploaded-img">
                  <?php else: ?>
                    <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                  <?php endif; ?>
                </div>

                <div class="mt-3">
                  <div role="button" class="btn btn-primary btn-sm upload-btn">
                    <?php echo e(__('Choose Image')); ?>

                    <input type="file" class="img-input" name="footer_logo">
                  </div>
                </div>
                <?php if($errors->has('footer_logo')): ?>
                  <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('footer_logo')); ?></p>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-12 text-center">
            <button type="submit" form="imageForm" class="btn btn-success">
              <?php echo e(__('Update')); ?>

            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/basic-settings/footer-logo.blade.php ENDPATH**/ ?>