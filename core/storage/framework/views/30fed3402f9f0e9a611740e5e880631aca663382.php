

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Thanks Page')); ?></h4>
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
        <a href="#"><?php echo e(__('Course Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.course_management.courses', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Courses')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <?php
          $title = $course->information()->where('language_id', $language->id)->pluck('title')->first();
        ?>
        
        <a href="#"><?php echo e(strlen($title) > 35 ? mb_substr($title, 0, 35, 'UTF-8') . '...' : $title); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Thanks Page')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Edit Thanks Page')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.course_management.courses', ['language' => $defaultLang->code])); ?>">
            <span class="btn-label">
              <i class="fas fa-backward" ></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="thanksPageErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>

              <form id="thanksPageForm" action="<?php echo e(route('admin.course_management.course.update_thanks_page', ['id' => $course->id])); ?>" method="POST">
                
                <?php echo csrf_field(); ?>
                <div id="accordion" class="mt-3">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $courseData = $language->courseInformation()->where('course_id', $course->id)->first();
                    ?>

                    <div class="version">
                      <div class="version-header" id="heading<?php echo e($language->id); ?>">
                        <h5 class="mb-0">
                          <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($language->id); ?>" aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>" aria-controls="collapse<?php echo e($language->id); ?>">
                            <?php echo e($language->name . __(' Language')); ?> <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                          </button>
                        </h5>
                      </div>

                      <div id="collapse<?php echo e($language->id); ?>" class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>" aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Content') . '*'); ?></label>
                                <textarea class="form-control summernote" name="<?php echo e($language->code); ?>_thanks_page_content" placeholder="Enter Page Content" data-height="300"><?php echo e(is_null($courseData->thanks_page_content) ? '' : replaceBaseUrl($courseData->thanks_page_content, 'summernote')); ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="thanksPageForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/admin-partial.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/course/thanks-page.blade.php ENDPATH**/ ?>