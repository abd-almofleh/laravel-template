@extends('frontend.layouts.home')


@section('content')
  <div class="home-default">
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section">
      <div class="home-slideshow" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="slide">
          <div class="blur-up lazyload">
            <img class="blur-up lazyload" data-src="{{ asset('images/slideshow-banners/home2-default-banner1.jpg') }}"
                 src="{{ asset('images/slideshow-banners/home2-default-banner1.jpg') }}" alt="Shop Our New Collection"
                 title="Shop Our New Collection" />
            <div class="slideshow__text-wrap slideshow__overlay classic middle">
              <div class="slideshow__text-content middle">
                <div class="container">
                  <div class="wrap-caption right" style="max-width: min-content;">
                    <h2 class="h1 mega-title slideshow__title">{{ __('frontend/default.general.download_our_app') }}</h2>
                    <div class="mega-subtitle slideshow__subtitle">
                      {{ __('frontend/default.general.available_on') }}
                    </div>
                    <div class="d-flex justify-content-center">
                      <a class="mx-1" href="https://play.google.com/store/apps/details?id=com.drm.aladham"
                         target="blank">
                        <img class="w-100" src="{{ asset('images/google-play-en.png') }}" alt="">
                      </a>
                      <a class="mx-1" href="https://apps.apple.com/us/app/al-adham/id6444677808" target="blank">
                        <img class="w-100" src="{{ asset('images/app-store-en.png') }}" alt="">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="blur-up lazyload">
            <img class="blur-up lazyload" data-src="{{ asset('images/slideshow-banners/home2-default-banner2.jpg') }}"
                 src="{{ asset('images/slideshow-banners/home2-default-banner2.jpg') }}" alt="Summer Bikini Collection"
                 title="Summer Bikini Collection" />
            <div class="slideshow__text-wrap slideshow__overlay classic middle">
              <div class="slideshow__text-content middle">
                <div class="container">
                  <div class="wrap-caption center">
                    <h2 class="h1 mega-title slideshow__title" style="color: white;">
                      {{ __('frontend/default.pages_titles.browse_horses') }}
                    </h2>
                    <span class="mega-subtitle slideshow__subtitle" style="color: white;">
                      {{ __('frontend/default.general.best_horses') }}
                    </span>
                    <a href="{{ route('listed_horses.list') }}">
                      <span class="btn">{{ __('frontend/default.general.browse_now') }}</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="section-header text-center">
              <h2 class="h2">{{ __('frontend/default.general.browse_by_type') }}</h2>
              <p>{{ __('frontend/default.general.best_horses_in_types') }}</p>
            </div>
            <div class="productSlider grid-products p-5">
              @foreach ($types as $type)
                <x-frontend.home.type-item :type="$type" />
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="hero hero--large hero__overlay bg-size">
        <img class="bg-img" src="{{ asset('images/parallax-banner.jpg') }}" alt="" />
        <div class="hero__inner" dir="ltr">
          <div class="container">
            <div class="wrap-text left text-small font-bold">
              <h2 class="h2 mega-title">{{ config('app.name') }} <br>
                {{ __('frontend/default.general.who_are_we_title') }}
              </h2>
              <div class="rte-setting mega-subtitle">
                {{ __('frontend/default.general.who_are_we') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="product-rows section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="section-header text-center">
              <h2 class="h2">{{ __('listedHorses.index.title') }}</h2>
              <p>{{ __('frontend/default.general.best_horses') }}</p>
            </div>
          </div>
        </div>
        <div class="grid-products grid--view-items">
          <div class="row">
            @foreach ($listedHorses as $listedHorse)
              <div class="col-6 col-md-4 col-lg-4 item">
                <x-frontend.listed-horses.listed-horse-item :horse="$listedHorse" />
              </div>
            @endforeach

          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
              <a href="{{ route('listed_horses.list') }}"
                 class="btn">{{ __('frontend/default.general.view_all') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr style="border-bottom: 2px solid #ffbe5c;" />

    <div class="product-rows section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="section-header text-center">
              <h2 class="h2">{{ __('frontend/default.general.recent_blogs') }}</h2>
              <p>{{ __('frontend/default.general.blogs_about_horses') }}</p>
            </div>
          </div>
        </div>
        <div class="blog--list-view">
          <div class="row">
            @foreach ($blogs as $blog)
              <x-frontend.blogs.grid-item :blog="$blog" class="col-12 col-sm-12 col-md-4 col-lg-4" />
            @endforeach
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
              <a href="{{ route('blogs.list') }}" class="btn">{{ __('frontend/default.general.view_all') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
