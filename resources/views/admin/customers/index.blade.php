@extends('admin.layouts.master')

@section('page_title')
  {{ __('adminDashboard.customers.index.title') }}
@endsection

@push('css')
  <style>
    .table tr td {
      vertical-align: middle;
    }
  </style>
@endpush

@section('content')
  <div class="page-header">
    <div class="card breadcrumb-card">
      <div class="row justify-content-between align-content-between" style="height: 100%;">
        <div class="col-md-6">
          <h3 class="page-title">{{ __('adminDashboard.customers.index.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('users.index') }}">{{ __('adminDashboard.customers.index.title') }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table-hover table-center mb-0 table" id="table">
            <thead>
              <tr>
                <th class="">{{ __('default.table.sl') }}</th>
                <th class="">{{ __('default.table.name') }}</th>
                <th class="">{{ __('default.table.email') }}</th>
                <th class="">{{ __('default.table.phone_number') }}</th>
                <th class="">{{ __('default.table.action') }}</th>
              </tr>
            </thead>

            <tbody>

            </tbody>
          </table>
          <form class="form-inline remove-form d-none" method='POST'>
            <input name="_method" type="hidden" value="DELETE">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection




@push('scripts')
  <script>
    $(function() {
      $('#table').DataTable({
        processing: true,
        responsive: false,
        serverSide: true,
        order: [
          [0, 'desc']
        ],
        ajax: '{{ route('admin.customers.index') }}',
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'email',
            name: 'email'
          },
          {
            data: 'phone_number',
            name: 'phone_number'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ],
      });
    });
  </script>

  <script type="text/javascript">
    $("body").on("click", ".remove-customer", function() {
      console.log('abd');
      var current_object = $(this);
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        type: "error",
        showCancelButton: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
      }, function(result) {
        if (result) {
          var action = current_object.attr('data-action');
          var token = jQuery('meta[name="csrf-token"]').attr('content');
          var id = current_object.attr('data-id');
          const form = $('body').find('.remove-form');
          form.attr('action', action);
          form.submit();
        }
      });
    });
  </script>
@endpush
