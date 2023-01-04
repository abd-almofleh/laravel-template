<div {{ $attributes->merge(['class' => 'article']) }}>
  <div class="card rounded">

    <a class="article_featured-image card-img-top" href="{{ $blog->pageUrl }}">
      <img class="blur-up lazyload" data-src="{{ $blog->photo->url }}" src="{{ $blog->photo->preview }}"
           alt="It's all about how you wear">
    </a>
    <div class="card-body">

      <h2 class="h3"><a href="{{ $blog->pageUrl }}">{{ $blog->title }}</a></h2>
      <ul class="publish-detail">
        <li><i class="fa fa-user app-text-primary" aria-hidden="true"></i> {{ $blog->author->name }}</li>
        <li><i class="icon fa fa-tags app-text-primary"></i> {{ $blog->category->name }}</li>
      </ul>
      <div class="rte">
        <p>{{ $blog->pref }}
        </p>
      </div>
      <p><a href="{{ $blog->pageUrl }}"
           class="btn btn--primary btn--small">{{ __('frontend/default.general.read_more') }}
          <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
    </div>
  </div>

</div>
