<div {{ $attributes->merge(['class' => 'article']) }}>
  <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{ $blog->photo->url }}"
         src="{{ $blog->photo->preview }}" alt="It's all about how you wear"></a>
  <h2 class="h3"><a href="blog-left-sidebar.html">{{ $blog->title }}</a></h2>
  <ul class="publish-detail">
    <li><i class="fa fa-user app-text-primary" aria-hidden="true"></i> {{ $blog->author->name }}</li>
    <li><i class="icon fa fa-tags app-text-primary"></i> {{ $blog->category->name_en }}</li>
  </ul>
  <div class="rte">
    <p>{{ $blog->pref }}
    </p>
  </div>
  <p><a href="{{ $blog->url }}" class="btn btn--primary btn--small">{{ __('frontend/default.general.read_more') }}
      <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
</div>
