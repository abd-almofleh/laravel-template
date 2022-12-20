@extends('frontend.layouts.home')
@section('title', __('frontend/default.pages_titles.horses.list'))



@section('content')
  <div class="collection-header">
    <div class="collection-hero">
      <div class="collection-hero__image">
        <img class="blur-up lazyload" src="{{ asset('images/horses-banner.jpg') }}" alt="Horses" title="Horses" />
      </div>
      <div class="collection-hero__title-wrapper">
        <h1 class="collection-hero__title page-width">{{ __('frontend/default.pages_titles.browse_horses') }}</h1>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
        <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
        <div class="sidebar_tags">
          <x-frontend.listed-horses.search-bar />
          <x-frontend.listed-horses.types />
          <x-frontend.listed-horses.birth-date-filter />
          <x-frontend.listed-horses.height-filter />
          <x-frontend.blogs.recent-blogs />
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
        <div class="productList">
          <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
          <div class="grid-products grid--view-items">
            <div class="row">
              @foreach ($listedHorses as $listedHorse)
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 item">
                  <x-frontend.listed-horses.listed-horse-item :horse="$listedHorse" />
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <hr />
        {{ $listedHorses->onEachSide(3)->links('pagination::default') }}
      </div>
    </div>
  </div>
@endsection
