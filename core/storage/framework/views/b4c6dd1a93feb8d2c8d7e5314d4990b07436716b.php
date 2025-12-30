

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Coupons')); ?></h4>
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
        <a href="#"><?php echo e(__('Coupons')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title d-inline-block"><?php echo e(__('Coupons')); ?></div>
            </div>

            <div class="col-lg-4 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i> <?php echo e(__('Add Coupon')); ?></a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($coupons) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO COUPON FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Code')); ?></th>
                        <th scope="col"><?php echo e(__('Discount')); ?></th>
                        <th scope="col"><?php echo e(__('Created')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                          $todayDate = Carbon\Carbon::now();
                          $date1 = Carbon\Carbon::parse($coupon->start_date);
                          $date2 = Carbon\Carbon::parse($coupon->end_date);
                        ?>

                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                            <?php echo e(strlen($coupon->name) > 30 ? mb_substr($coupon->name, 0, 30, 'UTF-8') . '...' : $coupon->name); ?>

                          </td>
                          <td><?php echo e($coupon->code); ?></td>
                          <td>
                            <?php if($coupon->type == 'fixed'): ?>
                              <?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?> <?php echo e($coupon->value); ?> <?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?>

                            <?php else: ?>
                              <?php echo e($coupon->value . '%'); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php
                              $createDate = $coupon->created_at;

                              // first, get the difference of create-date & today-date
                              $diff = $createDate->diffInDays($todayDate);
                            ?>

                            
                            <?php echo e($createDate->subDays($diff)->diffForHumans()); ?>

                          </td>

                          <td>
                            <?php if($date1->greaterThan($todayDate)): ?>
                              <h2 class="d-inline-block"><span class="badge badge-warning"><?php echo e(__('Pending')); ?></span></h2>
                            <?php elseif($todayDate->between($date1, $date2)): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Active')); ?></span></h2>
                            <?php elseif($date2->lessThan($todayDate)): ?>
                              <h2 class="d-inline-block"><span class="badge badge-danger"><?php echo e(__('Expired')); ?></span></h2>
                            <?php endif; ?>
                          </td>
                          
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($coupon->id); ?>" data-name="<?php echo e($coupon->name); ?>" data-code="<?php echo e($coupon->code); ?>" data-type="<?php echo e($coupon->type); ?>" data-courses="<?php echo e($coupon->courses); ?>" data-value="<?php echo e($coupon->value); ?>" data-start_date="<?php echo e(date_format($date1, 'm/d/Y')); ?>" data-end_date="<?php echo e(date_format($date2, 'm/d/Y')); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.course_management.delete_coupon', ['id' => $coupon->id])); ?>" method="post">
                              
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <?php echo e(__('Delete')); ?>

                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  
  <?php echo $__env->make('backend.curriculum.coupon.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.curriculum.coupon.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/coupon/index.blade.php ENDPATH**/ ?>