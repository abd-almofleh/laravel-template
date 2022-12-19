@php
  $user = auth()
      ->guard('customer_frontend')
      ->user();
@endphp
<div class="header-wrap animated d-flex">
  <div class="container-fluid">
    <div class="row align-items-center">
      <!--Desktop Logo-->
      <div class="logo col-md-2 col-lg-3 d-none d-lg-block py-0">
        <a href="{{ route('home') }}">
          <img width="70" src="{{ asset('images/logo.png') }}" />
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
            <li><a href="{{ route('home') }}">{{ __('frontend/navigation.home') }}</a></li>
            <li><a href="{{ route('listed_horses.list') }}">{{ __('frontend/navigation.horses') }}</a></li>
            <li><a href="{{ route('blogs.list') }}">{{ __('frontend/navigation.blogs') }}</a></li>
            {{-- <li><a href="#">{{ __('frontend/navigation.about_us') }}</a></li>
            <li><a href="#">{{ __('frontend/navigation.contact_us') }}</a></li> --}}
          </ul>
        </nav>
        <!--End Desktop Menu-->
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-block d-lg-none mobile-logo">
        <div class="logo">
          <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" />
          </a>
        </div>
      </div>

      <div class="col-4 col-sm-3 col-md-3 col-lg-2 text-right">
        @guest('customer_frontend')
          <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
          <ul class="customer-links list-inline">
            <li><a href="{{ route('customer.auth.login') }}">{{ __('frontend/default.general.login') }}</a></li>
            <li><a href="{{ route('customer.auth.signup.form') }}">{{ __('frontend/default.general.register') }}</a>
            </li>
          </ul>
        @else
          <div class="nav-item me-3 me-lg-0 dropdown profile-dropdown-container">
            <a class="nav-link profile-dd" role="button">
              {{ explode(' ', $user->name)[0] }}
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
                   alt="" loading="lazy" />
            </a>
            <div id="header-profile" class="block-cart block">
              <div class="name text-center">
                {{ $user->name }}
              </div>

              <ul class="header-profile-list">
                <li class="item">
                  <a class="list-title" href="{{ route('customer.profile') }}">{{ __('setting.profile.title') }}</a>
                </li>
              </ul>
              <div class="action text-center">
                <form action="{{ route('customer.auth.logout') }}" method="post">
                  @csrf
                  <button role="" class="btn btn-secondary btn--small">
                    {{ __('frontend/default.general.logout') }}
                  </button>
                </form>

              </div>
            </div>
          </div>
        @endguest
      </div>
    </div>
  </div>
</div>
