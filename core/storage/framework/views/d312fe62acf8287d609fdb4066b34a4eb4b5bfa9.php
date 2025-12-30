

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Blog')); ?></h4>
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
        <a href="#"><?php echo e(__('Blog Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Blog')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Blog')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="<?php echo e(route('admin.blog_management.create_blog', ['language' => $language->code])); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> <?php echo e(__('Add Blog')); ?></a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.blog_management.bulk_delete_blog')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($blogs) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO BLOG FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Category')); ?></th>
                        <th scope="col"><?php echo e(__('Author')); ?></th>
                        <th scope="col"><?php echo e(__('Publish Date')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($blog->id); ?>">
                          </td>
                          <td width="20%">
                            <?php echo e($blog->title); ?>

                          </td>
                          <td><?php echo e($blog->categoryName); ?></td>
                          <td><?php echo e($blog->author); ?></td>
                          <td>
                            <?php
                              // first, convert the string into date object
                              $date = Carbon\Carbon::parse($blog->created_at);
                            ?>

                            <?php echo e(date_format($date, 'M d, Y')); ?>

                          </td>
                          <td><?php echo e($blog->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1" href="<?php echo e(route('admin.blog_management.edit_blog', ['id' => $blog->id, 'language' => $language->code])); ?>">
                              <i class="fas fa-edit"></i>
                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.blog_management.delete_blog', ['id' => $blog->id])); ?>" method="post">
                              
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                                <i class="fas fa-trash"></i>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/journal/blog/index.blade.php ENDPATH**/ ?>