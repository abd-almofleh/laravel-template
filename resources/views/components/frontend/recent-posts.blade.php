@php
  $blogs = App\Models\CmsBlog::recent();
  dd($blogs);
@endphp
<div class="sidebar_widget">
  <div class="widget-title">
    <h2>Recent Posts</h2>
  </div>
  <div class="widget-content">
    <div class="list list-sidebar-products">
      <div class="grid">
        <div class="grid__item">
          <div class="mini-list-item">
            <div class="mini-view_image">
              <a class="grid-view-item__link" href="#">
                <img class="grid-view-item__image blur-up lazyload" data-src="assets/images/blog/blog-post-sml-1.jpg"
                     src="assets/images/blog/blog-post-sml-1.jpg" alt="" />
              </a>
            </div>
            <div class="details"> <a class="grid-view-item__title" href="#">It's all about how you
                wear</a>
              <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:33:00Z">May
                    02, 2017</time></span></div>
            </div>
          </div>
        </div>
        <div class="grid__item">
          <div class="mini-list-item">
            <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                     class="grid-view-item__image blur-up lazyload" data-src="assets/images/blog/blog-post-sml-2.jpg"
                     src="assets/images/blog/blog-post-sml-2.jpg" alt="" /></a> </div>
            <div class="details"> <a class="grid-view-item__title" href="#">27 Days of Spring Fashion
                Recap</a>
              <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:33:00Z">May
                    02, 2017</time> </span></div>
            </div>
          </div>
        </div>
        <div class="grid__item">
          <div class="mini-list-item">
            <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                     class="grid-view-item__image blur-up lazyload" data-src="assets/images/blog/blog-post-sml-3.jpg"
                     src="assets/images/blog/blog-post-sml-3.jpg" alt="" /></a> </div>
            <div class="details"> <a class="grid-view-item__title" href="#">How to Wear The Folds Trend
                Four Ways</a>
              <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:14:00Z">May
                    02, 2017</time> </span></div>
            </div>
          </div>
        </div>
        <div class="grid__item">
          <div class="mini-list-item">
            <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img
                     class="grid-view-item__image blur-up lazyload" data-src="assets/images/blog/blog-post-sml-4.jpg"
                     src="assets/images/blog/blog-post-sml-4.jpg" alt="" /></a> </div>
            <div class="details"> <a class="grid-view-item__title" href="#">Accusantium doloremque</a>
              <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:12:00Z">May
                    02, 2017</time> </span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
