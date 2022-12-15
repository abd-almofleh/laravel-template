@extends('frontend.layouts.home')


@section('content')
  <div class="home-parallax">

    <div class="slideshow slideshow-wrapper">
      <div class="home-slideshow">
        <div class="slide">
          <div class="blur-up lazyload">
            <img class="blur-up lazyload" data-src="{{ asset('images/parallax/banner.jpg') }}"
                 src="assets/images/slideshow-banners/home9-banner1.jpg" alt="Gift For her" title="Gift For her" />
            <div class="slideshow__text-wrap slideshow__overlay classic bottom">
              <div class="slideshow__text-content left">
                <div class="container">
                  <div class="wrap-caption left">
                    <h2 class="h1 mega-title slideshow__title">Gift For her</h2>
                    <span class="mega-subtitle slideshow__subtitle">The latest collection from italian brands</span>
                    <span class="btn">Shop now</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End Home slider-->

    <!--Hero Parallax Section1-->
    <div class="section">
      <div class="hero hero--large hero__overlay bg-size">
        <img class="bg-img blur-up" src="{{ asset('images/parallax/parallax-banner1.jpg') }}" alt="" />
        <div class="hero__inner">
          <div class="container">
            <div class="wrap-text right text-medium font-bold">
              <h2 class="h2 mega-title">Kids Collection</h2>
              <div class="rte-setting mega-subtitle">Plenty of options for your kids. Be the first to buy</div>
              <a href="#" class="btn">Shop Kids</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="hero hero--large hero__overlay bg-size">
        <img class="bg-img" src="{{ asset('images/parallax/parallax-banner2.jpg') }}" alt="" />
        <div class="hero__inner">
          <div class="container">
            <div class="wrap-text left text-large font-bold">
              <h2 class="h2 mega-title">The mid season SALE.<br>UP TO 50% OFF</h2>
              <div class="rte-setting mega-subtitle">Live life Comfortable.<br>This flip flops switch, flip &amp; reverse
                to
                make up to 246 combos!<p><b>FREE SHIPPING on all orders over $199</b></p>
              </div>
              <a href="#" class="btn">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="hero hero--large hero__overlay bg-size">
        <img class="bg-img" src="{{ asset('images/parallax/parallax-banner3.jpg') }}" alt="" />
        <div class="hero__inner">
          <div class="container">
            <div class="wrap-text center text-medium font-bold">
              <h2 class="h2 mega-title">Women Wallets</h2>
              <div class="rte-setting mega-subtitle">Carry this stylist wallets for party</div>
              <a href="#" class="btn">Explore more</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
