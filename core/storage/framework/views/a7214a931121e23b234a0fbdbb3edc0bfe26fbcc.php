


<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Features Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Features Section')); ?></a>
      </li>
    </ul>
  </div>

  <?php if($themeInfo->theme_version == 1): ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <div class="card-title"><?php echo e(__('Features Section Image')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <form id="featureForm" action="<?php echo e(route('admin.home_page.update_feature_section_image')); ?>" method="POST" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="form-group">
                    <label for=""><?php echo e(__('Image') . '*'); ?></label>
                    <br>
                    <div class="thumb-preview">
                      <?php if(!empty($data->features_section_image)): ?>
                        <img src="<?php echo e(asset('assets/img/' . $data->features_section_image)); ?>" alt="image" class="uploaded-img">
                      <?php else: ?>
                        <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                      <?php endif; ?>
                    </div>

                    <div class="mt-3">
                      <div role="button" class="btn btn-primary btn-sm upload-btn">
                        <?php echo e(__('Choose Image')); ?>

                        <input type="file" class="img-input" name="features_section_image">
                      </div>
                    </div>
                    <?php $__errorArgs = ['features_section_image'];
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
                </form>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" form="featureForm" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('Features')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i> <?php echo e(__('Add Feature')); ?></a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.home_page.bulk_delete_feature')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <?php if(count($features) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO FEATURE FOUND') . '!'); ?></h3>
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
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($feature->id); ?>">
                          </td>

                          <?php if($themeInfo->theme_version == 3): ?>
                            <td>
                              <?php if(is_null($feature->icon)): ?>
                                -
                              <?php else: ?>
                                <i class="<?php echo e($feature->icon); ?>"></i>
                              <?php endif; ?>
                            </td>
                          <?php endif; ?>

                          <td>
                            <?php echo e(strlen($feature->title) > 30 ? mb_substr($feature->title, 0, 30, 'UTF-8') . '...' : $feature->title); ?>

                          </td>
                          <td><?php echo e($feature->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($feature->id); ?>" data-background_color="<?php echo e($feature->background_color); ?>" data-icon="<?php echo e($feature->icon); ?>" data-title="<?php echo e($feature->title); ?>" data-text="<?php echo e($feature->text); ?>" data-serial_number="<?php echo e($feature->serial_number); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.home_page.delete_feature', ['id' => $feature->id])); ?>" method="post">
                              
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

  
  <?php echo $__env->make('backend.home-page.feature-section.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.home-page.feature-section.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/feature-section/index.blade.php ENDPATH**/ ?>