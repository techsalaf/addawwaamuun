


<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Fun Facts Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Fun Facts Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <div class="card-title"><?php echo e(__('Update Fun Facts Section')); ?></div>
            </div>

            <div class="col-lg-2">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="factForm" action="<?php echo e(route('admin.home_page.update_fun_facts_section', ['language' => request()->input('language')])); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if($themeInfo->theme_version == 1 || $themeInfo->theme_version == 2): ?>
                  <div class="form-group">
                    <label for=""><?php echo e(__('Background Image') . '*'); ?></label>
                    <br>
                    <div class="thumb-preview">
                      <?php if(!empty($data->background_image)): ?>
                        <img src="<?php echo e(asset('assets/img/fact-section/' . $data->background_image)); ?>" alt="background image" class="uploaded-background-img">
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
                <?php endif; ?>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Title')); ?></label>
                      <input type="text" class="form-control" name="title" value="<?php echo e(empty($data->title) ? '' : $data->title); ?>" placeholder="Enter Section Title">
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
              <button type="submit" form="factForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('Counter Informations')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.home_page.bulk_delete_counter_info')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <?php if(count($countInfos) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO INFORMATION FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>

                        <?php if($themeInfo->theme_version == 3): ?>
                          <th scope="col"><?php echo e(__('Icon')); ?></th>
                        <?php endif; ?>

                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Amount')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $countInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($countInfo->id); ?>">
                          </td>

                          <?php if($themeInfo->theme_version == 3): ?>
                            <td>
                              <?php if(is_null($countInfo->icon)): ?>
                                -
                              <?php else: ?>
                                <i class="<?php echo e($countInfo->icon); ?>"></i>
                              <?php endif; ?>
                            </td>
                          <?php endif; ?>

                          <td>
                            <?php echo e(strlen($countInfo->title) > 30 ? mb_substr($countInfo->title, 0, 30, 'UTF-8') . '...' : $countInfo->title); ?>

                          </td>
                          <td><?php echo e($countInfo->amount); ?></td>
                          <td><?php echo e($countInfo->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($countInfo->id); ?>" data-icon="<?php echo e($countInfo->icon); ?>" data-color="<?php echo e($countInfo->color); ?>" data-title="<?php echo e($countInfo->title); ?>" data-amount="<?php echo e($countInfo->amount); ?>" data-serial_number="<?php echo e($countInfo->serial_number); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.home_page.delete_counter_info', ['id' => $countInfo->id])); ?>" method="post">
                              
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

  
  <?php echo $__env->make('backend.home-page.fun-fact-section.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.home-page.fun-fact-section.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/fun-fact-section/index.blade.php ENDPATH**/ ?>