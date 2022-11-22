@extends('frontend.layouts.home')

@section('title', __('frontend/default.pages_titles.blogs.show'))

@section('breadcrumbs')
  <a href="{{ route('home') }}" title="{{ __('frontend/action_titles.go_back_home') }}">
    {{ __('frontend/default.pages_titles.home') }}
  </a>
  <span aria-hidden="true">›</span>
  <span>{{ __('frontend/default.pages_titles.blogs.list') }}</span>
  <span aria-hidden="true">›</span>
  <span>{{ __('frontend/default.pages_titles.blogs.show') }}</span>

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <!--Sidebar-->
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
        <div class="sidebar_tags">
          <x-frontend.categories />

          <x-frontend.recent-posts />

          <div class="sidebar_widget static-banner">
            <img src="assets/images/side-banner-2.jpg" alt="">
          </div>
          <div class="sidebar_widget">
            <div class="widget-title">
              <h2>Trending Now</h2>
            </div>
            <div class="widget-content">
              <div class="list list-sidebar-products">
                <div class="grid">
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image">
                        <a class="grid-view-item__link" href="#">
                          <img class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/product-images/mini-product-img.jpg"
                               src="assets/images/product-images/mini-product-img.jpg" alt="" />
                        </a>
                      </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">Cena Skirt</a>
                        <div class="grid-view-item__meta"><span class="product-price__price"><span
                                  class="money">$173.60</span></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                               class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/product-images/mini-product-img1.jpg"
                               src="assets/images/product-images/mini-product-img1.jpg" alt="" /></a> </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">Block Button Up</a>
                        <div class="grid-view-item__meta"><span class="product-price__price"><span
                                  class="money">$378.00</span></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                               class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/product-images/mini-product-img2.jpg"
                               src="assets/images/product-images/mini-product-img2.jpg" alt="" /></a> </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">Balda Button Pant</a>
                        <div class="grid-view-item__meta"><span class="product-price__price"><span
                                  class="money">$278.60</span></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="grid__item">
                    <div class="mini-list-item">
                      <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                               class="grid-view-item__image blur-up lazyload"
                               data-src="assets/images/product-images/mini-product-img3.jpg"
                               src="assets/images/product-images/mini-product-img3.jpg" alt="" /></a> </div>
                      <div class="details"> <a class="grid-view-item__title" href="#">Border Dress in
                          Black/Silver</a>
                        <div class="grid-view-item__meta"><span class="product-price__price"><span
                                  class="money">$228.00</span></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--End Sidebar-->
      <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
        <div class="blog--list-view">
          <div class="article">
            <a class="article_featured-image" href="#"><img class="blur-up lazyload"
                   data-src="{{ $blog->photo->url }}" src="{{ $blog->photo->preview }}" alt="{{ $blog->title }}"></a>
            <h1><a href="blog-left-sidebar.html">{{ $blog->title }}</a></h1>
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
