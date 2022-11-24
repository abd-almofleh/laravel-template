@extends('frontend.layouts.home')
@section('title', __('frontend/default.pages_titles.signup'))

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 col-d-6 col-sm-12 sm-margin-30px-bottom">
        <div class="create-ac-content bg-light-gray padding-20px-all">
          <form action="{{ route('customer.auth.signup') }}" method="post">
            @csrf
            <h2 class="mb-3">{{ __('frontend/default.general.your_information') }}</h2>
            <x-errors-alert />
            <div class="row">
              <div class="form-group col-12 required">
                <label for="name"> {{ __('frontend/default.form.name') }} <span class="required-f">*</span></label>
                <input name="name" id="name" value="{{ old('name') }}" type="text">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 required">
                <label for="email">{{ __('frontend/default.form.email') }} <span class="required-f">*</span></label>
                <input name="email" id="email" type="email" value="{{ old('email') }}">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 required">
                <label for="phone_number">{{ __('frontend/default.form.phone_number') }} <span
                        class="required-f">*</span></label>
                <input name="phone_number" id="phone_number" type="tel" value="{{ old('phone_number') }}">
                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 required">
                <label for="birth_date">{{ __('frontend/default.form.birth_date') }} <span
                        class="required-f">*</span></label>
                <input name="birth_date" id="birth_date" type="date" value="{{ old('birth_date') }}">
                @error('birth_date')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="form-group col-12 required">
              <label for="password">{{ __('frontend/default.form.password') }} <span class="required-f">*</span></label>
              <input name="password" id="password" type="password">
              @error('password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group col-12 required">
              <label for="password_confirmation">{{ __('frontend/default.form.password_confirmation') }} <span
                      class="required-f">*</span></label>
              <input name="password_confirmation" id="password_confirmation" type="password">
              @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="row">
              <div class="col-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.form.update') }}">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
