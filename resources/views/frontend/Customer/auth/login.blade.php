@extends('frontend.layouts.home')
@section('title', __('login'))

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
        <div class="mb-4">
          <form method="post" action="{{ route('customer.auth.login.attempt') }}" class="contact-form">
            @csrf
            <div class="row">
              @if ($errors->any())
                <div class="row">
                  <div class="col-md-12">
                    <div class="custom-alert alert-danger">
                      <h4 class="alert-heading">{{ __('default.form.error') }}</h4>
                      <p>{{ __('default.form.following_error_exits') }}:</p>
                      <hr>
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li class="mb-0">{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              @endif
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" value="{{ old('email') }}" name="email" id="CustomerEmail"autofocus>
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror


                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password">
                </div>
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <input type="submit" class="btn mb-3" value="Sign In">
                <p class="mb-4">
                  <a href="#" id="RecoverPassword">Forgot your password?</a> &nbsp; | &nbsp;
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
