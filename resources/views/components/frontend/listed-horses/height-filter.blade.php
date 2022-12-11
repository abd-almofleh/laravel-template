<div class="sidebar_widget categories filter-widget">
  <div class="widget-title">
    <h2>{{ __('frontend/default.form.height') }}</h2>
  </div>
  <div class="widget-content">
    <div class="row height-filter">
      <div class="col-4">
        <p class="no-margin">
          <input id="min-height" min="1" step="0.1" max="3" value="{{ request()->query('min_height') }}"
                 placeholder="{{ __('frontend/default.form.min') }}" type="number">
        </p>
      </div>
      <div class="col-4">
        <p class="no-margin">
          <input id="max-height" min="1" step="0.1" max="3"
                 value="{{ request()->query('max_height') }}" placeholder="{{ __('frontend/default.form.max') }}"
                 type="number">
        </p>
      </div>
      <div class="col-4 margin-25px-top text-right">
        <button onclick="handleHeightSearch(event)"
                class="btn btn-secondary btn--small">{{ __('frontend/default.form.search') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    function handleHeightSearch(event) {
      event.preventDefault();
      const minHeightEl = document.querySelector('#min-height');
      const maxHeightEl = document.querySelector('#max-height');
      const minValue = minHeightEl.value;
      const maxValue = maxHeightEl.value;

      const url = new URL('{!! route('listed_horses.list', request()->query()) !!}');
      if (minValue === null || minValue === "")
        url.searchParams.delete('min_height');
      else
        url.searchParams.set('min_height', minValue);

      if (maxValue === null || maxValue === "")
        url.searchParams.delete('max_height');
      else
        url.searchParams.set('max_height', maxValue);
      window.location = url.href;
    }
  </script>
@endpush
