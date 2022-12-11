<div class="sidebar_widget categories filter-widget">
  <div class="widget-title">
    <h2>{{ __('frontend/default.form.birth_year') }}</h2>
  </div>
  <div class="widget-content">
    <div class="row price-filter">
      <div class="col-4">
        <p class="no-margin"><input id="min-year" min="2000" max="2030"
                 placeholder="{{ __('frontend/default.form.min') }}" type="number"></p>
      </div>
      <div class="col-4">
        <p class="no-margin"><input id="max-year" min="2000" max="2030"
                 placeholder="{{ __('frontend/default.form.max') }}" type="number">
        </p>
      </div>
      <div class="col-4 margin-25px-top text-right">
        <button onclick="handleDateSearch(event)"
                class="btn btn-secondary btn--small">{{ __('frontend/default.form.search') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    function handleDateSearch(event) {
      event.preventDefault();
      const minDateEl = document.querySelector('#min-year');
      const maxDateEl = document.querySelector('#max-year');
      const minValue = minDateEl.value;
      const maxValue = maxDateEl.value;

      const url = new URL('{!! route('listed_horses.list', request()->query()) !!}');
      if (minValue === null || minValue === "")
        url.searchParams.delete('min_birth_year');
      else
        url.searchParams.set('min_birth_year', minValue);

      if (maxValue === null || maxValue === "")
        url.searchParams.delete('max_birth_year');
      else
        url.searchParams.set('max_birth_year', maxValue);
      window.location = url.href;
    }
  </script>
@endpush
