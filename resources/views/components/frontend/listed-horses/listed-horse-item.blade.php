<div class="card rounded">
  <div class="product-image card-img-top">
    <a href="{{ $horse->pageUrl }}" style="max-height: 300px" class="d-flex align-items-center">
      @if (count($horse->photos) > 0)
        <img class="{{ count($horse->photos) > 1 ? 'primary' : '' }} blur-up lazyload h-100"
             style="vertical-align: center;" data-src="{{ $horse->photos[0]->fullUrl }}"
             src="{{ $horse->photos[0]->fullUrl }}" alt="image" title="product">
        @if (count($horse->photos) > 1)
          <img class="hover blur-up lazyload" data-src="{{ $horse->photos[1]->fullUrl }}"
               src="{{ $horse->photos[1]->fullUrl }}" alt="image" title="product">
        @endif
      @else
        <div class="w-100 h-100 bg-light p-3">{{ __('default.general.no_preview_images') }}</div>
      @endif

    </a>

    <div class="variants add">
      <a href="{{ $horse->pageUrl }}" class="btn btn--primary w-75"
         type="button">{{ __('default.general.view_details') }}</a>
    </div>
  </div>

  <div class="product-details card-body text-center">
    <div class="product-name">
      <a href="{{ $horse->pageUrl }}">{{ $horse->name }}</a>
    </div>
    <p> {{ __('frontend/default.layout.horses.passport') }}: <b>{{ $horse->passport->name }}</b>
      <br>
      {{ __('frontend/default.layout.horses.type') }}: <b>{{ $horse->type->name }} </b>
    </p>
  </div>
</div>
