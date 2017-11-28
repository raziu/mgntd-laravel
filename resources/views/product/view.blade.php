@extends('layouts.app')
@section('pageTitle', $type.' - '.__("products.$group").' - '.__('products.meta_title') )
@section('pageDesc', __("products.".$group."_desc") )

@section('styles')
<link rel="stylesheet" href="{{ URL::asset(config('app.theme').'/assets/js/spectrum/spectrum.css') }}" />
@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var AVK = '{{ config("app.av_key") }}';
  var LANG = '{{ app()->getLocale() }}';
  var BORDER_COLORS = '{{ $borderColors }}';
  var URL_REDIRECT = '{{ route("product_upload") }}';
  var ELEMENTS = '{{ $elements }}';
  var CAPTCHA_ERROR = '{{ __("products.captcha_error") }}';
  var ADDING_TO_BASKET_TEXT = '{{ __("products.adding_to_basket") }}';
  var URL_CART_ADD = '{{ route("basket_add") }}';
  var URL_CART = '{{ route("basket") }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jQuery-File-Upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jQuery-File-Upload/js/jquery.iframe-transport.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jQuery-File-Upload/js/jquery.fileupload.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jQuery-File-Upload/js/jquery.fileupload-process.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jQuery-File-Upload/js/jquery.fileupload-validate.js') }}"></script>
<script type="text/javascript" src="https://dme0ih8comzn4.cloudfront.net/imaging/v3/editor.js"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/spectrum/spectrum.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jquery.tmpl.min.js') }}"></script>
<script src="{{ URL::asset(config('app.theme').'/assets/js/CryptoJS-v3.1.2/rollups/md5.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/product.js') }}"></script>
@parent    
@stop
@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __("products.$group") }} - {{ __("products.create_set") }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="sub-nav" id="sub-nav">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
          <span>{{ __('products.available_types') }}</span>
          @if (count($product_types) > 0)
            @foreach ($product_types as $product_type)
            <a class="btn btn-sub {{ ($product_type==$type?'btn-active':'') }}" href="{{ route('product_view',[$product->group,$product_type]) }}">{{ $product_type }}</a>
            @endforeach
          @endif        
      </div>
      <div class="col-md-6 text-right">
          <span>{{ __('products.choose_border_color') }}</span>
          <input type='text' id="border" name="border" value="#FFFFFF" />
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module product-listing">
  <div class="container">
    <h2>{{ __("products.choose") }} {{ $elements }} {{ variety($elements, __("products.1photo"), __("products.234photos"), __("products.photos")) }}</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          @include('product.grid')
        </div>
      </div>
      <div class="col-md-6">
        <div class="box" style="overflow: hidden;">
          @include('product.tabs')
        </div>  
      </div>
    </div>
  </div>  
</section>
@endsection 