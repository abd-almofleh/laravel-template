<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @sectionMissing('title')
      {{ config('app.name') }}
    @else
      @yield('title') | {{ config('app.name') }}
    @endif

  </title>
  <meta name="description" content="description">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    .icon-size {
      font-size: 20px !important;
    }
  </style>
  @stack('styles')
</head>

<body class="page-template belle">
  <div class="pageWrapper">
    @include('frontend.layouts.header')
    @include('frontend.layouts.mobile-menu')

    <div id="page-content">

      @hasSection('title')
        <div class="page section-header mb-0 text-center">
          <div class="page-title">
            <div class="wrapper">
              <h1 class="page-width">
                @yield('title')
                @sectionMissing('title')
                  {{ __('frontend/default.general.title') }}
                @endif
              </h1>
            </div>
          </div>
        </div>
      @endif

      <main class="root">
        @hasSection('breadcrumbs')
          <div class="bredcrumbWrap">
            <div class="breadcrumbs container">
              @yield('breadcrumbs')
            </div>
          </div>
        @endif

        @yield('content')
        @sectionMissing('content')
          No content
        @endif
      </main>
    </div>

    <x-frontend.layouts.footer />

    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>

  {!! Toastr::message() !!}
  @stack('scripts')

</body>

</html>
