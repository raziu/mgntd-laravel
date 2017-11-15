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
    <?php /*<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P793MFQ');</script>
    <!-- End Google Tag Manager -->*/ ?>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <base href="{{ URL::asset('/') }}" target="_top">
    <!-- MGNTD theme -->
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>
	  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon"/>
    <!--[if lt IE 9]>
	  <script src="{{ URL::asset(config('app.theme').'/js/html5.js')}}" type="text/javascript"></script>
    <![endif]-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c1.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c2.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c3.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c4.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c5.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c6.css') }}" data-minify="1" />
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/c7.css') }}" data-minify="1" />
    <script src="https://use.fontawesome.com/3202eb5af8.js"></script>
    <link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/css/mgntd.css') }}" data-minify="1" />
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery-migrate.min.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery.cookie.min.js') }}"></script>
    @section('styles')
    {!! isset($styles)?$styles:'' !!}
    @stop
    <script type="text/javascript">var LOCALE = '/{{ (app()->getLocale()!="pl")?app()->getLocale()."/":"" }}';</script>
</head>
<body class="{{ $controller }} blog woocommerce-active">
  <?php /*<!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P793MFQ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) --> */ ?>
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
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ URL::asset(config('app.theme').'/plugins/uk-cookie/uk-cookie.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/blockUI.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/jquery.selectBox.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/flexslider.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/magnific.popup.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/smoothscroll.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset(config('app.theme').'/assets/js/owl.carousel.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/mgntd.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/navigation.js') }}"></script>
    @yield('javascript')
    <?php /*<script src="{{ URL::asset(config('app.theme').'/assets/js/tabs.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/master.js') }}"></script>
    <script src="{{ URL::asset(config('app.theme').'/assets/js/modernizr.js') }}"></script>
    */ ?>
</body>
</html>