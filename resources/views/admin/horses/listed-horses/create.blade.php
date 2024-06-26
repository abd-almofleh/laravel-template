@extends('admin.layouts.master')

@section('page_title')
  {{ __('listedHorses.create.title') }}
@endsection

@push('css')
  <style>
    #output {
      width: 100%;
    }
  </style>
@endpush
@section('content')
  <form method="POST" action="{{ route('horses.listed-horses.store') }}" enctype="multipart/form-data">
    @csrf()

    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-6">
            <h3 class="page-title">{{ __('listedHorses.index.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('horses.listed-horses.index') }}">{{ __('listedHorses.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('horses.listed-horses.create') }}">{{ __('listedHorses.create.title') }}</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <button type="submit" class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="crud-body">
      <div class="row">
        <div class="col-md-12">

          <div class="card">

            <div class="card-header">
              <h5 class="card-title">
                {{ __('listedHorses.create.header') }}
              </h5>
            </div>

            <div class="card-body">
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

              <div class="row">
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="name" class="required">{{ __('default.form.name') }}:</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') form-control-error @enderror" required="required"
                           value="{{ old('name') }}">

                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="gender" class="required">{{ __('default.form.gender') }}:</label>
                    <select type="text" name="gender" id="gender"
                            class="form-control @error('gender') form-control-error @enderror" required="required">
                      @foreach (\App\Enums\HorseGender::values() as $gender)
                        <option value="{{ $gender }}" @if (old('gender') == $gender) selected @endif>
                          {{ __("default.gender.$gender") }}
                        </option>
                      @endforeach
                    </select>

                    @error('gender')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="type_id" class="required">{{ __('default.form.type') }}:</label>

                    <select type="text" name="type_id" id="type_id"
                            class="form-control @error('type_id') form-control-error @enderror" required="required">

                      <option value="">{{ __('default.form.choose_horse_type') }}</option>
                      @foreach ($horsesTypes as $horsesType)
                        <option value="{{ $horsesType->id }}" @if (old('type_id') == $horsesType->id) selected @endif>
                          {{ $horsesType->name_en }} - {{ $horsesType->name_ar }}</option>
                      @endforeach

                    </select>

                    @error('type_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="race" class="required">{{ __('default.form.race') }}:</label>
                    <input type="text" name="race" id="race"
                           class="form-control @error('race') form-control-error @enderror" required="required"
                           value="{{ old('race') }}">

                    @error('race')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="birth_year" class="required">{{ __('default.form.birth_year') }}:</label>

                    <select type="text" name="birth_year" id="birth_year"
                            class="form-control @error('birth_year') form-control-error @enderror" required="required">

                      <option value="">{{ __('default.form.choose_birth_year') }}</option>
                      @for ($i = config('constants.horse_birth_year.end'); $i >= config('constants.horse_birth_year.start'); $i--)
                        <option value="{{ $i }}" @if (old('birth_year') == $i) selected @endif>
                          {{ $i }}</option>
                      @endfor

                    </select>

                    @error('birth_year')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="passport_type_id" class="required">{{ __('default.form.passport') }}:</label>
                    <select type="text" name="passport_type_id" id="passport_type_id"
                            class="form-control @error('passport_type_id') form-control-error @enderror"
                            required="required">

                      <option value="">{{ __('default.form.choose_horse_passport') }}</option>
                      @foreach ($horsesPassports as $horsesPassport)
                        <option value="{{ $horsesPassport->id }}" @if (old('passport_type_id') == $horsesPassport->id) selected @endif>
                          {{ $horsesPassport->name_en }} - {{ $horsesPassport->name_ar }}</option>
                      @endforeach

                    </select>

                    @error('passport_type_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="height" class="required">{{ __('default.form.height') }}:</label>
                    <div class="input-group">
                      <input type="number" step="0.1" name="height" id="height"
                             class="form-control @error('height') form-control-error @enderror" required="required"
                             value="{{ old('height') }}">
                      <span class="input-group-text">{{ __('default.form.meter') }}</span>
                    </div>

                    @error('height')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="color" class="required">{{ __('default.form.color') }}:</label>
                    <input type="text" name="color" id="color"
                           class="form-control @error('color') form-control-error @enderror" required="required"
                           value="{{ old('color') }}">

                    @error('color')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="health" class="required">{{ __('default.form.health') }}:</label>
                    <input type="text" name="health" id="health"
                           class="form-control @error('health') form-control-error @enderror" required="required"
                           value="{{ old('health') }}">

                    @error('health')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="contact_number" class="required">{{ __('default.form.contact_number') }}:
                      (9715XXXXXXXX)</label>
                    <input type="tel" name="contact_number" id="contact_number"
                           class="form-control @error('contact_number') form-control-error @enderror"
                           required="required" value="{{ old('contact_number') }}">

                    @error('contact_number')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="location">{{ __('default.form.location') }}:</label>
                    <input type="text" name="location" id="location"
                           class="form-control @error('location') form-control-error @enderror"
                           value="{{ old('location') }}">

                    @error('location')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description" class="required">{{ __('default.form.description') }}:</label>
                    <textarea name="description" id="description" rows="10"
                              class="form-control @error('description') form-control-error @enderror">{{ old('description') }}</textarea>

                    @error('description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group @error('photos') has-error @enderror">
                    <label for="photos">{{ __('default.form.photos') }}:</label>
                    <div class="needsclick dropzone" id="photos-dropzone">
                    </div>
                    @error('photos')
                      <span class="help-block" role="alert">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group @error('videos') has-error @enderror">
                    <label for="videos">{{ __('default.form.videos') }}</label>
                    <div class="needsclick dropzone" id="videos-dropzone">
                    </div>
                    @error('videos')
                      <span class="help-block" role="alert">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
              </div>
            </div>
          </div> <!-- end card -->

          <div class="card">

            <div class="card-header">
              <h4 class="card-name">{{ __('default.form.seo_information') }}</h4>
            </div>

            <div class="card-body">
              <div class="row">

                <div class="col-md-12">

                  <div class="form-group">
                    <label for="meta_title" class="required">{{ __('default.form.meta_title') }}:</label>
                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                           value="{{ old('meta_title') }}" required>

                    @error('meta_title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="meta_description" class="required">{{ __('default.form.meta_description') }}:</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="10">{{ old('meta_description') }}</textarea>

                    @error('meta_keywords')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="meta_keywords" class="required">{{ __('default.form.meta_keywords') }}:
                      ({{ __('default.form.comma_suppurated') }})</label>
                    <input type="text" class="form-control" name="meta_keywords"
                           value="{{ old('meta_keywords') }}" id="meta_keywords" required>

                    @error('meta_keywords')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
@endsection


@push('scripts')
  <script>
    Dropzone.options.photosDropzone = {
      url: '{{ route('horses.listed-horses.storeMedia') }}',
      maxFilesize: 2, // MB
      acceptedFiles: '.jpeg,.jpg,.png,.gif',
      maxFiles: 10,
      addRemoveLinks: true,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      params: {
        size: 2,
        width: 4096,
        height: 4096
      },
      success: function(file, response) {
        $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      },
      removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
          $('form').find(`input[name="photos[]"][value="${JSON.parse(file.xhr.response).name}"]`).remove()
          this.options.maxFiles = this.options.maxFiles + 1
        }
      },
      init: function() {
        @if (isset($product) && $product->photo)
          var file = {!! json_encode($product->photo) !!}
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
          this.options.maxFiles = this.options.maxFiles - 1
        @endif
      },
      error: function(file, response) {
        if ($.type(response) === 'string') {
          var message = response //dropzone sends it's own error messages in string
        } else {
          var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          node = _ref[_i]
          _results.push(node.textContent = message)
        }

        return _results
      }
    }
    Dropzone.options.videosDropzone = {
      url: '{{ route('horses.listed-horses.storeMedia') }}',
      maxFilesize: 30, // MB
      acceptedFiles: '.mp4,.mkv',
      maxFiles: 10,
      addRemoveLinks: true,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      params: {
        size: 30,
      },
      success: function(file, response) {
        $('form').append('<input type="hidden" name="videos[]" value="' + response.name + '">')
      },
      removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
          $('form').find(`input[name="videos[]"][value="${JSON.parse(file.xhr.response).name}"]`).remove()
          this.options.maxFiles = this.options.maxFiles + 1
        }
      },
      init: function() {
        @if (isset($product) && $product->photo)
          var file = {!! json_encode($product->photo) !!}
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="videos[]" value="' + file.file_name + '">')
          this.options.maxFiles = this.options.maxFiles - 1
        @endif
      },
      error: function(file, response) {
        if ($.type(response) === 'string') {
          var message = response //dropzone sends it's own error messages in string
        } else {
          var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          node = _ref[_i]
          _results.push(node.textContent = message)
        }

        return _results
      }
    }
  </script>
@endpush
