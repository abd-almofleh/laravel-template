@props(['type'])
<div class="col-12 item px-2">
  <div class="card rounded shadow-sm">

    <a href="{{ $type->buildUrl() }}" class="product-image card-img-top grid-view-item__link">
      <img class="blur-up lazyload" style="max-height: 250px" data-src="{{ $type->photo->fullUrl }}"
           src="{{ $type->photo->fullUrl }}" alt="image" title="product">
    </a>
    <div class="product-details card-body text-center">
      <!-- product name -->
      <div class="product-name">
        <a href="{{ $type->buildUrl() }}">{{ $type->name }}</a>
      </div>
    </div>
  </div>
</div>
