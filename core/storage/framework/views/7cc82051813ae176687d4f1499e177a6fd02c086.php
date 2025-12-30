

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Language Management')); ?></h4>
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
        <a href="#"><?php echo e(__('Language Management')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Languages')); ?></div>
          <a href="#" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($languages) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO LANGUAGE FOUND!')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo e(__('#')); ?></th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Code')); ?></th>
                        <th scope="col"><?php echo e(__('Direction')); ?></th>
                        <th scope="col"><?php echo e(__('Website Language')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td><?php echo e($language->name); ?></td>
                          <td><?php echo e($language->code); ?></td>
                          <td><?php echo e($language->direction == 1 ? __('RTL') : __('LTR')); ?></td>
                          <td>
                            <?php if($language->is_default == 1): ?>
                              <strong class="badge badge-success"><?php echo e(__('Default')); ?></strong>
                            <?php else: ?>
                              <form class="d-inline-block" action="<?php echo e(route('admin.language_management.make_default_language', ['id' => $language->id])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-primary btn-sm" type="submit" name="button">
                                  <?php echo e(__('Make Default')); ?>

                                </button>
                              </form>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a href="#" class="btn btn-secondary btn-sm mr-1 editBtn" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($language->id); ?>" data-name="<?php echo e($language->name); ?>" data-code="<?php echo e($language->code); ?>" data-direction="<?php echo e($language->direction); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <a class="btn btn-info btn-sm mr-1" href="<?php echo e(route('admin.language_management.edit_keyword', $language->id)); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit Keyword')); ?>

                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.language_management.delete_language', ['id' => $language->id])); ?>" method="post">
                              
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

  
  <?php echo $__env->make('backend.language.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.language.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/language/index.blade.php ENDPATH**/ ?>