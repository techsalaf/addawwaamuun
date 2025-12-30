

<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Theme V4 - Search Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Theme V4 - Search Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Update Search Section Settings')); ?></div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="searchForm" action="<?php echo e(route('admin.theme_v4.update_search_settings')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label><?php echo e(__('Title') . '*'); ?></label>
                  <input type="text" class="form-control" name="title" value="<?php echo e($data->title ?? ''); ?>" placeholder="e.g., Find Your Dream Course" required>
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
                  <label><?php echo e(__('Search Field Placeholder')); ?></label>
                  <input type="text" class="form-control" name="search_placeholder" value="<?php echo e($data->search_placeholder ?? ''); ?>" placeholder="e.g., Search courses by name...">
                  <?php $__errorArgs = ['search_placeholder'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Category Dropdown Placeholder')); ?></label>
                  <input type="text" class="form-control" name="category_placeholder" value="<?php echo e($data->category_placeholder ?? ''); ?>" placeholder="e.g., Select Category">
                  <?php $__errorArgs = ['category_placeholder'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Search Button Text')); ?></label>
                  <input type="text" class="form-control" name="button_text" value="<?php echo e($data->button_text ?? ''); ?>" placeholder="e.g., Search">
                  <?php $__errorArgs = ['button_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
              <button type="submit" form="searchForm" class="btn btn-success">
                <?php echo e(__('Save Settings')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/theme-v4/search-settings.blade.php ENDPATH**/ ?>