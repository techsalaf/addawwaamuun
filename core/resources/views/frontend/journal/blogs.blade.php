@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->blog_page_title ?? 'Blog' }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_blog }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_blog }}
  @endif
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->blog_page_title ?? 'Blog'])

  <!--====== BLOG STANDARD PART START ======-->
  <section class="blog-standard-area gray-bg pt-80 pb-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="blog-standard">
            <div class="row">
              @if (count($blogs) == 0)
                <div class="col">
                  <h3 class="mt-40 text-center">{{ __('No Blog Found') . '!' }}</h3>
                </div>
              @else
                @foreach ($blogs as $blog)
                  <div class="col-lg-6 col-md-6 col-sm-9">
                    <div class="single-blog-grid mt-40">
                      <a href="{{ route('blog_details', ['slug' => $blog->slug]) }}" class="blog-thumb">
                        <img data-src="{{ asset('assets/img/blogs/' . $blog->image) }}" class="lazy" alt="image">
                      </a>
                      <div class="blog-content">
                        <a class="category" href="{{route('blogs', ['category' => $blog->categorySlug])}}">{{ $blog->categoryName }}</a>
                        <a class="d-block" href="{{ route('blog_details', ['slug' => $blog->slug]) }}">
                          <h4 class="title">{{ strlen($blog->title) > 30 ? mb_substr($blog->title, 0, 30, 'UTF-8') . '...' : $blog->title }}</h4>
                        </a>
                        <ul>
                          <li><i class="fal fa-calendar-alt"></i> {{ date_format($blog->created_at, 'M d, Y') }}</li>
                        </ul>
                        <p>{!! strlen(strip_tags($blog->content)) > 100 ? mb_substr(strip_tags($blog->content), 0, 100, 'UTF-8') . '...' : strip_tags($blog->content) !!}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>

            @if (count($blogs) > 0)
              {{ $blogs->appends([
                'title' => request()->input('title'), 
                'category' => request()->input('category')
              ])->links() }}
            @endif
            
          </div>

          @if (!empty(showAd(3)))
            <div class="text-center mt-30">
              {!! showAd(3) !!}
            </div>
          @endif
        </div>

        @includeIf('frontend.journal.side-bar')
      </div>
    </div>
  </section>
  <!--====== BLOG STANDARD PART END ======-->
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('assets/js/blog.js') }}"></script>
@endsection
