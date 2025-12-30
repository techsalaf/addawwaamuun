@extends('frontend.layout')

@section('pageHeading')
  {{ __('Home') }}
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_home }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_home }}
  @endif
@endsection

@section('style')
  @php
      $newletterBg = !empty($newsletterData->background_image) ? asset('assets/img/newsletter-section/' . $newsletterData->background_image) : asset('assets/img/static/newsletter.jpeg')
  @endphp
  @if ($secInfo->newsletter_section_status == 1)
    <style>
      .newsletter-section::before {
        background-image: url({{ $newletterBg }});
      }
    </style>
  @endif
  <style>
    #preloader {
      background: linear-gradient(135deg, rgba(24, 102, 212, 0.9) 0%, rgba(88, 12, 227, 0.9) 100%);
    }
    #status .spinner {
      animation: spin-v4 1s linear infinite;
    }
    @keyframes spin-v4 {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
@endsection

@section('content')
<!-- ============ HERO SECTION ============ -->
@if (!empty($themeV4HeroSettings->status))
<section class="hero-section" style="background: linear-gradient(135deg, rgba({{ hexToRgb($themeV4HeroSettings->gradient_color_1 ?? '1866d4') }}, 0.9) 0%, rgba({{ hexToRgb($themeV4HeroSettings->gradient_color_2 ?? '580ce3') }}, 0.9) 100%), url('{{ !empty($themeV4HeroSettings->background_image) ? asset('assets/img/hero-section/' . $themeV4HeroSettings->background_image) : asset('assets/img/static/hero.jpeg') }}'); background-size: cover; background-position: center;">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-wrapper">
      <div class="hero-content">
        <div class="hero-badge">
          <span>{{ !empty($themeV4HeroSettings->title) ? $themeV4HeroSettings->title : __('Welcome to Learning Platform') }}</span>
        </div>
        <h1 class="hero-title" data-animation="fadeInUp">
          {{ !empty($themeV4HeroSettings->subtitle) ? $themeV4HeroSettings->subtitle : __('Unlock Your Potential') }}
        </h1>
        <p class="hero-subtitle" data-animation="fadeInUp">
          {{ !empty($themeV4HeroSettings->description) ? $themeV4HeroSettings->description : __('Start your journey to success with our comprehensive courses') }}
        </p>
        <div class="hero-buttons">
          @if (!empty($themeV4HeroSettings->button_1_text) && !empty($themeV4HeroSettings->button_1_url))
            <a href="{{ $themeV4HeroSettings->button_1_url }}" class="btn btn-primary btn-lg" data-animation="fadeInLeft">
              {{ $themeV4HeroSettings->button_1_text }}
            </a>
          @endif
          @if (!empty($themeV4HeroSettings->button_2_text) && !empty($themeV4HeroSettings->button_2_url))
            <a href="{{ $themeV4HeroSettings->button_2_url }}" class="btn btn-outline-light btn-lg" data-animation="fadeInRight">
              {{ $themeV4HeroSettings->button_2_text }}
            </a>
          @endif
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
@endif

<!-- ============ SEARCH SECTION ============ -->
@if (!empty($themeV4SearchSettings->status))
<section class="search-section">
  <div class="container">
    <div class="search-wrapper">
      <div class="search-card">
        <h2 class="search-title">{{ $themeV4SearchSettings->title ?? __('Find Your Dream Course') }}</h2>
        @if (!empty($themeV4SearchSettings->subtitle))
          <p class="search-subtitle">{{ $themeV4SearchSettings->subtitle }}</p>
        @endif
        <form action="{{ route('courses') }}" method="GET" class="search-form">
          <div class="search-input-group">
            <div class="search-field">
              <i class="fal fa-search"></i>
              <input type="text" name="keyword" placeholder="{{ $themeV4SearchSettings->search_placeholder ?? __('Search courses by name...') }}" class="search-input">
            </div>
            <div class="search-field">
              <i class="fal fa-list"></i>
              <select name="category" class="search-select">
                <option selected disabled>{{ $themeV4SearchSettings->category_placeholder ?? __('Select Category') }}</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->slug }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fal fa-arrow-right"></i>
              {{ $themeV4SearchSettings->button_text ?? __('Search') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endif

<!-- ============ CATEGORIES SECTION ============ -->
@if ($secInfo->course_categories_section_status == 1)
  <section class="categories-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">{{ !empty($secTitleInfo->category_section_title) ? $secTitleInfo->category_section_title : __('Browse Categories') }}</h2>
        <p class="section-subtitle">{{ __('Explore our wide range of courses') }}</p>
      </div>

      @if (count($categories) > 0)
        <div class="categories-grid">
          @foreach ($categories as $index => $category)
            <a href="{{route('courses', ['category' => $category->slug])}}" class="category-card" data-delay="{{ $index * 100 }}">
              <div class="category-icon">
                <i class="{{ $category->icon }}" style="color: #{{ $category->color }};"></i>
              </div>
              <h3 class="category-name">{{ $category->name }}</h3>
              <span class="category-arrow"><i class="fal fa-arrow-right"></i></span>
            </a>
          @endforeach
        </div>
      @else
        <div class="text-center py-5">
          <h3>{{ __('No Course Category Found') }}</h3>
        </div>
      @endif

      @if (!empty(showAd(3)))
        <div class="text-center mt-5">
          {!! showAd(3) !!}
        </div>
      @endif
    </div>
  </section>
@endif

<!-- ============ CTA SECTION ============ -->
@if (!empty($themeV4CtaSettings->status))
  <section class="cta-section" style="background: linear-gradient(135deg, rgba({{ hexToRgb($themeV4CtaSettings->gradient_color_1 ?? '1866d4') }}, 0.85) 0%, rgba({{ hexToRgb($themeV4CtaSettings->gradient_color_2 ?? '580ce3') }}, 0.85) 100%), url('{{ !empty($themeV4CtaSettings->background_image) ? asset('assets/img/action-section/' . $themeV4CtaSettings->background_image) : '' }}'); background-size: cover; background-position: center;">
    <div class="cta-overlay"></div>
    <div class="container">
      <div class="cta-content text-center">
        @if (!empty($themeV4CtaSettings->title))
          <div class="cta-badge">
            {{ $themeV4CtaSettings->title }}
          </div>
        @endif
        @if (!empty($themeV4CtaSettings->subtitle))
          <h2 class="cta-title">
            {{ $themeV4CtaSettings->subtitle }}
          </h2>
        @endif
        @if (!empty($themeV4CtaSettings->description))
          <p class="cta-description">{{ $themeV4CtaSettings->description }}</p>
        @endif
        <div class="cta-buttons">
          @if (!empty($themeV4CtaSettings->button_1_text) && !empty($themeV4CtaSettings->button_1_url))
            <a href="{{ $themeV4CtaSettings->button_1_url }}" class="btn btn-light">
              {{ $themeV4CtaSettings->button_1_text }}
            </a>
          @endif
          @if (!empty($themeV4CtaSettings->button_2_text) && !empty($themeV4CtaSettings->button_2_url))
            <a href="{{ $themeV4CtaSettings->button_2_url }}" class="btn btn-outline-light">
              {{ $themeV4CtaSettings->button_2_text }}
            </a>
          @endif
        </div>
      </div>
    </div>
  </section>
@endif

<!-- ============ FEATURED COURSES SECTION ============ -->
@if ($secInfo->featured_courses_section_status == 1)
  <section class="featured-courses-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">{{ !empty($secTitleInfo->featured_courses_section_title) ? $secTitleInfo->featured_courses_section_title : __('Featured Courses') }}</h2>
      </div>

      @if (count($courses) > 0)
        <div class="courses-grid">
          @foreach ($courses as $index => $course)
            <div class="course-card" data-delay="{{ ($index % 3) * 100 }}">
              <div class="course-image">
                <img src="{{ asset('assets/img/courses/thumbnails/' . $course->thumbnail_image) }}" alt="{{ $course->title }}" class="lazy">
                <div class="course-overlay">
                  <a href="{{ route('course_details', ['slug' => $course->slug]) }}" class="btn btn-primary btn-sm">
                    {{ __('View Course') }}
                  </a>
                </div>
                <div class="course-category-badge">
                  <a href="{{route('courses', ['category' => $course->categorySlug])}}">{{ $course->categoryName }}</a>
                </div>
              </div>
              <div class="course-body">
                <h3 class="course-title">
                  <a href="{{ route('course_details', ['slug' => $course->slug]) }}">
                    {{ strlen($course->title) > 50 ? mb_substr($course->title, 0, 50, 'UTF-8') . '...' : $course->title }}
                  </a>
                </h3>
                <div class="course-instructor">
                  <img src="{{ asset('assets/img/instructors/' . $course->instructorImage) }}" alt="{{ $course->instructorName }}" class="instructor-avatar">
                  <span>{{ strlen($course->instructorName) > 15 ? mb_substr($course->instructorName, 0, 15, 'utf-8') . '...' : $course->instructorName }}</span>
                </div>
                <div class="course-stats">
                  <span class="stat"><i class="fal fa-users"></i> {{ $course->enrolmentCount }}</span>
                  @php
                    $array = explode(':', $course->duration);
                    $hour = $array[0];
                    $courseDuration = \Carbon\Carbon::parse($course->duration);
                  @endphp
                  <span class="stat"><i class="fal fa-clock"></i> {{ $hour == '00' ? '00' : $courseDuration->format('h') }}h {{ $courseDuration->format('i') }}m</span>
                </div>
                <div class="course-footer">
                  <div class="course-rating">
                    <div class="stars">
                      @for ($i = 0; $i < 5; $i++)
                        <i class="fa{{ $i < round($course->average_rating) ? 's' : 'l' }} fa-star"></i>
                      @endfor
                    </div>
                    <span class="rating-value">{{ round($course->average_rating, 1) }}</span>
                  </div>
                  <div class="course-price">
                    @if ($course->pricing_type == 'premium')
                      <span class="price-current">{{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}{{ $course->current_price }}{{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}</span>
                      @if (!is_null($course->previous_price))
                        <span class="price-original">{{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}{{ $course->previous_price }}{{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}</span>
                      @endif
                    @else
                      <span class="price-current">{{ __('Free') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-5">
          <h3>{{ __('No Featured Course Found') }}</h3>
        </div>
      @endif

      @if (!empty(showAd(3)))
        <div class="text-center mt-5">
          {!! showAd(3) !!}
        </div>
      @endif
    </div>
  </section>
@endif

<!-- ============ FEATURES SECTION ============ -->
@if ($secInfo->features_section_status == 1)
  @if (count($features) > 0)
    <section class="features-section" @if (!empty($featureData)) style="background-image: url('{{ asset('assets/img/' . $featureData->features_section_image) }}'); background-size: cover; background-position: center;" @endif>
      <div class="features-overlay"></div>
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ __('Why Choose Us') }}</h2>
        </div>
        <div class="features-grid">
          @foreach ($features as $index => $feature)
            <div class="feature-card" style="background: linear-gradient(135deg, #{{ $feature->background_color }}dd 0%, #{{ $feature->background_color }} 100%);" data-delay="{{ $index * 100 }}">
              <div class="feature-icon">
                <i class="fal fa-check-circle"></i>
              </div>
              <h3 class="feature-title">{{ $feature->title }}</h3>
              <p class="feature-text">{{ $feature->text }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endif

<!-- ============ VIDEO SECTION ============ -->
@if ($secInfo->video_section_status == 1 && !empty($videoData))
  <section class="video-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">{{ $videoData->title ?? '' }}</h2>
      </div>
      <div class="video-container">
        <div class="video-wrapper">
          <img src="{{ asset('assets/img/video-images/' . $videoData->image) }}" alt="Video thumbnail" class="video-thumbnail">
          <a href="{{ $videoData->link }}" class="video-play-btn video-popup">
            <i class="fas fa-play"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
@endif

<!-- ============ STATS SECTION ============ -->
@if ($secInfo->fun_facts_section_status == 1)
  @if (count($countInfos) > 0)
    <section class="stats-section" @if (!empty($factData->background_image)) style="background: linear-gradient(135deg, rgba(24, 102, 212, 0.8) 0%, rgba(88, 12, 227, 0.8) 100%), url('{{ asset('assets/img/fact-section/' . $factData->background_image) }}'); background-size: cover; background-position: center;" @endif>
      <div class="stats-overlay"></div>
      <div class="container">
        <div class="section-header">
          <h2 class="section-title text-white">{{ !empty($factData) ? $factData->title : '' }}</h2>
        </div>
        <div class="stats-grid">
          @foreach ($countInfos as $index => $countInfo)
            <div class="stat-card" data-delay="{{ $index * 100 }}">
              <div class="stat-value counter" data-target="{{ $countInfo->amount }}">0</div>
              <span class="stat-label">+</span>
              <p class="stat-text">{{ $countInfo->title }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endif

<!-- ============ TESTIMONIALS SECTION ============ -->
@if ($secInfo->testimonials_section_status == 1)
  @if (count($testimonials) > 0)
    <section class="testimonials-section" @if (!empty($testimonialData)) style="background-image: url('{{ asset('assets/img/' . $testimonialData->testimonials_section_image) }}'); background-size: cover; background-position: center;" @endif>
      <div class="testimonials-overlay"></div>
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ __('What Our Students Say') }}</h2>
        </div>
        <div class="testimonials-carousel">
          @foreach ($testimonials as $testimonial)
            <div class="testimonial-card">
              <div class="testimonial-stars">
                @for ($i = 0; $i < 5; $i++)
                  <i class="fas fa-star"></i>
                @endfor
              </div>
              <p class="testimonial-text">{{ $testimonial->comment }}</p>
              <div class="testimonial-author">
                <img src="{{ asset('assets/img/clients/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="author-avatar">
                <div class="author-info">
                  <h4 class="author-name">{{ $testimonial->name }}</h4>
                  <span class="author-title">{{ $testimonial->occupation }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endif

<!-- ============ FEATURED INSTRUCTORS SECTION ============ -->
@if ($secInfo->featured_instructors_section_status == 1)
  @if (!empty($instructors) && count($instructors) > 0)
    <section class="instructors-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ __('Meet Our Expert Instructors') }}</h2>
          <p class="section-subtitle">{{ __('Learn from industry professionals') }}</p>
        </div>
        <div class="instructors-grid">
          @foreach ($instructors as $index => $instructor)
            <div class="instructor-card" data-delay="{{ ($index % 3) * 100 }}">
              <div class="instructor-image">
                <img src="{{ asset('assets/img/instructors/' . $instructor->image) }}" alt="{{ $instructor->name }}">
                <div class="instructor-overlay">
                  <a href="{{ route('instructors') }}" class="btn btn-primary btn-sm">
                    {{ __('View Profile') }}
                  </a>
                </div>
              </div>
              <div class="instructor-info">
                <h3 class="instructor-name">{{ $instructor->name }}</h3>
                <p class="instructor-title">{{ $instructor->occupation ?? __('Instructor') }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endif

<!-- ============ ABOUT US SECTION ============ -->
@if ($secInfo->about_us_section_status == 1)
  @if (!empty($aboutUsInfo))
    <section class="about-section">
      <div class="container">
        <div class="about-wrapper">
          <div class="about-content">
            <h2 class="section-title">{{ $aboutUsInfo->title ?? '' }}</h2>
            <p class="about-text">{{ $aboutUsInfo->text ?? '' }}</p>
          </div>
          @if (!empty($aboutUsInfo->image))
            <div class="about-image">
              <img src="{{ asset('assets/img/about-section/' . $aboutUsInfo->image) }}" alt="About Us">
            </div>
          @endif
        </div>
      </div>
    </section>
  @endif
@endif

<!-- ============ BLOG SECTION ============ -->
@if ($secInfo->latest_blog_section_status == 1)
  @if (count($blogs) > 0)
    <section class="blog-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ __('Latest Articles & Insights') }}</h2>
          <p class="section-subtitle">{{ __('Stay updated with our latest news and resources') }}</p>
        </div>
        <div class="blog-grid">
          @foreach ($blogs as $index => $blog)
            <article class="blog-card" data-delay="{{ ($index % 3) * 100 }}">
              <div class="blog-image">
                <img src="{{ asset('assets/img/blogs/' . $blog->image) }}" alt="{{ $blog->title }}">
                <div class="blog-category">
                  <a href="{{ route('courses', ['category' => $blog->categorySlug]) }}">{{ $blog->categoryName }}</a>
                </div>
              </div>
              <div class="blog-content">
                <h3 class="blog-title">
                  <a href="{{ route('blog_details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                </h3>
                <div class="blog-meta">
                  <span class="blog-author"><i class="fal fa-user"></i> {{ $blog->author }}</span>
                </div>
                <a href="{{ route('blog_details', ['slug' => $blog->slug]) }}" class="blog-read-more">
                  {{ __('Read More') }} <i class="fal fa-arrow-right"></i>
                </a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endif

<!-- ============ NEWSLETTER SECTION ============ -->
@if ($secInfo->newsletter_section_status == 1)
  <section class="newsletter-section">
    <div class="newsletter-overlay"></div>
    <div class="container">
      <div class="newsletter-content">
        <h2 class="newsletter-title">{{ !empty($newsletterData->title) ? $newsletterData->title : __('Subscribe to Our Newsletter') }}</h2>
        <p class="newsletter-subtitle">{{ !empty($newsletterData->text) ? $newsletterData->text : __('Get the latest courses and updates delivered to your inbox') }}</p>
        <form class="newsletter-form subscriptionForm" action="{{ route('store_subscriber') }}" method="POST">
          @csrf
          <div class="newsletter-input-group">
            <input type="email" name="email" placeholder="{{ __('Enter your email address') }}" required>
            <button type="submit" class="btn btn-primary">{{ __('Subscribe') }}</button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endif

@endsection
