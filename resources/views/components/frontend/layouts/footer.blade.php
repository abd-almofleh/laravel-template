<footer id="footer">
  <div class="newsletter-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-7 d-flex justify-content-start align-items-center">
          <div class="display-table">
            {{-- <div class="display-table-cell footer-newsletter">
              <div class="section-header text-center">
                <label class="h2"><span> {{ __('frontend/default.layout.sign_up_for') }}
                  </span>{{ __('frontend/default.layout.newsletter') }}</label>
              </div>
              <form action="#" method="post">
                <div class="input-group">
                  <input type="email" class="input-group__field newsletter__input" name="EMAIL" value=""
                         placeholder="{{ __('frontend/default.form.email') }}" required="">
                  <span class="input-group__btn">
                    <button type="submit" class="btn newsletter__submit" name="commit" id="Subscribe"><span
                            class="newsletter__submit-text--large">{{ __('frontend/default.layout.subscribe') }}</span></button>
                  </span>
                </div>
              </form>
            </div> --}}
          </div>
        </div>
        <div class="col-12 d-flex justify-content-center align-items-center">
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
  <div class="site-footer">
    <div class="container">
      <!--Footer Links-->
      <div class="footer-top">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
            <h4 class="h4">{{ __('frontend/navigation.footer_list.horses_types') }}</h4>
            <ul>
              @foreach ($horseTypes as $type)
                <li><a href="#">{{ $type->name_en }}</a></li>
              @endforeach
            </ul>
          </div>
          {{-- <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
            <h4 class="h4">{{ __('frontend/navigation.footer_list.information') }}</h4>
            <ul>
              <li><a href="#">{{ __('frontend/navigation.about_us') }}</a></li>
              <li><a href="#">{{ __('frontend/navigation.contact_us') }}</a></li>
              <li><a href="#">{{ __('frontend/navigation.privacy_policy') }}</a></li>
              <li><a href="#">{{ __('frontend/navigation.terms_condition') }}</a></li>
            </ul>
          </div> --}}
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
          <div class="col-12 col-sm-12 col-md-6 order-md-0 copyright text-sm-center text-md-start order-1">
            <span class="fw-bolder">{{ config('app.name') }}</span>©.
            {{ __('frontend/default.layout.all_rights_reserved') }}.
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
