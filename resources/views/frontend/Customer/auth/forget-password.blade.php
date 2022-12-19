@php
  $user = Auth()
      ->guard('customer_frontend')
      ->user();
@endphp
@extends('frontend.layouts.home')
@section('title', __('frontend/default.pages_titles.forget_password'))

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 col-d-6 col-sm-12 sm-margin-30px-bottom">
        <div class="create-ac-content bg-light-gray padding-20px-all">
          <form action="{{ route('customer.auth.reset_password.request') }}" method="post">
            @csrf
            <h2 class="mb-3">{{ __('frontend/default.general.reset_password') }}</h2>
            <x-errors-alert />
            <div class="row">
              <div class="form-group col-12 required">
                <label for="email">{{ __('frontend/default.form.email') }} <span class="required-f">*</span></label>
                <input name="email" id="email" type="">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.general.reset_password') }}">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
