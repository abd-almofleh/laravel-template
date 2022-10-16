@extends('admin.layouts.master')

@section('page_title')
  {{ __('listedHorses.index.title') }}
@endsection

@push('css')
  <style>
    .table tr td {
      vertical-align: middle;
    }
  </style>
@endpush

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <div class="card breadcrumb-card">
      <div class="row justify-content-between align-content-between" style="height: 100%;">
        <div class="col-md-6">
          <h3 class="page-title">{{ __('listedHorses.index.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('horses.listed-horses.index') }}">{{ __('listedHorses.index.title') }}</a>
            </li>
          </ul>
        </div>
        @if (Auth::user()->can('listedHorses-create'))
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <a href="{{ route('horses.listed-horses.create') }}"
                 class="btn custom-create-btn">{{ __('listedHorses.form.add-button') }}</a>
            </div>
          </div>
        @endif
      </div>
    </div><!-- /card finish -->
  </div><!-- /Page Header -->

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-body">
          <table class="table-hover table-center w-100 mb-0 table" id="table">
            <thead>
              <tr>
                <th class="">{{ __('default.table.sl') }}</th>
                <th class="">{{ __('default.table.id') }}</th>
                <th class="">{{ __('default.table.is_deleted') }}</th>
                <th class="">{{ __('default.table.name') }}</th>
                <th class="">{{ __('default.table.sex') }}</th>
                <th class="">{{ __('default.table.type') }}</th>
                <th class="">{{ __('default.table.contact_number') }}</th>
                @if (Auth::user()->can('listedHorses-edit'))
                  <th class="">{{ __('default.table.action') }}</th>
                @endif
              </tr>
            </thead>

            <tbody>

            </tbody>
          </table>
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
        ajax: '{{ route('horses.listed-horses.index') }}',
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'id',
            name: 'id'
          },
          {
            data: 'is_deleted',
            name: 'is_deleted'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'sex_text',
            name: 'sex'
          },
          {
            data: 'type',
            name: 'type'
          },
          {
            data: 'contact_number',
            name: 'contact_number'
          },

          @if (Auth::user()->can('horsePassport-edit'))
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searchable: false
            }
          @endif
        ],
      });
    });
  </script>

  <script type="text/javascript">
    $("body").on("click", ".remove-listed-horse", function() {
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

          $('body').html("<form class='form-inline remove-form' method='POST' action='" + action + "'></form>");
          $('body').find('.remove-form').append('<input name="_method" type="hidden" value="DELETE">');
          $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
          $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
          $('body').find('.remove-form').submit();
        }
      });
    });
  </script>
@endpush
