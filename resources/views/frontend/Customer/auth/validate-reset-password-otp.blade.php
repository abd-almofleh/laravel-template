@extends('frontend.layouts.home')
@section('title', __('frontend/default.general.verify_reset_password'))

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
        <div class="mb-4">
          <form method="post" action="{{ route('customer.auth.reset_password.validate') }}" class="contact-form">
            @csrf
            @form_hidden("email",$email)
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
              </div>
            </div>
          </form>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 text-center">
            <button id="resend-otp" style="border: 0;">{{ __('frontend/default.general.resend_otp') }}</button>
            &nbsp; | &nbsp;
            <a href="{{ route('customer.auth.account.validate_phone_number.change_phone_number.view') }}"
               id="change-phone-number">{{ __('frontend/default.general.change_phone_number') }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

@push('scripts')
  <script>
    $('#resend-otp').on('click', (e) => {
      e.preventDefault();
      $.ajax({
        url: '{{ route('customer.auth.account.validate_phone_number.request') }}',
        type: "POST",
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(data) {
          toastr.success(`${data.message} (${data.data.phone_number})`);
        },
      });
    });
  </script>
@endpush
