@extends('frontend.layouts.home')
@section('title', __('frontend/default.general.new_password'))

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
        <div class="mb-4">
          <form method="post" action="{{ route('customer.auth.reset_password.new_password') }}" class="contact-form">
            @csrf
            <x-errors-alert />
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
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <input type="submit" class="btn mb-3" value="{{ __('frontend/default.general.reset') }}">
              </div>
            </div>
          </form>
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
