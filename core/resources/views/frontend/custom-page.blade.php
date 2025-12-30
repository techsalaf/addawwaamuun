@extends('frontend.layout')

@section('pageHeading')
  {{ $pageInfo->title }}
@endsection

@section('metaKeywords')
  {{ $pageInfo->meta_keywords }}
@endsection

@section('metaDescription')
  {{ $pageInfo->meta_description }}
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageInfo->title])

  <!--====== PAGE CONTENT PART START ======-->
  <section class="custom-page-area pt-100 pb-90">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="summernote-content">
            {!! replaceBaseUrl($pageInfo->content, 'summernote') !!}
          </div>
        </div>
      </div>

      @if (!empty(showAd(3)))
        <div class="text-center mt-30">
          {!! showAd(3) !!}
        </div>
      @endif
    </div>
  </section>
  <!--====== PAGE CONTENT PART END ======-->
@endsection
