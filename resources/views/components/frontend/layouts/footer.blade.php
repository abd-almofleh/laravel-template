<footer id="footer">
  <div class="newsletter-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-7 d-flex justify-content-start align-items-center">
          <div class="display-table">
            <div class="display-table-cell footer-newsletter">
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
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
          <div class="footer-social">
            <ul class="list--inline site-footer__social-icons social-icons">
              <li>
                <a class="social-icons__link" href="#" target="_blank" title="Facebook">
                  <i class="icon icon-facebook"></i>
                  <span class="icon__fallback-text">Facebook</span>

                </a>
              </li>
              <li>
                <a class="social-icons__link" href="#" target="_blank" title="Twitter">
                  <i class="icon icon-twitter"></i>
                  <span class="icon__fallback-text">Twitter</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="#" target="_blank" title="Pinterest">
                  <i class="icon icon-pinterest"></i>
                  <span class="icon__fallback-text">Pinterest</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="#" target="_blank" title="Instagram">
                  <i class="icon icon-instagram"></i>
                  <span class="icon__fallback-text">Instagram</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="#" target="_blank" title="Tumblr">
                  <i class="icon icon-tumblr-alt"></i>
                  <span class="icon__fallback-text">Tumblr</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="#" target="_blank" title=" YouTube">
                  <i class="icon icon-youtube"></i>
                  <span class="icon__fallback-text">YouTube</span>
                </a>
              </li>
              <li>
                <a class="social-icons__link" href="#" target="_blank" title="Vimeo">
                  <i class="icon icon-vimeo-alt"></i>
                  <span class="icon__fallback-text">Vimeo</span>
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
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
            <h4 class="h4">{{ __('frontend/navigation.footer_list.information') }}</h4>
            <ul>
              <li><a href="#">{{ __('frontend/navigation.about_us') }}</a></li>
              <li><a href="#">{{ __('frontend/navigation.contact_us') }}</a></li>
              <li><a href="#">{{ __('frontend/navigation.privacy_policy') }}</a></li>
              <li><a href="#">{{ __('frontend/navigation.terms_condition') }}</a></li>
            </ul>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box ms-auto">
            <h4 class="h4">{{ __('frontend/navigation.footer_list.contact_us') }}</h4>
            <ul class="addressFooter">
              <li><i class="icon anm anm-map-marker-al"></i>
                <p>55 Gallaxy Enque,<br>2568 steet, 23568 NY</p>
              </li>
              <li class="phone"><i class="icon anm anm-phone-s"></i>
                <p>(440) 000 000 0000</p>
              </li>
              <li class="email"><i class="icon anm anm-envelope-l"></i>
                <p>sales@yousite.com</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--End Footer Links-->
      <hr>
      <div class="footer-bottom">
        <div class="row">
          <!--Footer Copyright-->
          <div class="col-12 col-sm-12 col-md-6 order-md-0 copyright text-sm-center text-md-start order-1">
            <span></span> <a href="templateshub.net"><span class="fw-bolder">{{ config('app.name') }}</span>©.
              {{ __('frontend/default.layout.all_rights_reserved') }}.</a>
          </div>
          <!--End Footer Copyright-->
        </div>
      </div>
    </div>
  </div>
</footer>