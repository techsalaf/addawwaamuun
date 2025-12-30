<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Course Enrolments')); ?></h4>
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
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('Course Enrolments')); ?></div>
            </div>

            <div class="col-lg-6 offset-lg-2">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete ml-3 mt-1" data-href="<?php echo e(route('admin.course_enrolments.bulk_delete')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>

              <form class="float-right ml-3" action="<?php echo e(route('admin.course_enrolments')); ?>" method="GET">
                <input name="order_id" type="text" class="form-control" placeholder="Search By Order ID" value="<?php echo e(!empty(request()->input('order_id')) ? request()->input('order_id') : ''); ?>">
              </form>

              <form id="searchByStatusForm" class="float-right d-flex flex-row align-items-center" action="<?php echo e(route('admin.course_enrolments')); ?>" method="GET">
                <label class="mr-2"><?php echo e(__('Payment')); ?></label>
                <select class="form-control" name="status" onchange="document.getElementById('searchByStatusForm').submit()">
                  <option value="" <?php echo e(empty(request()->input('status')) ? 'selected' : ''); ?>>
                    <?php echo e(__('All')); ?>

                  </option>
                  <option value="completed" <?php echo e(request()->input('status') == 'completed' ? 'selected' : ''); ?>>
                    <?php echo e(__('Completed')); ?>

                  </option>
                  <option value="pending" <?php echo e(request()->input('status') == 'pending' ? 'selected' : ''); ?>>
                    <?php echo e(__('Pending')); ?>

                  </option>
                  <option value="rejected" <?php echo e(request()->input('status') == 'rejected' ? 'selected' : ''); ?>>
                    <?php echo e(__('Rejected')); ?>

                  </option>
                </select>
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($enrolments) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO ENROLMENT FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Order ID.')); ?></th>
                        <th scope="col"><?php echo e(__('Course')); ?></th>
                        <th scope="col"><?php echo e(__('Username')); ?></th>
                        <th scope="col"><?php echo e(__('Paid via')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                        <th scope="col"><?php echo e(__('Attachment')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $enrolments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrolment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($enrolment->id); ?>">
                          </td>
                          <td><?php echo e('#' . $enrolment->order_id); ?></td>

                          <?php
                            $course = $enrolment->course()->first();
                            $courseInfo = $course->information()->where('language_id', $defaultLang->id)->first();
                            $title = $courseInfo->title;
                            $slug = $courseInfo->slug;
                          ?>

                          <td>
                            <a href="<?php echo e(url('/course/' . $slug)); ?>" target="_blank">
                              <?php echo e(strlen($title) > 35 ? mb_substr($title, 0, 35, 'utf-8') . '...' : $title); ?>

                            </a>
                          </td>

                          <?php
                            $user = $enrolment->userInfo()->first();
                          ?>

                          <td><?php echo e($user->username); ?></td>
                          <td><?php echo e(!is_null($enrolment->payment_method) ? $enrolment->payment_method : '-'); ?></td>
                          <td>
                            <?php if($enrolment->gateway_type == 'online'): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Completed')); ?></span></h2>
                            <?php elseif($enrolment->gateway_type == 'offline'): ?>
                              <form id="paymentStatusForm-<?php echo e($enrolment->id); ?>" class="d-inline-block" action="<?php echo e(route('admin.course_enrolment.update_payment_status', ['id' => $enrolment->id])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <select class="form-control form-control-sm <?php if($enrolment->payment_status == 'completed'): ?> bg-success <?php elseif($enrolment->payment_status == 'pending'): ?> bg-warning text-dark <?php else: ?> bg-danger <?php endif; ?>" name="payment_status" onchange="document.getElementById('paymentStatusForm-<?php echo e($enrolment->id); ?>').submit()">
                                  <option value="completed" <?php echo e($enrolment->payment_status == 'completed' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Completed')); ?>

                                  </option>
                                  <option value="pending" <?php echo e($enrolment->payment_status == 'pending' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Pending')); ?>

                                  </option>
                                  <option value="rejected" <?php echo e($enrolment->payment_status == 'rejected' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Rejected')); ?>

                                  </option>
                                </select>
                              </form>
                            <?php else: ?>
                              -
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if(!is_null($enrolment->attachment)): ?>
                              <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#attachmentModal-<?php echo e($enrolment->id); ?>">
                                <?php echo e(__('Show')); ?>

                              </a>
                            <?php else: ?>
                              -
                            <?php endif; ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('admin.course_enrolment.details', ['id' => $enrolment->id])); ?>" class="dropdown-item">
                                  <?php echo e(__('Details')); ?>

                                </a>

                                <a href="<?php echo e(asset('assets/file/invoices/' . $enrolment->invoice)); ?>" class="dropdown-item" target="_blank">
                                  <?php echo e(__('Invoice')); ?>

                                </a>

                                <form class="deleteForm d-block" action="<?php echo e(route('admin.course_enrolment.delete', ['id' => $enrolment->id])); ?>" method="post">
                                  
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <?php if ($__env->exists('backend.curriculum.enrolment.show-attachment')) echo $__env->make('backend.curriculum.enrolment.show-attachment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer text-center">
          <div class="d-inline-block mt-3">
            <?php echo e($enrolments->appends([
              'order_id' => request()->input('order_id'),
              'status' => request()->input('status')
            ])->links()); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/enrolment/index.blade.php ENDPATH**/ ?>