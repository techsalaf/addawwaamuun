

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Plugins')); ?></h4>
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
        <a href="#"><?php echo e(__('Plugins')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.basic_settings.update_disqus')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Disqus')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Disqus Status*')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="disqus_status" value="1" class="selectgroup-input" <?php echo e($data->disqus_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="disqus_status" value="0" class="selectgroup-input" <?php echo e($data->disqus_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('disqus_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('disqus_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Disqus Short Name*')); ?></label>
                  <input type="text" class="form-control" name="disqus_short_name" value="<?php echo e($data->disqus_short_name); ?>">

                  <?php if($errors->has('disqus_short_name')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('disqus_short_name')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.basic_settings.update_recaptcha')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Google Recaptcha')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Recaptcha Status*')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="google_recaptcha_status" value="1" class="selectgroup-input" <?php echo e($data->google_recaptcha_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="google_recaptcha_status" value="0" class="selectgroup-input" <?php echo e($data->google_recaptcha_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('google_recaptcha_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Recaptcha Site Key*')); ?></label>
                  <input type="text" class="form-control" name="google_recaptcha_site_key" value="<?php echo e($data->google_recaptcha_site_key); ?>">

                  <?php if($errors->has('google_recaptcha_site_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_site_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Recaptcha Secret Key*')); ?></label>
                  <input type="text" class="form-control" name="google_recaptcha_secret_key" value="<?php echo e($data->google_recaptcha_secret_key); ?>">

                  <?php if($errors->has('google_recaptcha_secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/basic-settings/plugins.blade.php ENDPATH**/ ?>