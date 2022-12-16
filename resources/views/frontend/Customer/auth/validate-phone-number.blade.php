@extends('frontend.layouts.home')
@section('title', __('frontend/default.general.verify_phone_number'))

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
        <div class="mb-4">
          <form method="post" action="{{ route('customer.auth.account.validate-phone-number') }}" class="contact-form">
            @csrf
            <x-errors-alert />
            <div class="row">
              <div class="form-group">
                <label for="otp">{{ __('frontend/default.form.otp') }}</label>
                <input type="otp" value="{{ old('otp') }}" name="otp" id="otp"autofocus>
                @error('otp')
                  <span class="text-danger">{{ $message }}</span>
                @enderror


              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.general.verify') }}">
                <p class="mb-4">
                  <a href="" id="resend-otp">{{ __('frontend/default.general.resend_otp') }}</a>
                  &nbsp; | &nbsp;
                  <a href="" id="change-phone-number">{{ __('frontend/default.general.change_phone_number') }}</a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
