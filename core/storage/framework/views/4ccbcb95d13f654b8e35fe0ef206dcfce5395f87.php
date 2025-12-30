

<?php $__env->startSection('content'); ?>
  <div class="mt-2 mb-4">
    <h2 class="text-white pb-2"><?php echo e(__('Welcome back,')); ?> <?php if(Auth::guard('admin')->check()): ?> <?php echo e(Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name . '!'); ?> <?php endif; ?></h2>
  </div>

  
  <?php
    if (!is_null($roleInfo)) {
      $rolePermissions = json_decode($roleInfo->permissions);
    }
  ?>

  <div class="row dashboard-items">
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.course_management.courses', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-success card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-book"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Courses')); ?></p>
                    <h4 class="card-title"><?php echo e($totalCourses); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.course_management.categories', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-danger card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-sitemap"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Course Categories')); ?></p>
                    <h4 class="card-title"><?php echo e($totalCourseCategories); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Course Enrolments', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.course_enrolments')); ?>">
          <div class="card card-stats card-primary card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-users-class"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Course Enrolments')); ?></p>
                    <h4 class="card-title"><?php echo e($totalCourseEnrolments); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Instructors', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.instructors', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-warning card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-chalkboard-teacher"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Instructors')); ?></p>
                    <h4 class="card-title"><?php echo e($totalInstructors); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.blog_management.blogs', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-info card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-blog"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Blog')); ?></p>
                    <h4 class="card-title"><?php echo e($totalBlog); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('User Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.user_management.registered_users')); ?>">
          <div class="card card-stats card-secondary card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="la flaticon-users"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Registered Users')); ?></p>
                    <h4 class="card-title"><?php echo e($totalRegisteredUsers); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Monthly Income')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="incomeChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Monthly Enrolments')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="enrolmentChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  
  <script type="text/javascript" src="<?php echo e(asset('assets/js/chart.min.js')); ?>"></script>

  <script>
    "use strict";
    const monthArr = <?php echo json_encode($months) ?>;
    const incomeArr = <?php echo json_encode($incomes) ?>;
    const enrolmentArr = <?php echo json_encode($enrolments) ?>;
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/chart-init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/admin/dashboard.blade.php ENDPATH**/ ?>