

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_home); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_home); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <?php
      $newletterBg = !empty($newsletterData->background_image) ? asset('assets/img/newsletter-section/' . $newsletterData->background_image) : asset('assets/img/static/newsletter.jpeg')
  ?>
  <?php if($secInfo->newsletter_section_status == 1): ?>
    <style>
      .community-area::before {
        background-image: url(<?php echo e($newletterBg); ?>);
      }
    </style>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!--====== BANNER PART START ======-->
  <section class="banner-area bg_cover lazy" data-bg="<?php echo e(!empty($heroInfo->background_image) ? asset('assets/img/hero-section/' . $heroInfo->background_image) : asset('assets/img/static/hero.jpeg')); ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="banner-content">
            <span><?php echo e(!empty($heroInfo->first_title) ? $heroInfo->first_title : ''); ?></span>
            <h1 class="title"><?php echo e(!empty($heroInfo->second_title) ? $heroInfo->second_title : ''); ?></h1>
            <ul>
              <?php if(!empty($heroInfo->first_button) && !empty($heroInfo->first_button_url)): ?>
                <li><a class="main-btn" href="<?php echo e($heroInfo->first_button_url); ?>"><?php echo e($heroInfo->first_button); ?></a></li>
              <?php endif; ?>

              <?php if(!empty($heroInfo->second_button) && !empty($heroInfo->second_button_url)): ?>
                <li><a class="main-btn-2 main-btn" href="<?php echo e($heroInfo->second_button_url); ?>"><?php echo e($heroInfo->second_button); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="banner-shape-1">
      <img data-src="<?php echo e(asset('assets/img/shapes/item-1.png')); ?>" class="lazy" alt="shape">
    </div>

    <div class="banner-shape-2">
      <img data-src="<?php echo e(asset('assets/img/shapes/item-2.png')); ?>" class="lazy" alt="shape">
    </div>
  </section>
  <!--====== BANNER PART END ======-->

  <!--====== DREAM COURSE PART START ======-->
  <div class="dream-course-area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="dream-course-content">
            <div class="dream-course-title text-center">
              <span><?php echo e(__('Find Your Dream Course')); ?></span>
            </div>

            <form action="<?php echo e(route('courses')); ?>" method="GET">
              <div class="dream-course-search d-flex">
                <div class="input-box">
                  <i class="fal fa-search"></i>
                  <input type="text" name="keyword" placeholder="<?php echo e(__('Search Course Here')); ?>">
                </div>

                
                <div class="dream-course-category d-none d-lg-inline-block">
                  <select name="category">
                    <option selected disabled><?php echo e(__('Select a Category')); ?></option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="dream-course-btn">
                  <button type="submit"><?php echo e(__('Find Course')); ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--====== DREAM COURSE PART END ======-->

  <!--====== COURSE CATEGORIES PART START ======-->
  <?php if($secInfo->course_categories_section_status == 1): ?>
    <section class="services-area pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-11">
            <div class="section-title text-center">
              <h3 class="title"><?php echo e(!empty($secTitleInfo->category_section_title) ? $secTitleInfo->category_section_title : ''); ?></h3>
            </div>
          </div>
        </div>

        <?php if(count($categories) == 0): ?>
          <div class="row text-center">
            <div class="col">
              <h3><?php echo e(__('No Course Category Found') . '!'); ?></h3>
            </div>
          </div>
        <?php else: ?>
          <div class="services-border">
            <div class="row no-gutters">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <a class="single-services text-center d-block" href="<?php echo e(route('courses', ['category' => $category->slug])); ?>">
                    <i class="<?php echo e($category->icon); ?>" style="color: <?php echo e('#' . $category->color); ?>;"></i>
                    <h5 class="title"><?php echo e($category->name); ?></h5>
                  </a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(!empty(showAd(3))): ?>
              <div class="text-center mt-5">
                <?php echo showAd(3); ?>

              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <!--====== COURSE CATEGORIES PART END ======-->

  <!--====== CALL TO ACTION PART START ======-->
  <?php if($secInfo->call_to_action_section_status == 1): ?>
    <section class="offer-area bg_cover pt-110 pb-120 lazy" <?php if(!empty($callToActionInfo)): ?> data-bg="<?php echo e(asset('assets/img/action-section/' . $callToActionInfo->background_image)); ?>" <?php endif; ?>>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-11">
            <div class="offer-content text-center">
              <span><?php echo e(!empty($callToActionInfo) ? $callToActionInfo->first_title : ''); ?></span>
              <h1 class="title"><?php echo e(!empty($callToActionInfo) ? $callToActionInfo->second_title : ''); ?></h1>
              <ul>
                <?php if(!empty($callToActionInfo->first_button) && !empty($callToActionInfo->first_button_url)): ?>
                  <li><a class="main-btn" href="<?php echo e($callToActionInfo->first_button_url); ?>"><?php echo e($callToActionInfo->first_button); ?></a></li>
                <?php endif; ?>

                <?php if(!empty($callToActionInfo->second_button) && !empty($callToActionInfo->second_button_url)): ?>
                  <li><a class="main-btn-2 main-btn" href="<?php echo e($callToActionInfo->second_button_url); ?>"><?php echo e($callToActionInfo->second_button); ?></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!--====== CALL TO ACTION PART END ======-->

  <!--====== COURSES PART START ======-->
  <?php if($secInfo->featured_courses_section_status == 1): ?>
    <section class="advance-courses-area pb-120">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="section-title">
              <h3 class="title"><?php echo e(!empty($secTitleInfo->featured_courses_section_title) ? $secTitleInfo->featured_courses_section_title : ''); ?></h3>
            </div>
          </div>
        </div>

        <?php if(count($courses) == 0): ?>
          <div class="row text-center">
            <div class="col">
              <h3><?php echo e(__('No Featured Course Found') . '!'); ?></h3>
            </div>
          </div>
        <?php else: ?>
          <div class="courses-active">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="single-courses mt-30">
                <div class="courses-thumb">
                  <a href="<?php echo e(route('course_details', ['slug' => $course->slug])); ?>" class="d-block">
                    <img data-src="<?php echo e(asset('assets/img/courses/thumbnails/' . $course->thumbnail_image)); ?>" class="lazy" alt="image">
                  </a>

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
                      <img data-src="<?php echo e(asset('assets/img/instructors/' . $course->instructorImage)); ?>" class="lazy" alt="instructor">
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
                    <li><i class="fal fa-users"></i> <?php echo e($course->enrolmentCount); ?> <?php echo e(__('Students')); ?></li>

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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php if(!empty(showAd(3))): ?>
            <div class="text-center mt-5">
              <?php echo showAd(3); ?>

            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <!--====== COURSES PART END ======-->

  <!--====== FEATURES PART START ======-->
  <?php if($secInfo->features_section_status == 1): ?>
    <?php if(count($features) == 0): ?>
      <section class="features-area gray-bg py-5">
        <div class="container">
          <div class="row text-center">
            <div class="col">
              <h3><?php echo e(__('No Feature Found') . '!'); ?></h3>
            </div>
          </div>
        </div>
      </section>
    <?php else: ?>
      <section class="features-area gray-bg bg_cover lazy" <?php if(!empty($featureData)): ?> data-bg="<?php echo e(asset('assets/img/' . $featureData->features_section_image)); ?>" <?php endif; ?>>
        <div class="container-fluid">
          <div class="features-margin pl-70 pr-70">
            <div class="row">
              <div class="col-lg-9">
                <div class="row">
                  <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6 col-md-6">
                      <div class="single-features mt-30" style="background: <?php echo e('#' . $feature->background_color); ?>;">
                        <h4 class="title"><?php echo e($feature->title); ?></h4>
                        <p><?php echo e($feature->text); ?></p>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>
  <?php endif; ?>
  <!--====== FEATURES PART END ======-->

  <!--====== VIDEO PART START ======-->
  <?php if($secInfo->video_section_status == 1): ?>
    <section class="play-area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-11">
            <div class="section-title text-center">
              <h3 class="title"><?php echo e(!empty($videoData) ? $videoData->title : ''); ?></h3>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="play-thumb">
              <?php if(!empty($videoData)): ?>
                <img data-src="<?php echo e(asset('assets/img/video-images/' . $videoData->image)); ?>" class="lazy" alt="image">
                <div class="play-btn">
                  <a href="<?php echo e($videoData->link); ?>" class="video-popup"><i class="fas fa-play"></i></a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!--====== VIDEO PART END ======-->

  <!--====== COUNTER PART START ======-->
  <?php if($secInfo->fun_facts_section_status == 1): ?>
    <section class="counter-area bg_cove lazy" <?php if(!empty($factData->background_image)): ?> data-bg="<?php echo e(asset('assets/img/fact-section/' . $factData->background_image)); ?>" <?php endif; ?>>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="section-title text-center">
              <h3 class="title"><?php echo e(!empty($factData) ? $factData->title : ''); ?></h3>
            </div>
          </div>
        </div>

        <?php if(count($countInfos) == 0): ?>
          <div class="row text-center">
            <div class="col">
              <h3 class="text-light"><?php echo e(__('No Information Found') . '!'); ?></h3>
            </div>
          </div>
        <?php else: ?>
          <div class="row">
            <?php $__currentLoopData = $countInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter-item text-center pt-40">
                  <h3 class="title"><span class="counter"><?php echo e($countInfo->amount); ?></span>+</h3>
                  <span><?php echo e($countInfo->title); ?></span>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="counter-dot">
        <img data-src="<?php echo e(asset('assets/img/counter-dot.png')); ?>" class="lazy" alt="dot">
      </div>
    </section>
  <?php endif; ?>
  <!--====== COUNTER PART END ======-->

  <!--====== TESTIMONIALS PART START ======-->
  <?php if($secInfo->testimonials_section_status == 1): ?>
    <section class="testimonials-area pb-115 bg_cover lazy" <?php if(!empty($testimonialData)): ?> data-bg="<?php echo e(asset('assets/img/' . $testimonialData->testimonials_section_image)); ?>" <?php endif; ?>>
      <div class="container">
        <?php if(count($testimonials) == 0): ?>
          <div class="row text-center">
            <div class="col">
              <h3><?php echo e(__('No Testimonial Found') . '!'); ?></h3>
            </div>
          </div>
        <?php else: ?>
          <div class="row testimonials-active">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-12">
                <div class="testimonials-content text-center">
                  <i class="fas fa-quote-left"></i>
                  <p><?php echo e($testimonial->comment); ?></p>
                  <img data-src="<?php echo e(asset('assets/img/clients/' . $testimonial->image)); ?>" class="lazy" alt="client">
                  <h5><?php echo e($testimonial->name); ?></h5>
                  <span><?php echo e($testimonial->occupation); ?></span>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <!--====== TESTIMONIALS PART END ======-->

  <!--======NEWSLETTER PART START ======-->
  <?php if($secInfo->newsletter_section_status == 1): ?>
    <section class="community-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="community-content">
              <h3 class="title"><?php echo e(!empty($newsletterData->title) ? $newsletterData->title : ''); ?></h3>
              <p class="mt-3"><?php echo e(!empty($newsletterData->text) ? $newsletterData->text : ''); ?></p>

              <form class="subscriptionForm" action="<?php echo e(route('store_subscriber')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="input-box">
                  <input type="email" placeholder="<?php echo e(__('Enter Your Email Address')); ?>" name="email_id">
                  <button type="submit"><?php echo e(__('Subscribe')); ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php if(!empty($newsletterData->image)): ?>
        <div class="community-thumb d-none d-lg-block">
          <img data-src="<?php echo e(asset('assets/img/newsletter-section/' . $newsletterData->image)); ?>" class="lazy" alt="image">
        </div>
      <?php endif; ?>
    </section>
  <?php endif; ?>
  <!--======NEWSLETTER PART END ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/home/index-v1.blade.php ENDPATH**/ ?>