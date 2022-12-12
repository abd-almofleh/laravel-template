@extends('frontend.layouts.home')

@section('title', __('frontend/default.pages_titles.blogs.show'))

@section('breadcrumbs')
  <a href="{{ route('home') }}" title="{{ __('frontend/action_titles.go_back_home') }}">
    {{ __('frontend/default.pages_titles.home') }}
  </a>
  <span aria-hidden="true">›</span>
  <a href="{{ route('blogs.list') }}" title="{{ __('frontend/action_titles.go_back_to_blogs') }}">
    {{ __('frontend/default.pages_titles.blogs.list') }}
  </a>
  <span aria-hidden="true">›</span>
  <span>{{ __('frontend/default.pages_titles.blogs.show') }}</span>

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
        <div class="sidebar_tags">
          <x-frontend.blogs.categories />

          <x-frontend.blogs.recent-blogs />

          <x-frontend.trending-horses />
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
        <div class="blog--list-view">
          <div class="article">
            <h1><a href="blog-left-sidebar.html">{{ $blog->title }}</a></h1>

            <a class="article_featured-image" href="#"><img class="blur-up lazyload"
                   data-src="{{ $blog->photo->url }}" src="{{ $blog->photo->preview }}" alt="{{ $blog->title }}"></a>
            <ul class="publish-detail">
              <li><i class="fa fa-user app-text-primary" aria-hidden="true"></i> {{ $blog->author->name }}</li>
              <li><i class="icon fa fa-tags app-text-primary"></i> {{ $blog->category->name }}</li>
            </ul>
            <div class="rte">
              {!! $blog->description !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
