<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Theme V4 - CTA Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Theme V4 - CTA Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Update CTA Section Settings')); ?></div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="ctaForm" action="<?php echo e(route('admin.theme_v4.update_cta_settings')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label><?php echo e(__('Title') . '*'); ?></label>
                  <input type="text" class="form-control" name="title" value="<?php echo e($data->title ?? ''); ?>" placeholder="Enter CTA title" required>
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
                  <label><?php echo e(__('Description')); ?></label>
                  <textarea class="form-control" name="description" rows="4" placeholder="Enter description"><?php echo e($data->description ?? ''); ?></textarea>
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
                  <label><?php echo e(__('Background Image')); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(!empty($data->background_image)): ?>
                      <img src="<?php echo e(asset('assets/img/action-section/' . $data->background_image)); ?>" alt="background" class="uploaded-cta-bg-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-cta-bg-img">
                    <?php endif; ?>
                  </div>
                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm cta-upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="cta-bg-img-input" name="background_image" accept="image/*">
                    </div>
                  </div>
                  <?php $__errorArgs = ['background_image'];
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
                      <label><?php echo e(__('Primary Button Text')); ?></label>
                      <input type="text" class="form-control" name="button_1_text" value="<?php echo e($data->button_1_text ?? ''); ?>" placeholder="e.g., Join Now">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Primary Button URL')); ?></label>
                      <input type="text" class="form-control ltr" name="button_1_url" value="<?php echo e($data->button_1_url ?? ''); ?>" placeholder="https://example.com">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Secondary Button Text')); ?></label>
                      <input type="text" class="form-control" name="button_2_text" value="<?php echo e($data->button_2_text ?? ''); ?>" placeholder="e.g., Learn More">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Secondary Button URL')); ?></label>
                      <input type="text" class="form-control ltr" name="button_2_url" value="<?php echo e($data->button_2_url ?? ''); ?>" placeholder="https://example.com">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Gradient Color 1')); ?></label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color" name="gradient_color_1" value="#<?php echo e($data->gradient_color_1 ?? '1866d4'); ?>">
                        <span class="input-group-text">#<?php echo e($data->gradient_color_1 ?? '1866d4'); ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Gradient Color 2')); ?></label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color" name="gradient_color_2" value="#<?php echo e($data->gradient_color_2 ?? '580ce3'); ?>">
                        <span class="input-group-text">#<?php echo e($data->gradient_color_2 ?? '580ce3'); ?></span>
                      </div>
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
              <button type="submit" form="ctaForm" class="btn btn-success">
                <?php echo e(__('Save Settings')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.cta-upload-btn').addEventListener('click', function() {
      document.querySelector('.cta-bg-img-input').click();
    });
    document.querySelector('.cta-bg-img-input').addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
          document.querySelector('.uploaded-cta-bg-img').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });

    // Color picker updates
    document.querySelectorAll('input[type="color"]').forEach(input => {
      input.addEventListener('input', function() {
        this.nextElementSibling.textContent = this.value;
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/theme-v4/cta-settings.blade.php ENDPATH**/ ?>