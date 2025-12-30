

<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->courses_page_title ?? 'Courses'); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_courses); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_courses); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->courses_page_title ?? 'Courses'])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->courses_page_title ?? 'Courses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!--====== COURSES PART START ======-->
  <section class="course-grid-area pt-90 pb-120 courses-page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="course-grid mt-30">
            <div class="course-grid-top d-sm-flex d-block justify-content-between align-items-center">
              <div class="course-filter d-block align-items-center d-sm-flex">
                <select id="sort-type">
                  <option selected disabled><?php echo e(__('Sort By')); ?></option>
                  <option <?php echo e(request()->input('sort') == 'new' ? 'selected' : ''); ?> value="new">
                    <?php echo e(__('New Course')); ?>

                  </option>
                  <option <?php echo e(request()->input('sort') == 'old' ? 'selected' : ''); ?> value="old">
                    <?php echo e(__('Old Course')); ?>

                  </option>
                  <option <?php echo e(request()->input('sort') == 'ascending' ? 'selected' : ''); ?> value="ascending">
                    <?php echo e(__('Price') . ': ' . __('Ascending')); ?>

                  </option>
                  <option <?php echo e(request()->input('sort') == 'descending' ? 'selected' : ''); ?> value="descending">
                    <?php echo e(__('Price') . ': ' . __('Descending')); ?>

                  </option>
                </select>

                <div class="input-box">
                  <i class="fal fa-search" id="course-search-icon"></i>
                  <input type="text" id="search-input" placeholder="<?php echo e(__('Search Course')); ?>" value="<?php echo e(!empty(request()->input('keyword')) ? request()->input('keyword') : ''); ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-10">
            <?php if(count($courses) == 0): ?>
              <div class="col-lg-12">
                <h3 class="text-center mt-30"><?php echo e(__('No Course Found') . '!'); ?></h3>
              </div>
            <?php else: ?>
              <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-8">
                  <div class="single-courses mt-30">
                    <div class="courses-thumb">
                      <a class="d-block" href="<?php echo e(route('course_details', ['slug' => $course->slug])); ?>"><img data-src="<?php echo e(asset('assets/img/courses/thumbnails/' . $course->thumbnail_image)); ?>" class="lazy" alt="image"></a>

                      <div class="corses-thumb-title">
                        <a class="category" href="<?php echo e(route('courses', ['category' => $course->categorySlug])); ?>"><?php echo e($course->categoryName); ?></a>
                      </div>
                    </div>

                    <div class="courses-content">
                      <a href="<?php echo e(route('course_details', ['slug' => $course->slug])); ?>">
                        <h4 class="title"><?php echo e(strlen($course->title) > 45 ? mb_substr($course->title, 0, 45, 'UTF-8') . '...' : $course->title); ?></h4>
                      </a>
                      <div class="courses-info d-flex justify-content-between">
                        <div class="item">
                          <p><?php echo e(strlen($course->instructorName) > 10 ? mb_substr($course->instructorName, 0, 10, 'utf-8') . '...' : $course->instructorName); ?></p>
                        </div>
                        
                        <div class="price">
                          <?php if($course->pricing_type == 'premium'): ?>
                            <span><?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?><?php echo e($course->current_price); ?><?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?></span>

                            <?php if(!is_null($course->previous_price)): ?>
                              <span class="pre-price"><?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?><?php echo e($course->previous_price); ?><?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?></span>
                            <?php endif; ?>
                          <?php else: ?>
                            <span><?php echo e(__('Free')); ?></span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <ul class="d-flex justify-content-center">
                        <li><i class="fal fa-users"></i> <?php echo e($course->enrolmentCount . ' ' . __('Students')); ?></li>

                        <?php
                          $period = $course->duration;
                          $array = explode(':', $period);
                          $hour = $array[0];
                          $courseDuration = \Carbon\Carbon::parse($period);
                        ?>

                        <li><i class="fal fa-clock"></i> <?php echo e($hour == '00' ? '00' : $courseDuration->format('h')); ?>h <?php echo e($courseDuration->format('i')); ?>m</li>
                      </ul>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <div class="col-lg-12">
              <?php if(count($courses) > 0): ?>
                <?php echo e($courses->appends([
                  'type' => request()->input('type'),
                  'category' => request()->input('category'),
                  'min' => request()->input('min'),
                  'max' => request()->input('max'),
                  'keyword' => request()->input('keyword'),
                  'sort' => request()->input('sort')
                ])->links()); ?>

              <?php endif; ?>

            </div>

            <?php if(!empty(showAd(3))): ?>
              <div class="col-12 text-center mt-5">
                <?php echo showAd(3); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-8">
          <div class="course-sidebar">
            <div class="course-price-filter white-bg mt-30">
              <div class="course-title">
                <h4 class="title"><?php echo e(__('Course Type')); ?></h4>
              </div>
              <div class="input-radio-btn">
                <ul class="radio_common-2 radio_style2">
                  <li>
                    <input type="radio" <?php echo e(empty(request()->input('type')) ? 'checked' : ''); ?> name="type" id="radio1" value="">
                    <label for="radio1"><span></span><?php echo e(__('All Courses')); ?></label>
                  </li>
                  <li>
                    <input type="radio" <?php echo e(request()->input('type') == 'free' ? 'checked' : ''); ?> name="type" id="radio2" value="free">
                    <label for="radio2"><span></span><?php echo e(__('Free Courses')); ?></label>
                  </li>
                  <li>
                    <input type="radio" <?php echo e(request()->input('type') == 'premium' ? 'checked' : ''); ?> name="type" id="radio3" value="premium">
                    <label for="radio3"><span></span><?php echo e(__('Premium Courses')); ?></label>
                  </li>
                </ul>
              </div>
            </div>

            <?php if(count($categories) > 0): ?>
              <div class="course-price-filter white-bg mt-30">
                <div class="course-title">
                  <h4 class="title"><?php echo e(__('Categories')); ?></h4>
                </div>
                <div class="input-radio-btn">
                  <ul class="radio_common-2 radio_style2">
                    <li>
                      <input type="radio" <?php echo e(empty(request()->input('category')) ? 'checked' : ''); ?> name="category" id="all-category" value="">
                      <label for="all-category"><span></span><?php echo e(__('All Category')); ?></label>
                    </li>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li>
                        <input type="radio" <?php echo e(request()->input('category') == $category->slug ? 'checked' : ''); ?> name="category" id="<?php echo e('radio' . $category->id); ?>" value="<?php echo e($category->slug); ?>">
                        <label for="<?php echo e('radio' . $category->id); ?>"><span></span><?php echo e($category->name); ?></label>
                      </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>
            <?php endif; ?>

            <div class="course-price-filter white-bg mt-30">
              <div class="course-title">
                <h4 class="title"><?php echo e(__('Filter By Price')); ?></h4>
              </div>
              <div class="price-number">
                <ul>
                  <li><span class="amount"><?php echo e(__('Price') . ' :'); ?></span></li>
                  <li><input type="text" id="amount" readonly></li>
                </ul>
              </div>
              <div id="range-slider"></div>
            </div>

            <div class="course-add mt-30">
              <?php echo showAd(2); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== COURSES PART END ======-->

  <form id="filtersForm" class="d-none" action="<?php echo e(route('courses')); ?>" method="GET">
    <input type="hidden" id="type-id" name="type" value="<?php echo e(!empty(request()->input('type')) ? request()->input('type') : ''); ?>">

    <input type="hidden" id="category-id" name="category" value="<?php echo e(!empty(request()->input('category')) ? request()->input('category') : ''); ?>">

    <input type="hidden" id="min-id" name="min" value="<?php echo e(!empty(request()->input('min')) ? request()->input('min') : ''); ?>">

    <input type="hidden" id="max-id" name="max" value="<?php echo e(!empty(request()->input('max')) ? request()->input('max') : ''); ?>">

    <input type="hidden" id="keyword-id" name="keyword" value="<?php echo e(!empty(request()->input('keyword')) ? request()->input('keyword') : ''); ?>">

    <input type="hidden" id="sort-id" name="sort" value="<?php echo e(!empty(request()->input('sort')) ? request()->input('sort') : ''); ?>">

    <button type="submit" id="submitBtn"></button>
  </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    "use strict";
    let currency_info = <?php echo json_encode($currencyInfo); ?>;
    let position = currency_info.base_currency_symbol_position;
    let symbol = currency_info.base_currency_symbol;
    let min_price = <?php echo htmlspecialchars($minPrice); ?>;
    let max_price = <?php echo htmlspecialchars($maxPrice); ?>;
    let curr_min = <?php echo !empty(request()->input('min')) ? htmlspecialchars(request()->input('min')) : htmlspecialchars($minPrice); ?>;
    let curr_max = <?php echo !empty(request()->input('max')) ? htmlspecialchars(request()->input('max')) : htmlspecialchars($maxPrice); ?>;
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/course.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/curriculum/courses.blade.php ENDPATH**/ ?>