@extends('layouts.app')

@section('pageTitle', __('basket.meta_title') )
@section('pageDesc', __('basket.meta_description') )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
  var URL_CART_UPDATE = '{{ route("basket_update") }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/cart.js') }}"></script>
@parent    
@stop

@php
$total = 0;
@endphp

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('basket.meta_title') }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
            @if( count( $items ) )
            <div class="box">
              <table class="shop_table shop_table_responsive cart">
              <thead>
                <tr>
                  <th class="product-remove">&nbsp;</th>
                  <th class="product-thumbnail">&nbsp;</th>
                  <th class="product-name">{{ __('basket.header_product') }}</th>
                  <th class="product-price">{{ __('basket.header_price') }}</th>
                  <th class="product-quantity">{{ __('basket.header_quantity') }}</th>
                  <th class="product-subtotal">{{ __('basket.header_total') }}</th>
                </tr>
              </thead>
              <tbody>
              @foreach( $items as $item )

              @php
                $total += $item->totalPrice( $item->price );
              @endphp	

              <tr class="cart_item">
                <td class="product-remove">
                  <a href="javascript:void(0);" class="remove" aria-label="{{ __('basket.remove_this_item') }}" data-id="{{ $item->id }}" data-title="{{ __('basket.confirm_title') }}" data-message="{{ __('basket.confirm_message') }}" >×</a>						
                </td>
                <td class="product-thumbnail">
                  {!! $item->basketThumb( $item ) !!}
                </td>
                <td class="product-name">
                  <a href="{{ route('product_view',[$item->product_type,$item->type]) }}">
                    {{ __('products.'.$item->product_type) }}
                  </a>						
                  <br/>
                  {{ $item->type }}
                </td>
                <td class="product-price">
                  {{ $item->setPriceAttribute( $item->price ) }}
                </td>
                <td class="product-quantity">
                  <div class="quantity">
                    <input id="q-{{ $item->id }}" class="input-text qty cart-qty text" step="1" min="1" max="100" name="cart[][qty]" value="{{ $item->quantity }}" title="{{ __('basket.header_quantity') }}" size="4" pattern="[0-9]*" inputmode="numeric" type="number" data-id="{{ $item->id }}">
                  </div>
                </td>
                <td class="product-subtotal">
                {{ $item->totalPrice( $item->price ) }}	
                </td>
              </tr>
              @endforeach
              <tr class="cart_item">
                <td colspan="5"></td>
                <td><b>{{ $total }}</b></td>
              </tr>

              
              
                

              </tbody>
              </table>
            </div>  
            @else
              <h4 class="text-header">{{ __('basket.cart_contents_header') }}</h4>
              <p class="text-content">{{ __('basket.no_items') }}</p>
              <p class="text-center">
                <a href="{{ route('product') }}" class="btn btn-primary">{{ __('global.btn_back') }}</a>
              </p>
            @endif
          </div>
      </div>
      @if( count( $items ) )
      <div class="row">
      <div class="col-md-6">
          <a href="{{ route('product') }}" class="btn btn-default">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> 
            {{ __('global.btn_order_more') }}</a>
        </div>
        <div class="col-md-6 text-right">
          <a href="{{ route('basket_shipping') }}" class="btn btn-primary">{{ __('basket.link_shipping') }} <i class="fa fa-envelope" aria-hidden="true"></i></a>
        </div>
      </div>
      @endif
  </div>
</section>  
@endsection 