


<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Hero Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Hero Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <div class="card-title"><?php echo e(__('Update Hero Section')); ?></div>
            </div>

            <div class="col-lg-2">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="heroForm" action="<?php echo e(route('admin.home_page.update_hero_section')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="language" value="<?php echo e(request()->input('language', isset($language) ? $language->code : '')); ?>">
                <div class="form-group">
                  <label for=""><?php echo e(__('Background Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(!empty($data->background_image)): ?>
                      <img src="<?php echo e(asset('assets/img/hero-section/' . $data->background_image)); ?>" alt="background image" class="uploaded-background-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-background-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="background-img-input" name="background_image">
                    </div>
                  </div>
                  <?php $__errorArgs = ['background_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><?php echo e(__('First Title')); ?></label>
                      <input type="text" class="form-control" name="first_title" value="<?php echo e(empty($data->first_title) ? '' : $data->first_title); ?>" placeholder="Enter First Title">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Second Title')); ?></label>
                      <input type="text" class="form-control" name="second_title" value="<?php echo e(empty($data->second_title) ? '' : $data->second_title); ?>" placeholder="Enter Second Title">
                    </div>
                  </div>
                </div>

                <?php if($themeInfo->theme_version == 1 || $themeInfo->theme_version == 3): ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for=""><?php echo e(__('First Button')); ?></label>
                        <input type="text" class="form-control" name="first_button" value="<?php echo e(empty($data->first_button) ? '' : $data->first_button); ?>" placeholder="Enter First Button Name">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for=""><?php echo e(__('First Button URL')); ?></label>
                        <input type="text" class="form-control ltr" name="first_button_url" value="<?php echo e(empty($data->first_button_url) ? '' : $data->first_button_url); ?>" placeholder="Enter First Button URL">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for=""><?php echo e(__('Second Button')); ?></label>
                        <input type="text" class="form-control" name="second_button" value="<?php echo e(empty($data->second_button) ? '' : $data->second_button); ?>" placeholder="Enter Second Button Name">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for=""><?php echo e(__('Second Button URL')); ?></label>
                        <input type="text" class="form-control ltr" name="second_button_url" value="<?php echo e(empty($data->second_button_url) ? '' : $data->second_button_url); ?>" placeholder="Enter Second Button URL">
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version == 2): ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for=""><?php echo e(__('Video URL')); ?></label>
                        <input type="text" class="form-control ltr" name="video_url" value="<?php echo e(empty($data->video_url) ? '' : $data->video_url); ?>" placeholder="Enter Video URL">
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version == 3): ?>
                  <div class="form-group">
                    <label for=""><?php echo e(__('Image')); ?></label>
                    <br>
                    <div class="thumb-preview">
                      <?php if(!empty($data->image)): ?>
                        <img src="<?php echo e(asset('assets/img/hero-section/' . $data->image)); ?>" alt="image" class="uploaded-img">
                      <?php else: ?>
                        <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                      <?php endif; ?>
                    </div>

                    <div class="mt-3">
                      <div role="button" class="btn btn-primary btn-sm upload-btn">
                        <?php echo e(__('Choose Image')); ?>

                        <input type="file" class="img-input" name="image">
                      </div>
                    </div>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="heroForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/hero-section.blade.php ENDPATH**/ ?>