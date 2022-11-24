@extends('admin.layouts.master')

@section('page_title')
  {{ __('horsesType.edit.title') }}
@endsection

@push('css')
  <style>
    #output {
      width: 100%;
    }
  </style>
@endpush

@section('content')
  <form method="post" action="{{ route('horses.types.update', $type->id) }}">
    @csrf()
    @method('PUT')

    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-9">
            <h3 class="page-title">{{ __('horsesType.edit.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('horses.types.index') }}">{{ __('horsesType.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('horses.types.edit', $type->id) }}">{{ __('horsesType.edit.title') }} -
                  ({{ $type->name_en }} - {{ $type->name_ar }})</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <button type="submit" class="btn custom-create-btn">{{ __('default.form.update-button') }}</button>
            </div>
          </div>
        </div>
      </div><!-- /card finish -->
    </div><!-- /Page Header -->

    <section class="crud-body">
      <div class="row">
        <div class="col-md-12">
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
          <div class="card">
            <div class="card-header">
              <h5 class="card-title"> {{ __('horsesType.edit.header') }} - ({{ $type->name_en }} -
                {{ $type->name_ar }})</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="name_ar" class="required">{{ __('default.form.name_ar') }}:</label>
                    <input type="text" name="name_ar" id="name_ar"
                           class="form-control @error('name_ar') form-control-error @enderror" required="required"
                           value="{{ $type->name_ar }}">

                    @error('name_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="name_en" class="required">{{ __('default.form.name_en') }}:</label>
                    <input type="text" name="name_en" id="name_en"
                           class="form-control @error('name_en') form-control-error @enderror" required="required"
                           value="{{ $type->name_en }}">

                    @error('name_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status" class="required">{{ __('default.form.status') }}:</label>
                    <select type="text" name="status" id="status"
                            class="form-control @error('status') form-control-error @enderror" required="required">
                      <option value="1" @if ($type->status == '1') selected @endif>
                        {{ __('default.form.active') }}</option>
                      <option value="0" @if ($type->status == '0') selected @endif>
                        {{ __('default.form.inactive') }}</option>
                    </select>

                    @error('status')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group @error('photo') has-error @enderror">
                    <label for="photo">{{ __('default.form.photo') }}:</label>
                    <div class="needsclick dropzone" id="photo-dropzone">
                    </div>
                    @error('photo')
                      <span class="text-danger" role="alert">{{ $message }}</span>
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
    Dropzone.options.photoDropzone = {
      url: '{{ route('horses.types.storeMedia') }}',
      maxFilesize: 2, // MB
      acceptedFiles: '.jpeg,.jpg,.png,.gif',
      maxFiles: 1,
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
        $('form').find('input[name="photo"]').remove()
        $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
      },
      removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
          $('form').find('input[name="photo"]').remove()
          this.options.maxFiles = this.options.maxFiles + 1
        }
      },
      init: function() {
        @if (isset($type) && $type->photo)
          const file = {!! json_encode($type->photo) !!}
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
