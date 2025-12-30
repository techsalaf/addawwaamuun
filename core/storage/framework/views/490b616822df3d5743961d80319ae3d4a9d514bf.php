

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Courses')); ?></h4>
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
        <a href="#"><?php echo e(__('Courses')); ?></a>
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
                <?php echo e(__('Courses') . ' (' . $language->name . ' ' . __('Language') . ')'); ?>

              </div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="<?php echo e(route('admin.course_management.create_course', ['language' => $language->code])); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> <?php echo e(__('Add Course')); ?></a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.course_management.bulk_delete_course')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">

              <?php if(session()->has('course_status_warning')): ?>
                <div class="alert alert-warning">
                  <p class="text-dark mb-0"><?php echo e(session()->get('course_status_warning')); ?></p>
                </div>
              <?php endif; ?>

              <?php if(count($courses) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO COURSE CONTENT FOUND FOR ') . $language->name . '!'); ?></h3>
              <?php else: ?>
                <?php
                  $position = $currencyInfo->base_currency_symbol_position;
                  $symbol = $currencyInfo->base_currency_symbol;
                ?>

                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Category')); ?></th>
                        <th scope="col"><?php echo e(__('Instructor')); ?></th>
                        <th scope="col"><?php echo e(__('Price')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Featured')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($course->id); ?>">
                          </td>
                          <td width="20%">
                            <?php echo e($course->title); ?>

                          </td>
                          <td>
                            <?php echo e($course->category); ?>

                          </td>
                          <td><?php echo e($course->instructorName); ?></td>
                          <td>
                            <?php if($course->pricing_type == 'free'): ?>
                              <?php echo e(__('Free')); ?>

                            <?php else: ?>
                              <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e($course->current_price); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <form id="statusForm-<?php echo e($course->id); ?>" class="d-inline-block" action="<?php echo e(route('admin.course_management.course.update_status', ['id' => $course->id, 'language' => request()->input('language')])); ?>" method="post">
                              
                              <?php echo csrf_field(); ?>
                              <select class="form-control form-control-sm <?php echo e($course->status == 'draft' ? 'bg-warning text-dark' : 'bg-primary'); ?>" name="status" onchange="document.getElementById('statusForm-<?php echo e($course->id); ?>').submit()">
                                <option value="draft" <?php echo e($course->status == 'draft' ? 'selected' : ''); ?>>
                                  <?php echo e(__('Draft')); ?>

                                </option>
                                <option value="published" <?php echo e($course->status == 'published' ? 'selected' : ''); ?>>
                                  <?php echo e(__('Published')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <form id="featuredForm-<?php echo e($course->id); ?>" class="d-inline-block" action="<?php echo e(route('admin.course_management.course.update_featured', ['id' => $course->id])); ?>" method="post">
                              
                              <?php echo csrf_field(); ?>
                              <select class="form-control form-control-sm <?php echo e($course->is_featured == 'yes' ? 'bg-success' : 'bg-danger'); ?>" name="is_featured" onchange="document.getElementById('featuredForm-<?php echo e($course->id); ?>').submit()">
                                <option value="yes" <?php echo e($course->is_featured == 'yes' ? 'selected' : ''); ?>>
                                  <?php echo e(__('Yes')); ?>

                                </option>
                                <option value="no" <?php echo e($course->is_featured == 'no' ? 'selected' : ''); ?>>
                                  <?php echo e(__('No')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('admin.course_management.edit_course', ['id' => $course->id, 'language' => $language->code])); ?>" class="dropdown-item">
                                  <?php echo e(__('Information')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.course_management.course.modules', ['id' => $course->id, 'language' => $language->code])); ?>" class="dropdown-item">
                                  <?php echo e(__('Curriculum')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.course_management.course.faqs', ['id' => $course->id, 'language' => $defaultLang->code])); ?>" class="dropdown-item">
                                  <?php echo e(__('FAQs')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.course_management.course.thanks_page', ['id' => $course->id])); ?>" class="dropdown-item">
                                  <?php echo e(__('Thanks Page')); ?>

                                </a>
                                
                                <a href="<?php echo e(route('admin.course_management.course.certificate_settings', ['id' => $course->id])); ?>" class="dropdown-item">
                                  <?php echo e(__('Certificate Settings')); ?>

                                </a>
                                
                                <a target="_blank" href="<?php echo e(url('/user/course-curriculum/' . $course->id . '?lesson_id=' . $course->lesson_id)); ?>" class="dropdown-item">
                                  <?php echo e(__('Preview')); ?>

                                </a>

                                <form class="deleteForm d-block" action="<?php echo e(route('admin.course_management.delete_course', ['id' => $course->id])); ?>" method="post">
                                  
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="btn btn-sm deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>
                              </div>
                            </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/curriculum/course/index.blade.php ENDPATH**/ ?>