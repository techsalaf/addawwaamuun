

<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Theme V4 - About Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Home Page')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Theme V4 - About Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Update About Section Settings')); ?></div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="aboutForm" action="<?php echo e(route('admin.theme_v4.update_about_settings')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label><?php echo e(__('Title') . '*'); ?></label>
                  <input type="text" class="form-control" name="title" value="<?php echo e($data->title ?? ''); ?>" placeholder="Enter title" required>
                  <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Subtitle')); ?></label>
                  <input type="text" class="form-control" name="subtitle" value="<?php echo e($data->subtitle ?? ''); ?>" placeholder="Enter subtitle">
                  <?php $__errorArgs = ['subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Description') . '*'); ?></label>
                  <textarea class="form-control" name="description" rows="5" placeholder="Enter description" required><?php echo e($data->description ?? ''); ?></textarea>
                  <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Image')); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(!empty($data->image)): ?>
                      <img src="<?php echo e(asset('assets/img/about-section/' . $data->image)); ?>" alt="image" class="uploaded-about-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-about-img">
                    <?php endif; ?>
                  </div>
                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm about-upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="about-img-input" name="image" accept="image/*">
                    </div>
                  </div>
                  <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Button Text')); ?></label>
                      <input type="text" class="form-control" name="button_text" value="<?php echo e($data->button_text ?? ''); ?>" placeholder="e.g., Learn More">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Button URL')); ?></label>
                      <input type="text" class="form-control ltr" name="button_url" value="<?php echo e($data->button_url ?? ''); ?>" placeholder="https://example.com">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" <?php echo e(($data->status ?? true) ? 'checked' : ''); ?>>
                    <label class="custom-control-label" for="status">
                      <?php echo e(__('Enable this section')); ?>

                    </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="aboutForm" class="btn btn-success">
                <?php echo e(__('Save Settings')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.about-upload-btn').addEventListener('click', function() {
      document.querySelector('.about-img-input').click();
    });
    document.querySelector('.about-img-input').addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
          document.querySelector('.uploaded-about-img').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/theme-v4/about-settings.blade.php ENDPATH**/ ?>