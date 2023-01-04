@extends('frontend.layouts.home')

@section('title', __('frontend/navigation.contact_us'))


@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
        <h2>{{ __('default.contact_us.title') }}</h2>
        <p>{{ __('default.contact_us.description') }}</p>
        <div class="formFeilds contact-form form-vertical">
          <form action="{{ route('storeSuggestion') }}" method="post" id="contact_form" class="contact-form">
            @csrf
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <input type="text" id="ContactFormName" name="name" placeholder="Name" value=""
                         required="">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <input type="email" id="ContactFormEmail" name="email" placeholder="Email" value=""
                         required="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <input required="" type="tel" id="ContactFormPhone" name="phone" placeholder="Phone Number"
                         value="">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <input required="" type="text" id="ContactSubject" name="subject" placeholder="Subject"
                         value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <textarea required="" rows="10" id="ContactFormMessage" name="message" placeholder="Your Message"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <input type="submit" class="btn" value="Send Message">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4">
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

        <hr />
        <ul class="list--inline site-footer__social-icons social-icons">
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
  @endsection
