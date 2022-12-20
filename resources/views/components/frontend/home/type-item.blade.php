@props(['type'])
<div class="col-12 item px-2">
  <div class="product-image">
    <a href="{{ $type->buildUrl() }}" class="grid-view-item__link">
      <img class="blur-up lazyload" data-src="{{ $type->photo->fullUrl }}" src="{{ $type->photo->fullUrl }}" alt="image"
           title="product">
  </div>
  </a>
  <div class="product-details text-center">
    <!-- product name -->
    <div class="product-name">
      <a href="{{ $type->buildUrl() }}">{{ $type->name }}</a>
    </div>
  </div>
</div>
