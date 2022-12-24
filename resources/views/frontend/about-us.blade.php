@extends('frontend.layouts.home')

@section('title', __('frontend/default.pages_titles.about_us'))


@section('content')

  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
        <div class="mb-4 text-center">
          <h2 class="h1">{{ config('app.name') }}</h2>
          <div class="h2 rte-setting">
            <p><strong>{{ __('frontend/default.general.best_horses') }}</strong></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/default.general.who_are_we_title') }}:</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <p class="card-body text-large">{{ __('frontend/default.general.who_are_we') }}</p>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/aboutUs.message.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <p class="card-body text-large"> {{ __('frontend/aboutUs.message.body') }}</p>
      </div>
    </div>
    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/aboutUs.vision.title') }}:</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <p class="card-body text-large"> {{ __('frontend/aboutUs.vision.body') }} </p>
      </div>
    </div>
    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/aboutUs.race.title') }}: </h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <ul class="card-body text-large">
          <li>{{ __('frontend/aboutUs.race.body.0') }}</li>
          <li>{{ __('frontend/aboutUs.race.body.1') }}</li>
          <li>{{ __('frontend/aboutUs.race.body.2') }}</li>
          <li>{{ __('frontend/aboutUs.race.body.3') }}</li>
          <li>{{ __('frontend/aboutUs.race.body.4') }}</li>
          <li>{{ __('frontend/aboutUs.race.body.5') }}</li>
        </ul>
      </div>
    </div>
  </div>

@endsection
