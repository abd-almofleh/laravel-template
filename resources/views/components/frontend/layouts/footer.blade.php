<footer id="footer">
  <div class="newsletter-section">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <ul class="addressFooter">
            <li class="phone"><i class="icon anm anm-phone-s"></i>
              <p>+971565088333</p>
            </li>
            <li class="email {{ app()->getLocale() == 'ar' ? 'me-3' : 'ms-3' }}"><a href="mailto:info@aladham-app.com">
                <i class="icon anm anm-envelope-l"></i>
                <p>info@aladham-app.com</p>
              </a>
            </li>
          </ul>
          <div class="footer-social">
            <ul class="list--inline site-footer__social-icons social-icons">
              <li>
                <a class="social-icons__link" href="https://www.facebook.com/aladham.horses/" target="_blank"
                   title="Facebook">
                  <i class="icon icon-facebook icon-size"></i>
                  <span class="icon__fallback-text">Facebook</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="https://twitter.com/AladhamHorses" target="_blank" title="Twitter">
                  <i class="icon icon-twitter icon-size"></i>
                  <span class="icon__fallback-text">Twitter</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="https://www.instagram.com/aladham.horses/" target="_blank"
                   title="Instagram">
                  <i class="icon icon-instagram icon-size"></i>
                  <span class="icon__fallback-text">Instagram</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="https://www.tiktok.com/@aladham.horses?lang=en" target="_blank"
                   title="tiktok">
                  <i class="icon fa-brands fa-tiktok icon-size"></i>
                  <span class="icon__fallback-text">Tiktok</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <footer class="d-flex justify-content-between align-items-center flex-wrap py-3">
      <p class="col-md-4 text-muted mb-0">
        <span class="fw-bolder">{{ config('app.name') }}</span>©
        {{ __('frontend/default.layout.all_rights_reserved') }}.
      </p>


      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link text-muted px-2">{{ __('frontend/navigation.home') }}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('about_us') }}"
             class="nav-link text-muted px-2">{{ __('frontend/navigation.about_us') }}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('contact_us') }}"
             class="nav-link text-muted px-2">{{ __('frontend/navigation.contact_us') }}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('privacy_policy') }}"
             class="nav-link text-muted px-2">{{ __('frontend/navigation.privacy_policy') }}</a>
        </li>
      </ul>
      </ul>
    </footer>
  </div>
</footer>
{{--
<div class="footer-top">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
      <h4 class="h4">{{ __('frontend/navigation.footer_list.horses_types') }}</h4>
      <ul>
        @foreach ($horseTypes as $type)
          <li><a href="{{ $type->buildUrl() }}">{{ $type->name }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
      <h4 class="h4">{{ __('frontend/navigation.footer_list.information') }}</h4>
      <ul>
        <li><a href="{{ route('home') }}">{{ __('frontend/navigation.home') }}</a></li>
        <li><a href="{{ route('about_us') }}">{{ __('frontend/navigation.about_us') }}</a></li>
        <li><a href="{{ route('contact_us') }}">{{ __('frontend/navigation.contact_us') }}</a></li>
        <li><a href="{{ route('privacy_policy') }}">{{ __('frontend/navigation.privacy_policy') }}</a></li>
      </ul>
    </div>
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box ms-auto">
      <h4 class="h4">{{ __('frontend/navigation.footer_list.contact_us') }}</h4>
      <ul class="addressFooter">
        <li class="phone"><i class="icon anm anm-phone-s"></i>
          <p>+971565088333</p>
        </li>
        <li class="email"><a href="mailto:info@aladham-app.com">
            <i class="icon anm anm-envelope-l"></i>
            <p>info@aladham-app.com</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<hr>
<div class="footer-bottom">
  <div class="row">
    <div class="col-12 copyright text-center" dir="ltr">
      <span class="fw-bolder">{{ config('app.name') }}</span>©
      {{ __('frontend/default.layout.all_rights_reserved') }}.
    </div>
  </div>
</div> --}}
