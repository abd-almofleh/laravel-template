@php
  $user = Auth()
      ->guard('customer_frontend')
      ->user();
@endphp
@extends('frontend.layouts.home')
@section('title', __('frontend/default.pages_titles.profile'))

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 col-d-6 col-sm-12 sm-margin-30px-bottom">
        <div class="create-ac-content bg-light-gray padding-20px-all">
          <form action="{{ route('customer.profile.update') }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="mb-3">{{ __('frontend/default.general.profile_information') }}</h2>
            <x-errors-alert />
            <div class="row">
              <div class="form-group col-12 required">
                <label for="name"> {{ __('frontend/default.form.name') }} <span class="required-f">*</span></label>
                <input name="name" value="{{ $user->name }}" id="name" type="text">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 required">
                <label for="email">{{ __('frontend/default.form.email') }} <span class="required-f">*</span></label>
                <input name="email" value="{{ $user->email }}" id="email" type="email">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 required">
                <label for="phone_number">{{ __('frontend/default.form.phone_number') }} <span
                        class="required-f">*</span></label>
                <input name="phone_number" value="{{ $user->phone_number }}" id="phone_number" type="tel">
                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.form.update') }}">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-d-6 col-sm-12 sm-margin-30px-bottom">
        <div class="create-ac-content bg-light-gray padding-20px-all">
          <form action="{{ route('customer.profile.update') }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="mb-3">{{ __('frontend/default.general.profile_password') }}</h2>
            <x-errors-alert />
            <div class="row">
              <div class="form-group col-12 required">
                <label for="password">{{ __('frontend/default.form.password') }} <span
                        class="required-f">*</span></label>
                <input name="password" id="password" type="">
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.form.update_password') }}">
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
