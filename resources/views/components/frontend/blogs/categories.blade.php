@php
  $categories = App\Models\CmsCategory::all();
@endphp
<div class="sidebar_widget categories">
  <div class="widget-title">
    <h2>Categories</h2>
  </div>
  <div class="widget-content">
    <ul class="sidebar_categories">
      <li class="lvl-1 @if (request()->get('category') === null) active @endif"><a href="{{ route('blogs.list') }}"
           class="site-nav lvl-1">{{ __('frontend/default.general.all') }}</a></li>
      @foreach ($categories as $category)
        <li class="lvl-1 @if ($category->name == request()->get('category')) active @endif"><a href="{{ $category->url }}"
             class="site-nav lvl-1">{{ $category->name }}</a></li>
      @endforeach
    </ul>
  </div>
</div>
