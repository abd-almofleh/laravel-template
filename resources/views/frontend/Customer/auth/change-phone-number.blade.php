@extends('frontend.layouts.home')
@section('title', __('frontend/default.general.change_phone_number_from', ['current_phone_number' =>
  $currentPhoneNumber]))

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
        <div class="mb-4">
          <form method="post"
                action="{{ route('customer.auth.account.validate_phone_number.change_phone_number.update') }}"
                class="contact-form">
            @csrf
            <x-errors-alert />
            <div class="row">
              <div class="form-group">
                <label for="phone_number">{{ __('frontend/default.form.phone_number') }}</label>
                <input type="phone_number" value="{{ old('phone_number') }}" name="phone_number" id="phone_number"
                       autofocus>
                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.general.update') }}">
              </div>
            </div>
          </form>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 text-center">
            <a href="{{ route('home') }}">{{ __('frontend/default.general.cancel') }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
