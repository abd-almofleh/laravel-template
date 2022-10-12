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
    <!-- Page Header -->
    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-6">
            <h3 class="page-title">{{ __('horsesType.index.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('horses.types.index') }}">{{ __('horsesType.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('horses.types.edit', $type->id) }}">{{ __('horsesType.edit.title') }} -
                  ({{ $type->name }})</a>
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
              <h5 class="card-title"> {{ __('horsesType.edit.header') }} - ({{ $type->name }})</h5>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="name" class="required">{{ __('default.form.name') }}:</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') form-control-error @enderror" required="required"
                           value="{{ $type->name }}">

                    @error('name')
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

                </div> <!-- /col-md-12 -->
              </div> <!-- /row -->
            </div> <!-- /card-body-finish -->

          </div> <!-- card-finish -->

        </div> <!-- /col-md-12 -->
      </div> <!-- row-finish -->
    </section> <!-- card-body-finish -->
  </form>
@endsection
