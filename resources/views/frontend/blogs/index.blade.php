@extends('frontend.layouts.home')

@section('title', __('frontend/default.pages_titles.blogs.list'))

@section('breadcrumbs')
  <a href="{{ route('home') }}" title="{{ __('frontend/action_titles.go_back_home') }}">
    {{ __('frontend/default.pages_titles.home') }}
  </a>
  <span aria-hidden="true">›</span>
  <span>{{ __('frontend/default.pages_titles.blogs.list') }}</span>
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar order-md-0 order-last">
        <x-frontend.blogs.categories />
        <x-frontend.trending-horses />
        <x-frontend.blogs.recent-blogs />
      </div>
      <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col order-md-last order-first">
        {{-- TODO: Add the search functionality --}}
        {{-- <x-frontend.search-bar /> --}}
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
