@if ($errors->any())
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">{{ __('default.form.error') }}</h4>
    <p>{{ __('default.form.following_error_exits') }}:</p>
    <hr class="border-danger">
    <ul class="ms-3">
      @foreach ($errors->all() as $error)
        <li class="mb-0">{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
