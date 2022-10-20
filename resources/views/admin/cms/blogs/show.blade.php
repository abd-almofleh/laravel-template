@extends('admin.layouts.master')

@section('page_title')
  {{ __('cms.blogs.show.title') }}
@endsection

@push('css')
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <style>
    #output {
      width: 100%;
    }
  </style>
@endpush
@section('content')
  <div class="page-header">
    <div class="card breadcrumb-card">
      <div class="row justify-content-between align-content-between" style="height: 100%;">
        <div class="col-md-6">
          <h3 class="page-title">{{ __('cms.blogs.show.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('cms.blogs.index') }}">{{ __('cms.blogs.index.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('cms.blogs.show', $blog->id) }}">{{ __('cms.blogs.show.title') }} -
                ({{ $blog->title_en }})</a>
            </li>
          </ul>
        </div>
        @can('horses-edit')
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <a href="{{ route('cms.blogs.edit', $blog) }}" class="btn custom-create-btn">
                {{ __('default.form.edit-button') }}
              </a>
            </div>
          </div>
        @endcan

      </div>
    </div>
  </div>

  <section class="crud-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <h5 class="card-title">
              {{ $blog->title_en }}
            </h5>
          </div>

          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <h1>{{ $blog->title_en }}</h1>
                  <h6> {{ __('default.table.author') }}: {{ $blog->author->name }}</h6>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <img class="img-fluid w-100" src="{{ $blog->photo->url }}" alt="photo">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-12">
                  {!! $blog->description_en !!}
                </div>
              </div>

            </div>
          </div>


        </div>
      </div>
  </section>
@endsection
