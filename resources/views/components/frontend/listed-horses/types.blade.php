@php
  $types = App\Models\HorseType::all();
@endphp
<div class="sidebar_widget categories filter-widget">
  <div class="widget-title">
    <h2>{{ __('frontend/navigation.footer_list.horses_types') }}</h2>
  </div>
  <div class="widget-content">
    <ul class="sidebar_categories">
      <li class="lvl-1 @if (request()->get('type') === null) active @endif"><a href="{{ route('listed_horses.list') }}"
           class="site-nav lvl-1">{{ __('frontend/default.general.all') }}</a></li>
      @foreach ($types as $type)
        <li class="lvl-1 @if ($type->id == request()->get('type')) active @endif"><a
             href="{{ $type->buildUrl(request()->query()) }}" class="site-nav lvl-1">{{ $type->name }}</a></li>
      @endforeach
    </ul>
  </div>
</div>
