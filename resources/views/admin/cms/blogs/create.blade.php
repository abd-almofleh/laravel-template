@extends('admin.layouts.master')

@section('page_title')
  {{ __('cms.blogs.create.title') }}
@endsection

@push('css')
  <style>
    #output {
      width: 100%;
    }
  </style>
@endpush

@section('content')
  <form method="POST" action="{{ route('cms.blogs.store') }}" enctype="multipart/form-data">
    @csrf()
    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-6">
            <h3 class="page-title">{{ __('cms.blogs.index.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('cms.blogs.index') }}">{{ __('cms.blogs.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('cms.blogs.create') }}">{{ __('cms.blogs.create.title') }}</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <button type="submit" class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
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
              <h5 class="card-title">
                {{ __('cms.blogs.general_information') }}
              </h5>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="cms_category_id">{{ __('default.form.category') }}:</label>

                    <select type="text" name="cms_category_id" id="cms_category_id"
                            class="form-control @error('cms_category_id') form-control-error @enderror">

                      <option value="">{{ __('cms.blogs.choose_blog_category') }}</option>
                      @foreach ($cms_categories as $cms_category)
                        <option value="{{ $cms_category->id }}" @if (old('cms_category_id') == $cms_category->id) selected @endif>
                          {{ $cms_category->name }}</option>
                      @endforeach
                    </select>

                    @error('cms_category_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status">{{ __('default.form.status') }}:</label>

                    <select type="text" name="status" id="status"
                            class="form-control @error('status') form-control-error @enderror">
                      <option value="1" @if (old('status') == 1) selected @endif>
                        {{ __('default.form.published') }}</option>
                      <option value="0" @if (old('status', 0) == 0) selected @endif>
                        {{ __('default.form.draft') }}</option>
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

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                {{ __('cms.blogs.arabic_information') }}
              </h5>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="title_ar">{{ __('default.form.title_ar') }}:</label>
                    <input type="text" name="title_ar" id="title_ar" dir="rtl"
                           class="form-control @error('title_ar') form-control-error @enderror"
                           value="{{ old('title_ar') }}">

                    @error('title_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description_ar">{{ __('default.form.description_ar') }}:</label>
                    <textarea name="description_ar" id="description_ar" rows="20"
                              class="form-control @error('description_ar') form-control-error @enderror">{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                {{ __('cms.blogs.english_information') }}
              </h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="title_en">{{ __('default.form.title_en') }}:</label>
                    <input type="text" name="title_en" id="title_en"
                           class="form-control @error('title_en') form-control-error @enderror"
                           value="{{ old('title_en') }}">

                    @error('title_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description_en">{{ __('default.form.description_en') }}:</label>
                    <textarea name="description_en" id="description_en" rows="20"
                              class="form-control @error('description_en') form-control-error @enderror">{{ old('description_en') }}</textarea>

                    @error('description_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-name">{{ __('default.form.seo_information') }}</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="meta_title_en">{{ __('default.form.meta_title_en') }}</label>
                    <input type="text" class="form-control" name="meta_title_en" id="meta_title_en"
                           value="{{ old('meta_title_en') }}">
                    @error('meta_title_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="meta_title_ar">{{ __('default.form.meta_title_ar') }}</label>
                    <input type="text" class="form-control" name="meta_title_ar" id="meta_title_ar"
                           value="{{ old('meta_title_ar') }}">

                    @error('meta_title_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="meta_description_en">{{ __('default.form.meta_description_en') }}</label>
                    <textarea name="meta_description_en" id="meta_description_en" class="form-control" rows="10">{{ old('meta_description_en') }}</textarea>

                    @error('meta_description_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="meta_description_ar">{{ __('default.form.meta_description_ar') }}</label>
                    <textarea name="meta_description_ar" id="meta_description_ar" class="form-control" rows="10">{{ old('meta_description_ar') }}</textarea>

                    @error('meta_description_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="meta_keywords_en">{{ __('default.form.meta_keywords_en') }}</label>
                    <input type="text" class="form-control" name="meta_keywords_en" id="meta_keywords_en"
                           value="{{ old('meta_keywords_en') }}">

                    @error('meta_keywords_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="meta_keywords_ar">{{ __('default.form.meta_keywords_ar') }}</label>
                    <input type="text" class="form-control" name="meta_keywords_ar" id="meta_keywords_ar"
                           value="{{ old('meta_keywords_ar') }}">

                    @error('meta_keywords_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                </div><!-- end col-md-12 -->
              </div><!-- end row -->
            </div> <!-- end card body -->

          </div> <!-- end card -->

        </div>
      </div>
    </section>

  </form>
@endsection


@push('scripts')
  <script>
    tinymce.init({
      selector: '#description_ar',
      browser_spellcheck: true,
      paste_data_images: false,
      directionality: 'rtl',

      responsive: true,
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools",
        "autosave codesample directionality wordcount"
      ],

      toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media| fullscreen preview code | codesample charmap ltr rtl",

      content_style: 'body { font-family:Poppins",sans-serif;}',
      imagetools_toolbar: "imageoptions",

      file_picker_callback(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0]
          .clientWidth
        let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[
          0].clientHeight

        tinymce.activeEditor.windowManager.openUrl({
          url: '/file-manager/tinymce5',
          title: 'File manager',
          width: x * 0.8,
          height: y * 0.8,
          onMessage: (api, message) => {
            callback(message.content, {
              text: message.text
            })
          }
        })
      }
    });

    tinymce.init({
      selector: '#description_en',
      browser_spellcheck: true,
      paste_data_images: false,
      responsive: true,
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools",
        "autosave codesample directionality wordcount"
      ],

      toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media| fullscreen preview code | codesample charmap ltr rtl",

      content_style: 'body { font-family:Poppins",sans-serif;}',
      imagetools_toolbar: "imageoptions",

      file_picker_callback(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0]
          .clientWidth
        let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[
          0].clientHeight

        tinymce.activeEditor.windowManager.openUrl({
          url: '/file-manager/tinymce5',
          title: 'File manager',
          width: x * 0.8,
          height: y * 0.8,
          onMessage: (api, message) => {
            callback(message.content, {
              text: message.text
            })
          }
        })
      }
    });
  </script>

  <script>
    Dropzone.options.photoDropzone = {
      url: '{{ route('cms.blogs.storeMedia') }}',
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
      init: function() {},
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
  <script type="text/javascript">
    $("#title_en").change(function() {
      var title = this.value;
      title = title.trim().replace(/\s\s+/g, ' ').toLowerCase();
      title = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
      $("#slug").val(title);
    })
  </script>
@endpush
