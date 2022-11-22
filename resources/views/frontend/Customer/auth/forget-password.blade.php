@php
  $user = Auth()
      ->guard('customer_frontend')
      ->user();
@endphp
@extends('frontend.layouts.home')
@section('title', __('frontend/default.pages_titles.forget_password'))

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 col-d-6 col-sm-12 sm-margin-30px-bottom">
        <div class="create-ac-content bg-light-gray padding-20px-all">
          <form action="{{ route('customer.auth.forget_password.reset') }}" method="post">
            @csrf
            @method('PATCH')
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
              <div class="form-group col-12 required">
                <label for="password">{{ __('frontend/default.form.new_password') }} <span
                        class="required-f">*</span></label>
                <input name="password" id="password" type="password">
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 required">
                <label for="password_confirmation">{{ __('frontend/default.form.new_password_confirmation') }} <span
                        class="required-f">*</span></label>
                <input name="password_confirmation" id="password_confirmation" type="password">
                @error('password_confirmation')
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
