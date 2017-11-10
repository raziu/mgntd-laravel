<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') - {{ config('app.name', 'MGNTD') }}</title>
    <meta name="description" content="@yield('pageDesc')">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <base href="{{ URL::asset('/') }}" target="_top">
    <!-- MGNTD theme -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
	  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <!--[if lt IE 9]>
	  <script src="{{ URL::asset(config('app.theme').'/js/html5.js')}}" type="text/javascript"></script>
	  <![endif]-->
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c1.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c2.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c3.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c4.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c5.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c6.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c7.css') }}" data-minify="1" />
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery-migrate.min.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery.cookie.min.js') }}"></script>
</head>
<body class="home blog woocommerce-active">
  <div class="page-loader">
    <div class="loader">{{ __('global.loading') }}</div>
  </div>
    <div id="app">
      @include('partials.header')
      <div class="main">
      @yield('content')
      @include('partials.footer')
      </div>
      <div class="scroll-up"> <a href="#totop"><i class="arrow_carrot-2up"></i></a></div>
    </div>
    <!-- Scripts -->
    <?php /*<script src="{{ asset('js/app.js') }}"></script>*/ ?>
    <!-- MGNTD theme -->
    <script src="{{ URL::asset(config('app.theme').'/plugins/uk-cookie/uk-cookie.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/blockUI.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery.selectBox.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/flexslider.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/magnific.popup.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/smoothscroll.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/owl.carousel.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/mgntd.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/navigation.js') }}"></script>

    <?php /*<script src="{{ URL::asset(config('app.theme').'/assets/js/tabs.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/master.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/modernizr.js') }}"></script>
    */ ?>
</body>
</html>