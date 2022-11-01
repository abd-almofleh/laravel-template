@extends('frontend.layouts.home')
@section('title', __('login'))

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
        <div class="mb-4">
          <form method="post" action="{{ route('customer.auth.login.attempt') }}" class="contact-form">
            @csrf
            <x-errors-alert />
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="email">{{ __('frontend/default.form.email') }}</label>
                  <input type="email" value="{{ old('email') }}" name="email" id="email"autofocus>
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror


                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="password">{{ __('frontend/default.form.password') }}</label>
                  <input type="password" name="password" id="password">
                </div>
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.general.login') }}">
                <p class="mb-4">
                  <a href="{{ route('customer.auth.forget_password.form') }}"
                     id="RecoverPassword">{{ __('frontend/default.general.forgot_your_password') }}</a>
                  &nbsp; | &nbsp;
                  <a href="register.html" id="customer_register_link">Create account</a>
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
