


<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Instructor')); ?></h4>
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
        <a href="#"><?php echo e(__('Instructors')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Instructor')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">
            <?php echo e(__('Edit Instructor')); ?>

          </div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.instructors', ['language' => request()->input('language')])); ?>">
            <span class="btn-label">
              <i class="fas fa-backward" ></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <form id="ajaxEditForm" action="<?php echo e(route('admin.update_instructor', ['id' => $instructor->id])); ?>" method="POST" enctype="multipart/form-data">
                
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label for=""><?php echo e(__('Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <img src="<?php echo e(asset('assets/img/instructors/' . $instructor->image)); ?>" alt="image" class="uploaded-img">
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="image">
                    </div>
                  </div>
                  <p id="editErr_image" class="mt-2 mb-0 text-danger em"></p>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label><?php echo e(__('Name') . '*'); ?></label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Instructor Name" value="<?php echo e($instructor->name); ?>">
                      <p id="editErr_name" class="mt-2 mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label><?php echo e(__('Occupation') . '*'); ?></label>
                      <input type="text" class="form-control" name="occupation" placeholder="Enter Instructor Occupation" value="<?php echo e($instructor->occupation); ?>">
                      <p id="editErr_occupation" class="mt-2 mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group pb-0">
                      <label><?php echo e(__('Description') . '*'); ?></label>
                      <textarea class="form-control summernote" name="description" placeholder="Enter Instructor Description" data-height="300"><?php echo e($instructor->description); ?></textarea>
                      <p id="editErr_description" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-success" id="updateBtn">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/instructor/edit.blade.php ENDPATH**/ ?>