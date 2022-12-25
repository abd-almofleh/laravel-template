@extends('frontend.layouts.home')

@section('title', __('frontend/default.pages_titles.horses.show'))

@section('breadcrumbs')
  <a href="{{ route('home') }}" title="{{ __('frontend/action_titles.go_back_home') }}">
    {{ __('frontend/default.pages_titles.home') }}
  </a>
  <span aria-hidden="true">›</span>
  <a href="{{ route('listed_horses.list') }}" title="{{ __('frontend/action_titles.go_back_to_horses') }}">
    {{ __('frontend/default.pages_titles.horses.list') }}
  </a>
  <span aria-hidden="true">›</span>
  <span>{{ __('frontend/default.pages_titles.horses.show') }}</span>
@endsection

@push('styles')
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <style>
    #output {
      width: 100%;
    }

    .swiper {
      width: 100%;
      height: fit-content;
      max-height: 20rem;
      padding-bottom: 30px;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      height: 90%;
      object-fit: cover;
    }
  </style>
@endpush

@section('content')
  <div id="ProductSection-product-template" class="product-template__container prstyle2 container">
    <div class="product-single product-single-1">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="product-details-img product-single__photos bottom">
            <div class="zoompro-wrap product-zoom-right pl-20">
              <div class="zoompro-span">
                @if (count($listedHorse->photos) > 0)
                  <img class="blur-up lazyload zoompro w-100" data-zoom-image="{{ $listedHorse->photos[0]->preview }}"
                       alt="{{ $listedHorse->name }}" src="{{ $listedHorse->photos[0]->fullUrl }}" />
                @else
                  <div class="w-100 h-100">{{ __('default.general.no_preview_images') }}</div>
                @endif
              </div>
            </div>
            <div class="product-thumb product-thumb-1">
              <div id="gallery" class="product-dec-slider-1 product-tab-left">
                @foreach ($listedHorse->photos as $photo)
                  <a data-image="{{ $photo->fullUrl }}" data-zoom-image="{{ $photo->fullUrl }}"
                     class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                    <img class="blur-up lazyload" src="{{ $photo->fullUrl }}" alt="" />
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="product-single__meta">
            <h1 class="product-single__title">{{ $listedHorse->name }}</h1>
            <div class="row">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <table class="table-bordered table-striped table">
                        <tbody>
                          <tr>
                            <th>
                              {{ __('default.form.location') }}
                            </th>
                            <td>
                              {{ $listedHorse->location }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.gender') }}
                            </th>
                            <td>
                              {{ $listedHorse->genderType }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.type') }}
                            </th>
                            <td>
                              {{ $listedHorse->type->name_en }} - {{ $listedHorse->type->name_ar }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.race') }}
                            </th>
                            <td>
                              {{ $listedHorse->race }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.birth_year') }}
                            </th>
                            <td>
                              {{ $listedHorse->birth_year }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.passport') }}
                            </th>
                            <td>
                              {{ $listedHorse->passport->name_en }} - {{ $listedHorse->passport->name_ar }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.height') }}
                            </th>
                            <td>
                              {{ $listedHorse->height }} <small>{{ __('default.form.meter') }}</small>
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.color') }}
                            </th>
                            <td>
                              {{ $listedHorse->color }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.health') }}
                            </th>
                            <td>
                              {{ $listedHorse->health }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.contact_number') }}
                            </th>
                            <td>
                              {{ $listedHorse->contact_number }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> <!-- end card -->
            </div>
            <div class="prInfoRow">
              <div class="product-single__description rte">
                <p class="h1">{{ __('default.form.description') }}</p>
                <p>{{ $listedHorse->description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @if (count($listedHorse->videos))
          <div class="col-12">
            <!-- Swiper -->
            <div class="swiper videosSwiper" style="max-height: fit-content !important;">
              <div class="swiper-wrapper">
                @foreach ($listedHorse->videos as $video)
                  <div class="swiper-slide">
                    <video controls>
                      <source src="{{ $video->url }}" type="{{ $video->mime_type }}">
                    </video>
                  </div>
                @endforeach
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <script>
    const swiper = new Swiper(".videosSwiper", {
      navigation: {
        nextEl: ".videosSwiper .swiper-button-next",
        prevEl: ".videosSwiper .swiper-button-prev",
      },
      pagination: {
        el: '.videosSwiper .swiper-pagination',
        type: 'bullets',
      },
      loop: true
    });
  </script>
@endpush
