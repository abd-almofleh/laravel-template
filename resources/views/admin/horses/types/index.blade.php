@extends('admin.layouts.master')

@section('page_title')
  {{ __('horsesType.index.title') }}
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
          <h3 class="page-title">{{ __('horsesType.index.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('horses.types.index') }}">{{ __('horsesType.index.title') }}</a>
            </li>
          </ul>
        </div>
        @if (Auth::user()->can('horseType-create'))
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <a href="{{ route('horses.types.create') }}"
                 class="btn custom-create-btn">{{ __('horsesType.form.add-button') }}</a>
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
                <th class="">{{ __('default.table.name') }}</th>
                <th class="">{{ __('default.table.status') }}</th>
                @if (Auth::user()->can('horseType-edit'))
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
        ajax: '{{ route('horses.types.index') }}',
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'status',
            name: 'status'
          },

          @if (Auth::user()->can('horseType-edit'))
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
    function changeHorseTypeStatus(_this, id) {
      var status = $(_this).prop('checked') == true ? 1 : 0;
      let _token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: `{{ route('horses.types.updateStatus', '') }}/${id}`,
        type: 'POST',
        data: {
          _token: _token,
          _method: 'PATCH',
          status: status
        },
        success: function(result) {
          console.log(`🚀 - file: index.blade.php - line 121 - result`, result);
          if (result.status === 'success') {
            toastr.success(result.message);
          } else {
            toastr.error(result.message);
          }
        }
      });
    }
  </script>
@endpush
