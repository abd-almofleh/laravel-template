@extends('frontend.layouts.home')

@section('title', __('frontend/default.pages_titles.blogs.list'))

@section('content')
  <div class="bredcrumbWrap">
    <div class="breadcrumbs container">
      <a href="{{ route('home') }}" title="{{ __('frontend/action_titles.go_back_home') }}">
        {{ __('frontend/default.pages_titles.home') }}
      </a>
      <span aria-hidden="true">›</span>
      <span>{{ __('frontend/default.pages_titles.blogs.list') }}</span>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
        <div class="sidebar_tags">
          <div class="sidebar_widget categories">
            <div class="widget-title">
              <h2>Category</h2>
            </div>
            <div class="widget-content">
              <ul class="sidebar_categories">
                <li class="lvl-1 @if (request()->get('category') === null) active @endif"><a href="{{ route('blogs.list') }}"
                     class="site-nav lvl-1">{{ __('frontend/default.general.all') }}</a></li>
                @foreach ($categories as $category)
                  <li class="lvl-1 @if ($category->name == request()->get('category')) active @endif"><a href="{{ $category->url }}"
                       class="site-nav lvl-1">{{ $category->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
          {{-- TODO: add recent horses   --}}
          <div class="sidebar_widget">
            <div class="widget-title">
              <h2>Recent Posts</h2>
            </div>
            <div class="widget-content">
              <div class="list list-sidebar-products">
                <div class="grid">
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image">
                        <a class="grid-view-item__link" href="#">
                          <img class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/blog/blog-post-sml-1.jpg"
                               src="assets/images/blog/blog-post-sml-1.jpg" alt="" />
                        </a>
                      </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">It's all about how you
                          wear</a>
                        <div class="grid-view-item__meta"><span class="article__date"> <time
                                  datetime="2017-05-02T14:33:00Z">May 02, 2017</time></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                               class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/blog/blog-post-sml-2.jpg"
                               src="assets/images/blog/blog-post-sml-2.jpg" alt="" /></a> </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">27 Days of Spring Fashion
                          Recap</a>
                        <div class="grid-view-item__meta"><span class="article__date"> <time
                                  datetime="2017-05-02T14:33:00Z">May 02, 2017</time> </span></div>
                      </div>
                    </div>
                  </div>
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                               class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/blog/blog-post-sml-3.jpg"
                               src="assets/images/blog/blog-post-sml-3.jpg" alt="" /></a> </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">How to Wear The Folds Trend
                          Four Ways</a>
                        <div class="grid-view-item__meta"><span class="article__date"> <time
                                  datetime="2017-05-02T14:14:00Z">May 02, 2017</time> </span></div>
                      </div>
                    </div>
                  </div>
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                               class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/blog/blog-post-sml-4.jpg"
                               src="assets/images/blog/blog-post-sml-4.jpg" alt="" /></a> </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">Accusantium doloremque</a>
                        <div class="grid-view-item__meta"><span class="article__date"> <time
                                  datetime="2017-05-02T14:12:00Z">May 02, 2017</time> </span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
        <x-frontend.search-bar />
        <div class="blog--list-view">
          <div class="row">
            @foreach ($blogs as $blog)
              <x-frontend.blogs.grid-item :blog="$blog" class="col-12 col-sm-12 col-md-4 col-lg-4" />
            @endforeach
          </div>
          <hr />
          {{ $blogs->onEachSide(3)->links('pagination::default') }}
        </div>
      </div>
    </div>
  </div>
@endsection
