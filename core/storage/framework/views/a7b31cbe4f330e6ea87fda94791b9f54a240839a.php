


<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Section Titles')); ?></h4>
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
        <a href="#"><?php echo e(__('Section Titles')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.home_page.update_section_title', ['language' => request()->input('language')])); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-10">
                <div class="card-title"><?php echo e(__('Update Section Titles')); ?></div>
              </div>

              <div class="col-lg-2">
                <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <?php if($themeInfo->theme_version == 1): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Category Section Title')); ?></label>
                    <input class="form-control" name="category_section_title" value="<?php echo e(empty($data->category_section_title) ? '' : $data->category_section_title); ?>" placeholder="Enter Category Section Title">
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label><?php echo e(__('Featured Courses Section Title')); ?></label>
                  <input class="form-control" name="featured_courses_section_title" value="<?php echo e(empty($data->featured_courses_section_title) ? '' : $data->featured_courses_section_title); ?>" placeholder="Enter Featured Courses Section Title">
                </div>

                <?php if($themeInfo->theme_version == 2): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Featured Instructors Section Title')); ?></label>
                    <input class="form-control" name="featured_instructors_section_title" value="<?php echo e(empty($data->featured_instructors_section_title) ? '' : $data->featured_instructors_section_title); ?>" placeholder="Enter Featured Instructors Section Title">
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('Testimonials Section Title')); ?></label>
                    <input class="form-control" name="testimonials_section_title" value="<?php echo e(empty($data->testimonials_section_title) ? '' : $data->testimonials_section_title); ?>" placeholder="Enter Testimonials Section Title">
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version == 3): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Features Section Title')); ?></label>
                    <input class="form-control" name="features_section_title" value="<?php echo e(empty($data->features_section_title) ? '' : $data->features_section_title); ?>" placeholder="Enter Features Section Title">
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('Blog Section Title')); ?></label>
                    <input class="form-control" name="blog_section_title" value="<?php echo e(empty($data->blog_section_title) ? '' : $data->blog_section_title); ?>" placeholder="Enter Blog Section Title">
                  </div>
                <?php endif; ?>
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

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/section-titles.blade.php ENDPATH**/ ?>