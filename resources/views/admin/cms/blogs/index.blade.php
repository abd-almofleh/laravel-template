@extends('admin.layouts.master')

@section('page_title')
  {{ __('cms.blogs.index.title') }}
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
          <h3 class="page-title">{{ __('cms.blogs.index.title') }}</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a>
            </li>
            <li class="breadcrumb-item active-breadcrumb">
              <a href="{{ route('cms.blogs.index') }}">{{ __('cms.blogs.index.title') }}</a>
            </li>
          </ul>
        </div>
        @can('cms.blogs:create')
          <div class="col-md-3">
            <div class="create-btn pull-right">
              <a href="{{ route('cms.blogs.create') }}"
                 class="btn custom-create-btn">{{ __('cms.blogs.form.add-button') }}</a>
            </div>
          </div>
        @endcan
      </div>
    </div><!-- /card finish -->
  </div><!-- /Page Header -->

  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-body">
          <table class="table-hover table-center mb-0 table" id="table">
            <thead>
              <tr>
                <th class="">{{ __('default.table.sl') }}</th>
                <th class="">{{ __('default.table.title') }}</th>
                <th class="">{{ __('default.table.slug') }}</th>
                <th class="">{{ __('default.table.category') }}</th>
                <th class="">{{ __('default.table.status') }}</th>

                @if (auth()->user()->can('cms.blogs:edit') ||
                    auth()->user()->can('cms.blogs:delete'))
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
        ajax: '{{ route('cms.blogs.index') }}',
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'title_en',
            name: 'title'
          },
          {
            data: 'slug',
            name: 'slug'
          },
          {
            data: 'category.name',
            name: 'category'
          },
          {
            data: 'status',
            name: 'status'
          },

          @if (auth()->user()->can('cms.blogs:edit') ||
              auth()->user()->can('cms.blogs:delete'))
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
    $("body").on("click", ".remove-cmspage", function() {
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
          $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
          $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
          $('body').find('.remove-form').submit();
        }
      });
    });
  </script>

  {{-- 
  <script type="text/javascript">
    function changeCmsBlogStatus(_this, id) {
      var status = $(_this).prop('checked') == true ? 1 : 0;
      let _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: `{{ route('cms.blogs.status_update', '') }}/${id}`,
        type: 'post',
        data: {
          _token: _token,
          _method: "patch",
          status: status
        },
        success: function(result) {
          if (status == 1) {
            toastr.success(result.message);
          } else {
            toastr.error(result.message);
          }
        }
      });
    }
  </script> --}}
@endpush
