<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @section('title')
      @sectionMissing('title')
        {{ __('frontend/default.general.title') }}
      @endif
      | {{ config('app.name') }}
    </title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @section('styles')

  </head>

  <body class="page-template belle">
    <div class="pageWrapper">
      @include('frontend.layouts.header')
      <!--Mobile Menu-->
      @include('frontend.layouts.mobile-menu')
      <!--End Mobile Menu-->

      <!--Body Content-->
      <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center">
          <div class="page-title">
            <div class="wrapper">
              <h1 class="page-width">
              @section('page-title')
                @sectionMissing('title')
                  {{ __('frontend/default.general.title') }}
                @endif
              </h1>
            </div>
          </div>
        </div>
        <!--End Page Title-->
        <main class="root">
        @section('content')
          @sectionMissing('content')
            @for ($i = 0; $i < 100; $i++)
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere reprehenderit a sapiente obcaecati eaque
              cumque fuga eum aliquid nulla? Commodi saepe voluptate culpa vitae possimus porro delectus dolores minus
              eligendi.
            @endfor
          @endif
        </main>
      </div>
      <!--End Body Content-->

      <x-frontend.layouts.footer />
      <!--Scoll Top-->
      <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
      <!--End Scoll Top-->

    </div>
    <script src="{{ asset('js/app.js') }}"></script>

  @section('scripts')

  </body>

  </html>
