@props(['title' => '', 'author' => '', 'blogUrl' => '#'])
<div class="grid__item">
  <div class="mini-list-item">
    <div class="mini-view_image">
      <a class="grid-view-item__link" href="#">
        <img class="grid-view-item__image blur-up lazyload" data-src="{{ $attributes['image']->previewUrl }}"
             src="{{ $attributes['image']->fullUrl }}" alt="" />
      </a>
    </div>
    <div class="details">
      <a class="grid-view-item__title" href="{{ $blogUrl }}"> {{ $title }}</a>
      <div class="grid-view-item__meta">
        <span class="article__author">{{ $author }}</span>
      </div>
    </div>
  </div>
</div>
