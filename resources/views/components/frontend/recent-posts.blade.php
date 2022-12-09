@php
  $blogs = App\Models\CmsBlog::recentBlogs();
@endphp
<div class="sidebar_widget">
  <div class="widget-title">
    <h2>Recent Posts</h2>
  </div>
  <div class="widget-content">
    <div class="list list-sidebar-products">
      <div class="grid">
        @foreach ($blogs as $blog)
          <x-frontend.recent-posts-item title="{{ $blog->title }}" author="{{ $blog->author->name }}" :image="$blog->photo"
                                        blog-url="{{ $blog->pageUrl }}" />
        @endforeach

      </div>
    </div>
  </div>
</div>
