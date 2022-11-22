@php
  $user = Auth()
      ->guard(App\Http\Controllers\Frontend\Customer\AuthCustomerController::$guard)
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
    <div class="row mt-4">
      <div class="col-12 col-lg-6 col-d-6 col-sm-12 sm-margin-30px-bottom">
        <div class="create-ac-content bg-light-gray padding-20px-all">
          <h2 class="mb-3">{{ __('frontend/default.general.delete_profile') }}</h2>
          <div class="row">
            <div class="col-12 text-center">
              <button id="delete-account-button" class="btn bg-danger mb-3">
                {{ __('frontend/default.form.delete_account') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form id="delete-account" action="{{ route('customer.auth.account.delete') }}" method="POST">
    @csrf
    @method('DELETE')
  </form>

@endsection

@push('scripts')
  <script type="text/javascript">
    $("body").on("click", "#delete-account-button", function() {
      var current_object = $(this);
      Swal.fire({
        titleText: "Are you sure?",
        text: "You will not be able to recover this data!",
        icon: "error",
        focusCancel: true,
        showCancelButton: true,
        cancelButtonColor: '#0e9519',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
      }).then(function({
        isConfirmed
      }) {
        if (isConfirmed) {
          $('body').find('#delete-account').submit();
        }
      });
    });
  </script>
@endpush
