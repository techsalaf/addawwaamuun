

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Section Customization')); ?></h4>
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
        <a href="#"><?php echo e(__('Section Customization')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.home_page.update_section_status')); ?>" method="POST">
          
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title d-inline-block"><?php echo e(__('Update Sections')); ?></div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <?php if($themeInfo->theme_version != 2): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Course Categories Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="course_categories_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->course_categories_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="course_categories_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->course_categories_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['course_categories_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version != 3): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Call To Action Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="call_to_action_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->call_to_action_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="call_to_action_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->call_to_action_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['call_to_action_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label><?php echo e(__('Featured Courses Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="featured_courses_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->featured_courses_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="featured_courses_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->featured_courses_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                  <?php $__errorArgs = ['featured_courses_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Features Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="features_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->features_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="features_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->features_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                  <?php $__errorArgs = ['features_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if($themeInfo->theme_version != 3): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Video Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="video_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->video_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="video_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->video_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['video_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label><?php echo e(__('Fun Facts Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="fun_facts_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->fun_facts_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="fun_facts_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->fun_facts_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                  <?php $__errorArgs = ['fun_facts_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if($themeInfo->theme_version != 3): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Testimonials Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="testimonials_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->testimonials_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="testimonials_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->testimonials_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['testimonials_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version != 2): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Newsletter Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="newsletter_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->newsletter_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="newsletter_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->newsletter_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['newsletter_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version == 2): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Featured Instructors Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="featured_instructors_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->featured_instructors_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="featured_instructors_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->featured_instructors_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['featured_instructors_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <?php if($themeInfo->theme_version == 3): ?>
                  <div class="form-group">
                    <label><?php echo e(__('About Us Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="about_us_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->about_us_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="about_us_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->about_us_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['about_us_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('Latest Blog Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="latest_blog_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->latest_blog_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="latest_blog_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->latest_blog_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                    <?php $__errorArgs = ['latest_blog_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label><?php echo e(__('Footer Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="footer_section_status" value="1" class="selectgroup-input" <?php echo e($sectionInfo->footer_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="footer_section_status" value="0" class="selectgroup-input" <?php echo e($sectionInfo->footer_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                  <?php $__errorArgs = ['footer_section_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/home-page/section-customization.blade.php ENDPATH**/ ?>