<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">
        Report
    </h4>
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
        <a href="#">Course Enrolments</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Report</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header p-1">
            <div class="row">
                <div class="col-lg-10">
                    <form action="<?php echo e(url()->full()); ?>" class="form-inline">
                        <div class="form-group">
                            <label for="">From</label>
                            <input class="form-control datepicker" type="text" name="from_date" placeholder="From" value="<?php echo e(request()->input('from_date') ? request()->input('from_date') : ''); ?>" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="">To</label>
                            <input class="form-control datepicker ml-1" type="text" name="to_date" placeholder="To" value="<?php echo e(request()->input('to_date') ? request()->input('to_date') : ''); ?>" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="">Payment Method</label>
                            <select name="payment_method" class="form-control ml-1">
                                <option value="" selected>All</option>
                                <?php if(!empty($onPms)): ?>
                                    <?php $__currentLoopData = $onPms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $onPm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($onPm->keyword); ?>" <?php echo e(request()->input('payment_method') == $onPm->keyword ? 'selected' : ''); ?>><?php echo e($onPm->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if(!empty($offPms)): ?>
                                    <?php $__currentLoopData = $offPms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offPm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($offPm->name); ?>" <?php echo e(request()->input('payment_method') == $offPm->name ? 'selected' : ''); ?>><?php echo e($offPm->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Payment Status</label>
                            <select name="payment_status" class="form-control ml-1">
                                <option value="" selected>All</option>
                                <option value="Pending" <?php echo e(request()->input('payment_status') == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="Completed" <?php echo e(request()->input('payment_status') == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm ml-1">Submit</button>
                        </div>
                    </form>
              </div>
              <div class="col-lg-2">
                <form action="<?php echo e(route('admin.course_enrolments.export')); ?>" class="form-inline justify-content-end">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm ml-1" title="CSV Format">Export</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($enrolments) > 0): ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Order</th>
                        <th scope="col">Course</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Total</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">Country</th>
                        <th scope="col">Gateway</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $enrolments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enrolment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>#<?php echo e($enrolment->order_id); ?></td>

                          <?php
                              $courseInfo = $enrolment->course->information()->where('language_id', $deLang->id)->select('title', 'slug')->first();
                              $title = $courseInfo->title;
                              $slug = $courseInfo->slug;
                          ?>
                          <td><a href="<?php echo e(route('course_details', ['slug' => $slug])); ?>" target="_blank"><?php echo e(strlen($title) > 35 ? mb_substr($title, 0, 35, 'utf-8') . '...' : $title); ?></a></td>

                          <td><?php echo e($abs->base_currency_symbol_position == 'left' ? $abs->base_currency_symbol : ''); ?><?php echo e(round($enrolment->course_price,2)); ?><?php echo e($abs->base_currency_symbol_position == 'right' ? $abs->base_currency_symbol : ''); ?></td>

                          <td><?php echo e($abs->base_currency_symbol_position == 'left' ? $abs->base_currency_symbol : ''); ?><?php echo e(round($enrolment->discount,2)); ?><?php echo e($abs->base_currency_symbol_position == 'right' ? $abs->base_currency_symbol : ''); ?></td>

                          <td><?php echo e($abs->base_currency_symbol_position == 'left' ? $abs->base_currency_symbol : ''); ?><?php echo e(round($enrolment->grand_total,2)); ?><?php echo e($abs->base_currency_symbol_position == 'right' ? $abs->base_currency_symbol : ''); ?></td>

                          <td><?php echo e($enrolment->billing_first_name); ?></td>
                          <td><?php echo e($enrolment->billing_email); ?></td>
                          <td><?php echo e($enrolment->billing_contact_number); ?></td>
                          <td><?php echo e($enrolment->billing_city); ?></td>
                          <td><?php echo e($enrolment->billing_state); ?></td>
                          <td><?php echo e($enrolment->billing_country); ?></td>
                          <td><?php echo e(ucfirst($enrolment->payment_method)); ?></td>
                          <td>
                              <?php if($enrolment->payment_status == 'Pending'): ?>
                                <span class="badge badge-warning">Pending</span>
                              <?php elseif($enrolment->payment_status == 'Completed'): ?>
                                <span class="badge badge-success">Completed</span>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php echo e($enrolment->created_at); ?>

                          </td>
                        </tr>


                        
                        <div class="modal fade" id="receiptModal<?php echo e($enrolment->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Receipt Image</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo e(asset('assets/front/receipt/' . $enrolment->receipt)); ?>" alt="Receipt" width="100%">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
                
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php if(!empty($enrolments)): ?>
            <div class="card-footer">
            <div class="row">
                <div class="d-inline-block mx-auto">
                <?php echo e($enrolments->links()); ?>

                </div>
            </div>
            </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/enrolment/report.blade.php ENDPATH**/ ?>