@extends('admin.layouts.master')

@section('page_title')
  {{ __('listedHorses.show.title') }}
@endsection

@push('css')
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
  <div class="page-header">
    <div class="card breadcrumb-card">
      <div class="row justify-content-between align-content-between" style="height: 100%;">
        <div class="col-md-9">
          <h3 class="page-title">{{ __('listedHorses.show.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('horses.listed-horses.index') }}">{{ __('listedHorses.index.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('horses.listed-horses.show', $listedHorse->id) }}">{{ __('listedHorses.show.title') }} -
                ({{ $listedHorse->name }})</a>
            </li>
          </ul>
        </div>
        @can('horses-edit')
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <a href="{{ route('horses.listed-horses.edit', $listedHorse) }}" class="btn custom-create-btn">
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
              {{ $listedHorse->name }}
            </h5>
          </div>

          <div class="card-body">
            @if (count($listedHorse->videos))
              <div class="row">
                <div class="col-12">
                  <!-- Swiper -->
                  <div class="swiper photosSwiper">
                    <div class="swiper-wrapper">
                      @foreach ($listedHorse->photos as $photo)
                        <div class="swiper-slide">
                          <img src="{{ $photo->url }}" alt="horse">
                        </div>
                      @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                  </div>
                </div>
              </div>
            @endif
            <div class="row">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <table class="table-bordered table-striped table">
                        <tbody>
                          <tr>
                            <th>
                              {{ __('default.form.id') }}
                            </th>
                            <td>
                              {{ $listedHorse->id }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.name') }}
                            </th>
                            <td>
                              {{ $listedHorse->name }}
                            </td>
                          </tr>
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
            <div class="row">
              @if (count($listedHorse->videos))
                <div class="col-12">
                  <!-- Swiper -->
                  <div class="swiper videosSwiper">
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
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-name">{{ __('default.form.seo_information') }}</h4>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <table class="table-bordered table-striped table">
                              <tbody>
                                <tr>
                                  <th>
                                    {{ __('default.form.meta_title') }}
                                  </th>
                                  <td>
                                    {{ $listedHorse->meta_title }}
                                  </td>
                                </tr>
                                <tr>
                                  <th>
                                    {{ __('default.form.meta_description') }}
                                  </th>
                                  <td>
                                    {{ $listedHorse->meta_description }}
                                  </td>
                                </tr>
                                <tr>
                                  <th>
                                    {{ __('default.form.meta_keywords') }}
                                  </th>
                                  <td>
                                    {{ $listedHorse->meta_keywords }}
                                  </td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> <!-- end card body -->
                </div> <!-- end card -->
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-name">
                      {{ __('default.form.description') }}
                    </h4>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <table class="table-bordered table-striped table">
                              <tbody>
                                {{ $listedHorse->description }}
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".photosSwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      autoplay: {
        delay: 5000,
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
      },
      loop: true
    });

    var swiper = new Swiper(".videosSwiper", {
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
