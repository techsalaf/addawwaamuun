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
      .newsletter-section::before {
        background-image: url(<?php echo e($newletterBg); ?>);
      }
    </style>
  <?php endif; ?>
  <style>
    #preloader {
      background: linear-gradient(135deg, rgba(24, 102, 212, 0.9) 0%, rgba(88, 12, 227, 0.9) 100%);
    }
    #status .spinner {
      animation: spin-v4 1s linear infinite;
    }
    @keyframes  spin-v4 {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- ============ HERO SECTION ============ -->
<?php if(!empty($themeV4HeroSettings->status)): ?>
<section class="hero-section" style="background: linear-gradient(135deg, rgba(<?php echo e(hexToRgb($themeV4HeroSettings->gradient_color_1 ?? '1866d4')); ?>, 0.9) 0%, rgba(<?php echo e(hexToRgb($themeV4HeroSettings->gradient_color_2 ?? '580ce3')); ?>, 0.9) 100%), url('<?php echo e(!empty($themeV4HeroSettings->background_image) ? asset('assets/img/hero-section/' . $themeV4HeroSettings->background_image) : asset('assets/img/static/hero.jpeg')); ?>'); background-size: cover; background-position: center;">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-wrapper">
      <div class="hero-content">
        <div class="hero-badge">
          <span><?php echo e(!empty($themeV4HeroSettings->title) ? $themeV4HeroSettings->title : __('Welcome to Learning Platform')); ?></span>
        </div>
        <h1 class="hero-title" data-animation="fadeInUp">
          <?php echo e(!empty($themeV4HeroSettings->subtitle) ? $themeV4HeroSettings->subtitle : __('Unlock Your Potential')); ?>

        </h1>
        <p class="hero-subtitle" data-animation="fadeInUp">
          <?php echo e(!empty($themeV4HeroSettings->description) ? $themeV4HeroSettings->description : __('Start your journey to success with our comprehensive courses')); ?>

        </p>
        <div class="hero-buttons">
          <?php if(!empty($themeV4HeroSettings->button_1_text) && !empty($themeV4HeroSettings->button_1_url)): ?>
            <a href="<?php echo e($themeV4HeroSettings->button_1_url); ?>" class="btn btn-primary btn-lg" data-animation="fadeInLeft">
              <?php echo e($themeV4HeroSettings->button_1_text); ?>

            </a>
          <?php endif; ?>
          <?php if(!empty($themeV4HeroSettings->button_2_text) && !empty($themeV4HeroSettings->button_2_url)): ?>
            <a href="<?php echo e($themeV4HeroSettings->button_2_url); ?>" class="btn btn-outline-light btn-lg" data-animation="fadeInRight">
              <?php echo e($themeV4HeroSettings->button_2_text); ?>

            </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="hero-image">
        <div class="floating-card">
          <div class="card-inner"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="scroll-indicator">
    <span></span>
    <span></span>
    <span></span>
  </div>
</section>
<?php endif; ?>

<!-- ============ SEARCH SECTION ============ -->
<?php if(!empty($themeV4SearchSettings->status)): ?>
<section class="search-section">
  <div class="container">
    <div class="search-wrapper">
      <div class="search-card">
        <h2 class="search-title"><?php echo e($themeV4SearchSettings->title ?? __('Find Your Dream Course')); ?></h2>
        <?php if(!empty($themeV4SearchSettings->subtitle)): ?>
          <p class="search-subtitle"><?php echo e($themeV4SearchSettings->subtitle); ?></p>
        <?php endif; ?>
        <form action="<?php echo e(route('courses')); ?>" method="GET" class="search-form">
          <div class="search-input-group">
            <div class="search-field">
              <i class="fal fa-search"></i>
              <input type="text" name="keyword" placeholder="<?php echo e($themeV4SearchSettings->search_placeholder ?? __('Search courses by name...')); ?>" class="search-input">
            </div>
            <div class="search-field">
              <i class="fal fa-list"></i>
              <select name="category" class="search-select">
                <option selected disabled><?php echo e($themeV4SearchSettings->category_placeholder ?? __('Select Category')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fal fa-arrow-right"></i>
              <?php echo e($themeV4SearchSettings->button_text ?? __('Search')); ?>

            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ CATEGORIES SECTION ============ -->
<?php if($secInfo->course_categories_section_status == 1): ?>
  <section class="categories-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title"><?php echo e(!empty($secTitleInfo->category_section_title) ? $secTitleInfo->category_section_title : __('Browse Categories')); ?></h2>
        <p class="section-subtitle"><?php echo e(__('Explore our wide range of courses')); ?></p>
      </div>

      <?php if(count($categories) > 0): ?>
        <div class="categories-grid">
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('courses', ['category' => $category->slug])); ?>" class="category-card" data-delay="<?php echo e($index * 100); ?>">
              <div class="category-icon">
                <i class="<?php echo e($category->icon); ?>" style="color: #<?php echo e($category->color); ?>;"></i>
              </div>
              <h3 class="category-name"><?php echo e($category->name); ?></h3>
              <span class="category-arrow"><i class="fal fa-arrow-right"></i></span>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php else: ?>
        <div class="text-center py-5">
          <h3><?php echo e(__('No Course Category Found')); ?></h3>
        </div>
      <?php endif; ?>

      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-5">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<!-- ============ CTA SECTION ============ -->
<?php if(!empty($themeV4CtaSettings->status)): ?>
  <section class="cta-section" style="background: linear-gradient(135deg, rgba(<?php echo e(hexToRgb($themeV4CtaSettings->gradient_color_1 ?? '1866d4')); ?>, 0.85) 0%, rgba(<?php echo e(hexToRgb($themeV4CtaSettings->gradient_color_2 ?? '580ce3')); ?>, 0.85) 100%), url('<?php echo e(!empty($themeV4CtaSettings->background_image) ? asset('assets/img/action-section/' . $themeV4CtaSettings->background_image) : ''); ?>'); background-size: cover; background-position: center;">
    <div class="cta-overlay"></div>
    <div class="container">
      <div class="cta-content text-center">
        <?php if(!empty($themeV4CtaSettings->title)): ?>
          <div class="cta-badge">
            <?php echo e($themeV4CtaSettings->title); ?>

          </div>
        <?php endif; ?>
        <?php if(!empty($themeV4CtaSettings->subtitle)): ?>
          <h2 class="cta-title">
            <?php echo e($themeV4CtaSettings->subtitle); ?>

          </h2>
        <?php endif; ?>
        <?php if(!empty($themeV4CtaSettings->description)): ?>
          <p class="cta-description"><?php echo e($themeV4CtaSettings->description); ?></p>
        <?php endif; ?>
        <div class="cta-buttons">
          <?php if(!empty($themeV4CtaSettings->button_1_text) && !empty($themeV4CtaSettings->button_1_url)): ?>
            <a href="<?php echo e($themeV4CtaSettings->button_1_url); ?>" class="btn btn-light">
              <?php echo e($themeV4CtaSettings->button_1_text); ?>

            </a>
          <?php endif; ?>
          <?php if(!empty($themeV4CtaSettings->button_2_text) && !empty($themeV4CtaSettings->button_2_url)): ?>
            <a href="<?php echo e($themeV4CtaSettings->button_2_url); ?>" class="btn btn-outline-light">
              <?php echo e($themeV4CtaSettings->button_2_text); ?>

            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- ============ FEATURED COURSES SECTION ============ -->
<?php if($secInfo->featured_courses_section_status == 1): ?>
  <section class="featured-courses-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title"><?php echo e(!empty($secTitleInfo->featured_courses_section_title) ? $secTitleInfo->featured_courses_section_title : __('Featured Courses')); ?></h2>
      </div>

      <?php if(count($courses) > 0): ?>
        <div class="courses-grid">
          <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="course-card" data-delay="<?php echo e(($index % 3) * 100); ?>">
              <div class="course-image">
                <img src="<?php echo e(asset('assets/img/courses/thumbnails/' . $course->thumbnail_image)); ?>" alt="<?php echo e($course->title); ?>" class="lazy">
                <div class="course-overlay">
                  <a href="<?php echo e(route('course_details', ['slug' => $course->slug])); ?>" class="btn btn-primary btn-sm">
                    <?php echo e(__('View Course')); ?>

                  </a>
                </div>
                <div class="course-category-badge">
                  <a href="<?php echo e(route('courses', ['category' => $course->categorySlug])); ?>"><?php echo e($course->categoryName); ?></a>
                </div>
              </div>
              <div class="course-body">
                <h3 class="course-title">
                  <a href="<?php echo e(route('course_details', ['slug' => $course->slug])); ?>">
                    <?php echo e(strlen($course->title) > 50 ? mb_substr($course->title, 0, 50, 'UTF-8') . '...' : $course->title); ?>

                  </a>
                </h3>
                <div class="course-instructor">
                  <img src="<?php echo e(asset('assets/img/instructors/' . $course->instructorImage)); ?>" alt="<?php echo e($course->instructorName); ?>" class="instructor-avatar">
                  <span><?php echo e(strlen($course->instructorName) > 15 ? mb_substr($course->instructorName, 0, 15, 'utf-8') . '...' : $course->instructorName); ?></span>
                </div>
                <div class="course-stats">
                  <span class="stat"><i class="fal fa-users"></i> <?php echo e($course->enrolmentCount); ?></span>
                  <?php
                    $array = explode(':', $course->duration);
                    $hour = $array[0];
                    $courseDuration = \Carbon\Carbon::parse($course->duration);
                  ?>
                  <span class="stat"><i class="fal fa-clock"></i> <?php echo e($hour == '00' ? '00' : $courseDuration->format('h')); ?>h <?php echo e($courseDuration->format('i')); ?>m</span>
                </div>
                <div class="course-footer">
                  <div class="course-rating">
                    <div class="stars">
                      <?php for($i = 0; $i < 5; $i++): ?>
                        <i class="fa<?php echo e($i < round($course->average_rating) ? 's' : 'l'); ?> fa-star"></i>
                      <?php endfor; ?>
                    </div>
                    <span class="rating-value"><?php echo e(round($course->average_rating, 1)); ?></span>
                  </div>
                  <div class="course-price">
                    <?php if($course->pricing_type == 'premium'): ?>
                      <span class="price-current"><?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?><?php echo e($course->current_price); ?><?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?></span>
                      <?php if(!is_null($course->previous_price)): ?>
                        <span class="price-original"><?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?><?php echo e($course->previous_price); ?><?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?></span>
                      <?php endif; ?>
                    <?php else: ?>
                      <span class="price-current"><?php echo e(__('Free')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php else: ?>
        <div class="text-center py-5">
          <h3><?php echo e(__('No Featured Course Found')); ?></h3>
        </div>
      <?php endif; ?>

      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-5">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<!-- ============ FEATURES SECTION ============ -->
<?php if($secInfo->features_section_status == 1): ?>
  <?php if(count($features) > 0): ?>
    <section class="features-section" <?php if(!empty($featureData)): ?> style="background-image: url('<?php echo e(asset('assets/img/' . $featureData->features_section_image)); ?>'); background-size: cover; background-position: center;" <?php endif; ?>>
      <div class="features-overlay"></div>
      <div class="container">
        <div class="section-header">
          <h2 class="section-title"><?php echo e(__('Why Choose Us')); ?></h2>
        </div>
        <div class="features-grid">
          <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="feature-card" style="background: linear-gradient(135deg, #<?php echo e($feature->background_color); ?>dd 0%, #<?php echo e($feature->background_color); ?> 100%);" data-delay="<?php echo e($index * 100); ?>">
              <div class="feature-icon">
                <i class="fal fa-check-circle"></i>
              </div>
              <h3 class="feature-title"><?php echo e($feature->title); ?></h3>
              <p class="feature-text"><?php echo e($feature->text); ?></p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<!-- ============ VIDEO SECTION ============ -->
<?php if($secInfo->video_section_status == 1 && !empty($videoData)): ?>
  <section class="video-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title"><?php echo e($videoData->title ?? ''); ?></h2>
      </div>
      <div class="video-container">
        <div class="video-wrapper">
          <img src="<?php echo e(asset('assets/img/video-images/' . $videoData->image)); ?>" alt="Video thumbnail" class="video-thumbnail">
          <a href="<?php echo e($videoData->link); ?>" class="video-play-btn video-popup">
            <i class="fas fa-play"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- ============ STATS SECTION ============ -->
<?php if($secInfo->fun_facts_section_status == 1): ?>
  <?php if(count($countInfos) > 0): ?>
    <section class="stats-section" <?php if(!empty($factData->background_image)): ?> style="background: linear-gradient(135deg, rgba(24, 102, 212, 0.8) 0%, rgba(88, 12, 227, 0.8) 100%), url('<?php echo e(asset('assets/img/fact-section/' . $factData->background_image)); ?>'); background-size: cover; background-position: center;" <?php endif; ?>>
      <div class="stats-overlay"></div>
      <div class="container">
        <div class="section-header">
          <h2 class="section-title text-white"><?php echo e(!empty($factData) ? $factData->title : ''); ?></h2>
        </div>
        <div class="stats-grid">
          <?php $__currentLoopData = $countInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $countInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="stat-card" data-delay="<?php echo e($index * 100); ?>">
              <div class="stat-value counter" data-target="<?php echo e($countInfo->amount); ?>">0</div>
              <span class="stat-label">+</span>
              <p class="stat-text"><?php echo e($countInfo->title); ?></p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<!-- ============ TESTIMONIALS SECTION ============ -->
<?php if($secInfo->testimonials_section_status == 1): ?>
  <?php if(count($testimonials) > 0): ?>
    <section class="testimonials-section" <?php if(!empty($testimonialData)): ?> style="background-image: url('<?php echo e(asset('assets/img/' . $testimonialData->testimonials_section_image)); ?>'); background-size: cover; background-position: center;" <?php endif; ?>>
      <div class="testimonials-overlay"></div>
      <div class="container">
        <div class="section-header">
          <h2 class="section-title"><?php echo e(__('What Our Students Say')); ?></h2>
        </div>
        <div class="testimonials-carousel">
          <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="testimonial-card">
              <div class="testimonial-stars">
                <?php for($i = 0; $i < 5; $i++): ?>
                  <i class="fas fa-star"></i>
                <?php endfor; ?>
              </div>
              <p class="testimonial-text"><?php echo e($testimonial->comment); ?></p>
              <div class="testimonial-author">
                <img src="<?php echo e(asset('assets/img/clients/' . $testimonial->image)); ?>" alt="<?php echo e($testimonial->name); ?>" class="author-avatar">
                <div class="author-info">
                  <h4 class="author-name"><?php echo e($testimonial->name); ?></h4>
                  <span class="author-title"><?php echo e($testimonial->occupation); ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<!-- ============ FEATURED INSTRUCTORS SECTION ============ -->
<?php if($secInfo->featured_instructors_section_status == 1): ?>
  <?php if(!empty($instructors) && count($instructors) > 0): ?>
    <section class="instructors-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title"><?php echo e(__('Meet Our Expert Instructors')); ?></h2>
          <p class="section-subtitle"><?php echo e(__('Learn from industry professionals')); ?></p>
        </div>
        <div class="instructors-grid">
          <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="instructor-card" data-delay="<?php echo e(($index % 3) * 100); ?>">
              <div class="instructor-image">
                <img src="<?php echo e(asset('assets/img/instructors/' . $instructor->image)); ?>" alt="<?php echo e($instructor->name); ?>">
                <div class="instructor-overlay">
                  <a href="<?php echo e(route('instructors')); ?>" class="btn btn-primary btn-sm">
                    <?php echo e(__('View Profile')); ?>

                  </a>
                </div>
              </div>
              <div class="instructor-info">
                <h3 class="instructor-name"><?php echo e($instructor->name); ?></h3>
                <p class="instructor-title"><?php echo e($instructor->occupation ?? __('Instructor')); ?></p>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<!-- ============ ABOUT US SECTION ============ -->
<?php if($secInfo->about_us_section_status == 1): ?>
  <?php if(!empty($aboutUsInfo)): ?>
    <section class="about-section">
      <div class="container">
        <div class="about-wrapper">
          <div class="about-content">
            <h2 class="section-title"><?php echo e($aboutUsInfo->title ?? ''); ?></h2>
            <p class="about-text"><?php echo e($aboutUsInfo->text ?? ''); ?></p>
          </div>
          <?php if(!empty($aboutUsInfo->image)): ?>
            <div class="about-image">
              <img src="<?php echo e(asset('assets/img/about-section/' . $aboutUsInfo->image)); ?>" alt="About Us">
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<!-- ============ BLOG SECTION ============ -->
<?php if($secInfo->latest_blog_section_status == 1): ?>
  <?php if(count($blogs) > 0): ?>
    <section class="blog-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title"><?php echo e(__('Latest Articles & Insights')); ?></h2>
          <p class="section-subtitle"><?php echo e(__('Stay updated with our latest news and resources')); ?></p>
        </div>
        <div class="blog-grid">
          <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="blog-card" data-delay="<?php echo e(($index % 3) * 100); ?>">
              <div class="blog-image">
                <img src="<?php echo e(asset('assets/img/blogs/' . $blog->image)); ?>" alt="<?php echo e($blog->title); ?>">
                <div class="blog-category">
                  <a href="<?php echo e(route('courses', ['category' => $blog->categorySlug])); ?>"><?php echo e($blog->categoryName); ?></a>
                </div>
              </div>
              <div class="blog-content">
                <h3 class="blog-title">
                  <a href="<?php echo e(route('blog_details', ['slug' => $blog->slug])); ?>"><?php echo e($blog->title); ?></a>
                </h3>
                <div class="blog-meta">
                  <span class="blog-author"><i class="fal fa-user"></i> <?php echo e($blog->author); ?></span>
                </div>
                <a href="<?php echo e(route('blog_details', ['slug' => $blog->slug])); ?>" class="blog-read-more">
                  <?php echo e(__('Read More')); ?> <i class="fal fa-arrow-right"></i>
                </a>
              </div>
            </article>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<!-- ============ NEWSLETTER SECTION ============ -->
<?php if($secInfo->newsletter_section_status == 1): ?>
  <section class="newsletter-section">
    <div class="newsletter-overlay"></div>
    <div class="container">
      <div class="newsletter-content">
        <h2 class="newsletter-title"><?php echo e(!empty($newsletterData->title) ? $newsletterData->title : __('Subscribe to Our Newsletter')); ?></h2>
        <p class="newsletter-subtitle"><?php echo e(!empty($newsletterData->text) ? $newsletterData->text : __('Get the latest courses and updates delivered to your inbox')); ?></p>
        <form class="newsletter-form subscriptionForm" action="<?php echo e(route('store_subscriber')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="newsletter-input-group">
            <input type="email" name="email" placeholder="<?php echo e(__('Enter your email address')); ?>" required>
            <button type="submit" class="btn btn-primary"><?php echo e(__('Subscribe')); ?></button>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/home/index-v4.blade.php ENDPATH**/ ?>