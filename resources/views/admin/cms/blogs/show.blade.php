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
        <div class="col-md-9">
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
                ({{ $blog->title_en ?? ($blog->title_ar ?? 'No Title') }}) @if ($blog->title_en)
                  - [{{ $blog->title_ar ?? 'No Arabic title' }}]
                @endif
              </a>
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

  @isset($blog->title_en)
    <section class="crud-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <h1>{{ $blog->title_en }}</h1>
                    <h5> {{ __('default.table.author') }}: {{ $blog->author->name }}</h5>
                    <h6> {{ __('default.table.category') }}: {{ $blog->category->name_en }}</h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    @isset($blog->photo)
                      <img class="img-fluid w-100" src="{{ $blog->photo->url }}" alt="photo">
                    @else
                      <span class="text-danger font-weight-bold">{{ __('default.general.no_image') }}</span>
                    @endisset
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-12">
                    @isset($blog->description_en)
                      {!! $blog->description_en !!}
                    @else
                      <span class="text-danger font-weight-bold">{{ __('default.general.no_english_description') }}</span>
                    @endisset
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @else
    <div class="text-danger font-weight-bold text-center">{{ __('default.general.no_english_translation') }}</div>
  @endisset
  @isset($blog->title_ar)
    <section class="crud-body position-relative text-right" dir="rtl" lang="ar">

      <div class="row" dir="rtl">
        <div class="col-md-12" dir="rtl">
          <div class="card" dir="rtl">
            <div class="card-body" dir="rtl">
              <div class="container" dir="rtl">
                <div class="row" dir="rtl">
                  <div class="col-lg-12" dir="rtl">
                    <h1 dir="rtl">{{ $blog->title_ar }}</h1>
                    <h5 dir="rtl"> {{ __('default.general.author_ar') }}: {{ $blog->author->name }}</h5>
                    <h6 dir="rtl"> {{ __('default.general.category_ar') }}: {{ $blog->category->name_ar }}</h6>
                  </div>
                </div>
                <div class="row" dir="rtl">
                  <div class="col-lg-12" dir="rtl">
                    @isset($blog->photo)
                      <img dir="rtl" class="img-fluid w-100" src="{{ $blog->photo->url }}" alt="photo">
                    @else
                      <span dir="rtl" class="text-danger font-weight-bold">{{ __('default.general.no_image') }}</span>
                    @endisset
                  </div>
                </div>
                <div dir="rtl" class="row position-relative mt-4">
                  <div dir="rtl" class="col-lg-12">
                    @isset($blog->description_ar)
                      {!! $blog->description_ar !!}
                    @else
                      <span class="text-danger font-weight-bold">{{ __('default.general.no_arabic_description') }}</span>
                    @endisset

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @else
    <div class="text-danger font-weight-bold text-center">{{ __('default.general.no_arabic_translation') }}</div>
  @endisset

@endsection
