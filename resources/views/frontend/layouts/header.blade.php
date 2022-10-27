<div class="header-wrap animated d-flex">
  <div class="container-fluid">
    <div class="row align-items-center">
      <!--Desktop Logo-->
      <div class="logo col-md-2 col-lg-3 d-none d-lg-block">
        <a href="index.html">
          <img src="{{ asset('images/logo.svg') }}" />
        </a>
      </div>
      <!--End Desktop Logo-->
      <div class="col-2 col-sm-3 col-md-3 col-lg-6">
        <div class="d-block d-lg-none">
          <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
            <i class="icon anm anm-times-l"></i>
            <i class="anm anm-bars-r"></i>
          </button>
        </div>
        <!--Desktop Menu-->
        <nav class="grid__item" id="AccessibleNav">
          <!-- for mobile -->
          <ul id="siteNav" class="site-nav medium center hidearrow">
            <li><a href="#">{{ __('frontend/navigation.home') }}</a></li>
            <li><a href="#">{{ __('frontend/navigation.shop') }}</a></li>
            <li><a href="#">{{ __('frontend/navigation.blog') }}</a></li>
            <li><a href="#">{{ __('frontend/navigation.about_us') }}</a></li>
            <li><a href="#">{{ __('frontend/navigation.contact_us') }}</a></li>
          </ul>
        </nav>
        <!--End Desktop Menu-->
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-block d-lg-none mobile-logo">
        <div class="logo">
          <a href="index.html">
            <img src="{{ asset('images/logo.svg') }}" />
          </a>
        </div>
      </div>

      <div class="col-4 col-sm-3 col-md-3 col-lg-2 text-right">
        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
        <ul class="customer-links list-inline">
          <li><a href="login.html">{{ __('frontend/default.general.login') }}</a></li>
          <li><a href="register.html">{{ __('frontend/default.general.register') }}</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
