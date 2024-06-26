<div class="mobile-nav-wrapper" role="navigation">
  <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i>
    {{ __('frontend/default.general.close_menu') }}</div>
  <ul id="MobileNav" class="mobile-nav">
    <li><a href="{{ route('home') }}">{{ __('frontend/navigation.home') }}</a></li>
    <li><a href="{{ route('listed_horses.list') }}">{{ __('frontend/navigation.horses') }}</a></li>
    <li><a href="{{ route('blogs.list') }}">{{ __('frontend/navigation.blogs') }}</a></li>
    <li><a href="{{ route('about_us') }}">{{ __('frontend/navigation.about_us') }}</a></li>
    <li><a href="{{ route('contact_us') }}">{{ __('frontend/navigation.contact_us') }}</a></li>
</div>
