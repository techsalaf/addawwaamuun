<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Coupon')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="<?php echo e(route('admin.course_management.update_coupon')); ?>" method="post">
          
          <?php echo csrf_field(); ?>
          <input type="hidden" id="in_id" name="id">

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Name') . '*'); ?></label>
                <input type="text" id="in_name" class="form-control" name="name" placeholder="Enter Coupon Name">
                <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Code') . '*'); ?></label>
                <input type="text" id="in_code" class="form-control" name="code" placeholder="Enter Coupon Code">
                <p id="editErr_code" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Coupon Type') . '*'); ?></label>
                <select name="type" id="in_type" class="form-control">
                  <option disabled><?php echo e(__('Select a Type')); ?></option>
                  <option value="fixed"><?php echo e(__('Fixed')); ?></option>
                  <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                </select>
                <p id="editErr_type" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Value') . '*'); ?></label>
                <input type="number" step="0.01" id="in_value" class="form-control" name="value" placeholder="Enter Coupon Value">
                <p id="editErr_value" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Start Date') . '*'); ?></label>
                <input type="text" id="in_start_date" class="form-control datepicker" name="start_date" placeholder="Enter Start Date">
                <p id="editErr_start_date" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('End Date') . '*'); ?></label>
                <input type="text" id="in_end_date" class="form-control datepicker" name="end_date" placeholder="Enter End Date">
                <p id="editErr_end_date" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Courses') . '*'); ?></label>
                <select id="in_courses" class="select2" name="courses[]" multiple="multiple" placeholder="Select Courses">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $courseInfo = $course->information()->where('language_id', $deLang->id)->select('title', 'id')->first();
                            $title = $courseInfo->title;
                            $id = $course->id;
                        ?>
                        <option value="<?php echo e($id); ?>">
                          <?php echo e($title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p id="editErr_courses" class="mt-1 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>
          
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
          <?php echo e(__('Close')); ?>

        </button>
        <button id="updateBtn" type="button" class="btn btn-sm btn-primary">
          <?php echo e(__('Update')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/coupon/edit.blade.php ENDPATH**/ ?>