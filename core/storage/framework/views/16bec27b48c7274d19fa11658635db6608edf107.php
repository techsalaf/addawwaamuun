

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Social Links')); ?></h4>
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
        <a href="#"><?php echo e($instructor->name); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Social Links')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form id="ajaxForm" action="<?php echo e(route('admin.instructor.store_social_link', ['id' => $instructor->id])); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title d-inline-block">
              <?php echo e(__('Add Social Link')); ?>

            </div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.instructors', ['language' => $defaultLang->code])); ?>">
              <span class="btn-label">
                <i class="fas fa-backward" ></i>
              </span>
              <?php echo e(__('Back')); ?>

            </a>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <div class="form-group">
                  <label for=""><?php echo e(__('Social Icon') . '*'); ?></label>
                  <div class="btn-group d-block">
                    <button type="button" class="btn btn-primary iconpicker-component">
                      <i class="fa fa-fw fa-heart"></i>
                    </button>
                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fa-car" data-toggle="dropdown"></button>
                    <div class="dropdown-menu"></div>
                  </div>
                  <input type="hidden" id="inputIcon" name="icon">
                  <p class="mt-2 mb-0 text-danger" id="err_icon"></p>
                  <div class="text-warning mt-2">
                    <small><?php echo e(__('Click on the dropdown icon to select a social link icon.')); ?></small>
                  </div>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('URL') . '*'); ?></label>
                  <input type="url" class="form-control" name="url" placeholder="Enter URL of Social Media Account">
                  <p class="mt-2 mb-0 text-danger" id="err_url"></p>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Serial Number') . '*'); ?></label>
                  <input type="number" class="form-control" name="serial_number" placeholder="Enter Serial Number">
                  <p class="mt-2 mb-0 text-danger" id="err_serial_number"></p>
                  <p class="text-warning mt-2">
                    <small><?php echo e(__('The higher the serial number is, the later the social link will be shown.')); ?></small>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer pt-3">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success" id="submitBtn">
                  <?php echo e(__('Submit')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Social Links')); ?></div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($socialLinks) == 0): ?>
                <h2 class="text-center"><?php echo e(__('NO SOCIAL LINK FOUND') . '!'); ?></h2>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Icon')); ?></th>
                        <th scope="col"><?php echo e(__('URL')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td><i class="<?php echo e($socialLink->icon); ?>"></i></td>
                          <td><?php echo e($socialLink->url); ?></td>
                          <td><?php echo e($socialLink->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1" href="<?php echo e(route('admin.instructor.edit_social_link', ['instructor_id' => $socialLink->instructor_id, 'id' => $socialLink->id])); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <form class="d-inline-block deleteForm" action="<?php echo e(route('admin.instructor.delete_social_link', ['id' => $socialLink->id])); ?>" method="post">
                              
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
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/instructor/social-links/index.blade.php ENDPATH**/ ?>