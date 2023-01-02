@extends('admin.layouts.master')

@section('page_title')
  {{ __('adminDashboard.customers.edit.title') }}
@endsection

@push('css')
  <style>
    #output {
      height: 300px;
      width: 300px;
    }
  </style>
@endpush

@section('content')
  <form method="POST" action="{{ route('admin.customers.update', $customer) }}" enctype="multipart/form-data">
    @csrf()
    @method('PUT')

    <div class="page-header">
      <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
          <div class="col-md-6">
            <h3 class="page-title">{{ __('adminDashboard.customers.edit.title') }}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('admin.customers.index') }}">{{ __('adminDashboard.customers.index.title') }}</a>
              </li>
              <li class="breadcrumb-item active-breadcrumb">
                <a href="{{ route('admin.customers.edit', $customer) }}">{{ __('adminDashboard.customers.edit.title') }} -
                  ({{ $customer->name }})</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <button type="submit" class="btn custom-create-btn">{{ __('default.form.update-button') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                {{ $customer->name }}, Personal Information
              </h5>
            </div>

            <div class="card-body">
              <div class="form-group">
                <label for="name" class="required">{{ __('default.form.name') }}:</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') form-control-error @enderror" required="required"
                       value="{{ $customer->name }}">

                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="phone_number" class="required">{{ __('default.form.phone_number') }}:</label>
                <input type="tel" name="phone_number" id="phone_number"
                       class="form-control @error('phone_number') form-control-error @enderror"
                       value="{{ $customer->phone_number }}">

                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="birth_date" class="required">{{ __('default.form.birth_date') }}</label>
                <input name="birth_date" id="birth_date" type="date"
                       class="form-control @error('phone_number') form-control-error @enderror"
                       value="{{ $customer->birth_date ? $customer->birth_date->format('Y-m-d') : null }}">
                @error('birth_date')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">{{ __('default.form.email') }}:</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') form-control-error @enderror" value="{{ $customer->email }}">

                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection


@push('scripts')
  <script></script>
@endpush
