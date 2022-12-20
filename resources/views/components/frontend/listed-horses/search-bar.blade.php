<div class="custom-search">
  <form onsubmit="handelQuerySubmit(event)" class="input-group search-header search" role="search"
        style="position: relative;">
    <input class="search-header__input search__input input-group__field" value="{{ request()->query('query') }}"
           type="search" id="search-listed-horses" name="query" placeholder="{{ __('frontend/default.form.search') }}"
           aria-label="Search" autocomplete="off">
    <span class="input-group__btn">
      <button class="btnSearch" type="submit">
        <i class="icon fa-solid fa-magnifying-glass"></i>
      </button>
    </span>
  </form>
</div>


@push('scripts')
  <script>
    function handelQuerySubmit(event) {
      event.preventDefault();
      const searchEl = document.querySelector('#search-listed-horses');
      const query = searchEl.value.trim();

      const url = new URL('{!! route('listed_horses.list', request()->query()) !!}');
      if (query === null || query === "")
        url.searchParams.delete('query');
      else
        url.searchParams.set('query', query);

      window.location = url.href;
    }
  </script>
@endpush
