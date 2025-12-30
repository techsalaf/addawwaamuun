


<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Modules')); ?></h4>
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
        <a href="<?php echo e(route('admin.course_management.courses', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Courses')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <?php if(!empty($courseInformation)): ?>
        <li class="nav-item">
          <a href="#"><?php echo e(strlen($courseInformation->title) > 35 ? mb_substr($courseInformation->title, 0, 35, 'UTF-8') . '...' : $courseInformation->title); ?></a>
        </li>
      <?php endif; ?>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Modules')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block">
                <?php echo e(__('Modules') . ' (' . $language->name . ' ' . __('Language') . ')'); ?>

              </div>
            </div>

            <div class="col-lg-3">
              <?php if(!empty($langs)): ?>
                <select name="language" class="form-control" onchange="window.location='<?php echo e(url()->current() . '?language='); ?>' + this.value">
                  <option selected disabled><?php echo e(__('Select a Language')); ?></option>
                  <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lang->code); ?>" <?php echo e($lang->code == $language->code ? 'selected' : ''); ?>>
                      <?php echo e($lang->name); ?>

                    </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              <?php endif; ?>
            
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a class="btn btn-info btn-sm float-right ml-2" href="<?php echo e(route('admin.course_management.courses', ['language' => $defaultLang->code])); ?>">
                <span class="btn-label">
                  <i class="fas fa-backward" ></i>
                </span>
                <?php echo e(__('Back')); ?>

              </a>
              
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i> <?php echo e(__('Add Module')); ?></a>

              <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.course_management.course.bulk_delete_module')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($modules) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO MODULE FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                        <th scope="col"><?php echo e(__('Lesson')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($module->id); ?>">
                          </td>
                          <td width="20%">
                            <?php echo e($module->title); ?>

                          </td>
                          <td>
                            <?php if($module->status == 'draft'): ?>
                              <span class="badge badge-warning"><?php echo e(ucfirst($module->status)); ?></span>
                            <?php else: ?>
                              <span class="badge badge-primary"><?php echo e(ucfirst($module->status)); ?></span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($module->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($module->id); ?>" data-title="<?php echo e($module->title); ?>" data-status="<?php echo e($module->status); ?>" data-serial_number="<?php echo e($module->serial_number); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.course_management.course.delete_module', ['id' => $module->id])); ?>" method="post">
                              
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <?php echo e(__('Delete')); ?>

                              </button>
                            </form>
                          </td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#createLessonModal-<?php echo e($module->id); ?>" class="btn btn-primary btn-sm mr-1">
                              <span class="btn-label">
                                <i class="fas fa-plus"></i>
                              </span>
                              <?php echo e(__('Add')); ?>

                            </a>

                            <a href="#" data-toggle="modal" data-target="#viewLessonModal-<?php echo e($module->id); ?>" class="btn btn-success btn-sm">
                              <span class="btn-label">
                                <i class="fas fa-eye"></i>
                              </span>
                              <?php echo e(__('View')); ?>

                            </a>

                            

                            
                            <?php echo $__env->make('backend.curriculum.lesson.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            
                            <?php echo $__env->make('backend.curriculum.lesson.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

  
  <?php echo $__env->make('backend.curriculum.module.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.curriculum.module.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.curriculum.lesson.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/module/index.blade.php ENDPATH**/ ?>