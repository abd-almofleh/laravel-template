@extends('admin.layouts.master')

@section('page_title')
  {{ __('cms.category.edit.title') }}
@endsection

@push('css')
  <style>
    #output {
      width: 100%;
    }
  </style>
@endpush

@section('content')
  <form method="post" action="{{ route('cms.categories.update', $category) }}">
    @csrf()
    @method('PUT')
    <!-- Page Header -->
    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-9">
            <h3 class="page-title">{{ __('cms.category.index.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('cms.categories.index') }}">{{ __('cms.category.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('cms.categories.edit', $category->id) }}">{{ __('cms.category.edit.title') }} -
                  ({{ $category->name_ar }} - {{ $category->name_en }})</a>
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

          <div class="card">

            <div class="card-header">
              <h5 class="card-title"> {{ __('cms.category.cms_category_information') }} - ({{ $category->name_ar }} -
                {{ $category->name_en }})</h5>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="name_ar" class="required">{{ __('default.form.name_ar') }}:</label>
                    <input type="text" name="name_ar" id="name_ar"
                           class="form-control @error('name_ar') form-control-error @enderror" required="required"
                           value="{{ $category->name_ar }}">

                    @error('name_ar')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name_en" class="required">{{ __('default.form.name_en') }}:</label>
                    <input type="text" name="name_en" id="name_en"
                           class="form-control @error('name_en') form-control-error @enderror" required="required"
                           value="{{ $category->name_en }}">

                    @error('name_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status" class="required">{{ __('default.form.status') }}:</label>
                    <select type="text" name="status" id="status"
                            class="form-control @error('status') form-control-error @enderror" required="required">
                      <option value="1" @if ($category->status == '1') selected @endif>
                        {{ __('default.form.active') }}</option>
                      <option value="0" @if ($category->status == '0') selected @endif>
                        {{ __('default.form.inactive') }}</option>
                    </select>

                    @error('status')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                </div> <!-- /col-md-12 -->
              </div> <!-- /row -->
            </div> <!-- /card-body-finish -->

          </div> <!-- card-finish -->

        </div> <!-- /col-md-12 -->
      </div> <!-- row-finish -->
    </section> <!-- card-body-finish -->

  </form>
@endsection
