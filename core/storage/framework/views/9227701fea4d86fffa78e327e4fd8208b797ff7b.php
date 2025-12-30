

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Enrolment Details')); ?></h4>
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
        <a href="#"><?php echo e(__('Course Enrolments')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Enrolment Details')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <?php
      $position = $enrolmentInfo->currency_text_position;
      $currency = $enrolmentInfo->currency_text;
    ?>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">
            <?php echo e(__('Order Id.') . ' ' . '#' . $enrolmentInfo->order_id); ?>

          </div>
        </div>

        <div class="card-body">
          <div class="payment-information">
            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Course') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($courseTitle); ?>

              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Course Price') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php if(!is_null($enrolmentInfo->course_price)): ?>
                  <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($enrolmentInfo->course_price); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                <?php else: ?>
                  -
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong class="text-success"><?php echo e(__('Discount')); ?> <span>(<i class="far fa-minus"></i>)</span> :</strong>
              </div>
              <div class="col-lg-8">
                <?php if(!is_null($enrolmentInfo->discount)): ?>
                  <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($enrolmentInfo->discount); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                <?php else: ?>
                  -
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Total') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php if(!is_null($enrolmentInfo->grand_total)): ?>
                  <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($enrolmentInfo->grand_total); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                <?php else: ?>
                  -
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Paid Via') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php if(!is_null($enrolmentInfo->payment_method)): ?>
                  <?php echo e($enrolmentInfo->payment_method); ?>

                <?php else: ?>
                  -
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Payment Status') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php if($enrolmentInfo->payment_status == 'completed'): ?>
                  <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                <?php elseif($enrolmentInfo->payment_status == 'pending'): ?>
                  <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                <?php elseif($enrolmentInfo->payment_status == 'rejected'): ?>
                  <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                <?php else: ?>
                  -
                <?php endif; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <strong><?php echo e(__('Enrol Date') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e(date_format($enrolmentInfo->created_at, 'M d, Y')); ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">
            <?php echo e(__('Billing Details')); ?>

          </div>
        </div>

        <div class="card-body">
          <div class="payment-information">
            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Name') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($enrolmentInfo->billing_first_name . ' ' . $enrolmentInfo->billing_last_name); ?>

              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Email') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($enrolmentInfo->billing_email); ?>

              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Phone') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($enrolmentInfo->billing_contact_number); ?>

              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Address') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($enrolmentInfo->billing_address); ?>

              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('City') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($enrolmentInfo->billing_city); ?>

              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('State') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php if(!is_null($enrolmentInfo->billing_state)): ?>
                  <?php echo e($enrolmentInfo->billing_state); ?>

                <?php else: ?>
                  -
                <?php endif; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <strong><?php echo e(__('Country') . ' :'); ?></strong>
              </div>
              <div class="col-lg-8">
                <?php echo e($enrolmentInfo->billing_country); ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/enrolment/details.blade.php ENDPATH**/ ?>