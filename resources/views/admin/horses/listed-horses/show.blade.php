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
        <div class="col-md-6">
          <h3 class="page-title">{{ __('listedHorses.show.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('horses.listed-horses.index') }}">{{ __('listedHorses.index.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('horses.listed-horses.show', $ListedHorse->id) }}">{{ __('listedHorses.show.title') }} -
                ({{ $ListedHorse->name }})</a>
            </li>
          </ul>
        </div>
        @can('horses-edit')
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <a href="{{ route('horses.listed-horses.edit', $ListedHorse) }}" class="btn custom-create-btn">
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
              {{ $ListedHorse->name }}
            </h5>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <!-- Swiper -->
                <div class="swiper photosSwiper">
                  <div class="swiper-wrapper">
                    @foreach ($ListedHorse->photos as $photo)
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
                              {{ $ListedHorse->id }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.name') }}
                            </th>
                            <td>
                              {{ $ListedHorse->name }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.sex') }}
                            </th>
                            <td>
                              {{ $ListedHorse->sex == 1 ? __('default.sex.male') : __('default.sex.female') }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.type') }}
                            </th>
                            <td>
                              {{ $ListedHorse->type->name }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.race') }}
                            </th>
                            <td>
                              {{ $ListedHorse->race }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.birth_year') }}
                            </th>
                            <td>
                              {{ $ListedHorse->birth_year }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.passport') }}
                            </th>
                            <td>
                              {{ $ListedHorse->passport->name }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.height') }}
                            </th>
                            <td>
                              {{ $ListedHorse->height }} <small>{{ __('default.form.meter') }}</small>
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.weight') }}
                            </th>
                            <td>
                              {{ $ListedHorse->weight }} <small>{{ __('default.form.kg') }}</small>
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.color') }}
                            </th>
                            <td>
                              {{ $ListedHorse->color }}
                            </td>
                          </tr>
                          <tr>
                          <tr>
                            <th>
                              {{ __('default.form.health') }}
                            </th>
                            <td>
                              {{ $ListedHorse->health }}
                            </td>
                          </tr>
                          <tr>
                            <th>
                              {{ __('default.form.contact_number') }}
                            </th>
                            <td>
                              {{ $ListedHorse->contact_number }}
                            </td>
                          </tr>
                          @if ($ListedHorse->father_name)
                            <tr>
                              <th>
                                {{ __('default.form.father_name') }}
                              </th>
                              <td>
                                {{ $ListedHorse->father_name }}
                              </td>
                            </tr>
                          @endif
                          @if ($ListedHorse->mother_name)
                            <tr>
                              <th>
                                {{ __('default.form.mother_name') }}
                              </th>
                              <td>
                                {{ $ListedHorse->mother_name }}
                              </td>
                            </tr>
                          @endif
                          <tr>
                            <th>
                              {{ __('default.form.description') }}
                            </th>
                            <td>
                              {!! $ListedHorse->description !!}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> <!-- end card -->
              <div class="col-12">
                <!-- Swiper -->
                <div class="swiper videosSwiper">
                  <div class="swiper-wrapper">
                    @foreach ($ListedHorse->videos as $video)
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
            </div>
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
                                  {{ $ListedHorse->meta_title }}
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  {{ __('default.form.meta_description') }}
                                </th>
                                <td>
                                  {{ $ListedHorse->meta_description }}
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  {{ __('default.form.meta_keywords') }}
                                </th>
                                <td>
                                  {{ $ListedHorse->meta_keywords }}
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
