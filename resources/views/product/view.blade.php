@extends('layouts.app')
@section('pageTitle', $type.' - '.__("products.$group").' - '.__('products.meta_title') )
@section('pageDesc', __("products.".$group."_desc") )
@section('javascript')
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/product.js') }}"></script>
@parent    
@stop
@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __("products.$group") }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="sub-nav" id="sub-nav">
  <div class="container">
    <div class="actions">
      <?php /*<a class="primary" href="#"><span>Get started</span></a>*/ ?>
    </div>
    <div class="destinations">
      <div class="content">
        <span>{{ __('products.available_types') }}</span>
        @if (count($product_types) > 0)
          @foreach ($product_types as $product_type)
          <a class="btn btn-sub {{ ($product_type==$type?'btn-active':'') }}" href="{{ route('product_view',[$product->group,$product_type]) }}">{{ $product_type }}</a>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module product-listing">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        @include('product.grid')
      </div>
      <div class="col-md-6">
        @include('product.tabs')
      </div>
    </div>
  </div>  
</section>
@endsection 