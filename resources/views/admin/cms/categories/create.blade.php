@extends('admin.layouts.master')

@section('page_title')
  {{ __('cms.category.create.title') }}
@endsection

@push('css')
  <style>
    #output {
      width: 100%;
    }
  </style>
@endpush

@section('content')
  <form method="POST" action="{{ route('cms.categories.store') }}">
    @csrf()
    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-9">
            <h3 class="page-title">{{ __('cms.category.index.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
              <li class="breadcrumb-item">
                <a href="{{ route('cms.categories.index') }}">{{ __('cms.category.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('cms.categories.create') }}">{{ __('cms.category.create.title') }}</a>
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
              <h5 class="card-title"> {{ __('cms.category.cms_category_information') }} </h5>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="name_ar" class="required">{{ __('default.form.name_ar') }}:</label>
                    <input type="text" name="name_ar" id="name_ar"
                           class="form-control @error('name_ar') form-control-error @enderror" required="required"
                           value="{{ old('name_ar') }}">

                    @error('name_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name_en" class="required">{{ __('default.form.name_en') }}:</label>
                    <input type="text" name="name_en" id="name_en"
                           class="form-control @error('name_en') form-control-error @enderror" required="required"
                           value="{{ old('name_en') }}">

                    @error('name_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status" class="required">{{ __('default.form.status') }}:</label>
                    <select type="text" name="status" id="status"
                            class="form-control @error('status') form-control-error @enderror" required="required">
                      <option value="1">{{ __('default.form.active') }}</option>
                      <option value="0">{{ __('default.form.inactive') }}</option>
                    </select>

                    @error('status')
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
