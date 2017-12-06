@extends('layouts.app')

@section('pageTitle', __('profile.meta_title_orders') )
@section('pageDesc', __('profile.meta_description_orders') )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/profile.js') }}"></script>
@parent    
@stop

@section('content')
@include('partials.title',['pageTitle' => __('profile.meta_title_orders')])
<section class="module shipping">
  <div class="container">
    <h3>{{ __('profile.orders_header') }}</h3>
    @if( count( $orders ) > 0 )
    <table class="table table-stripped">
      <thead>
        <th>{{ __('profile.orders_header_lp') }}</th>
        <th>{{ __('profile.orders_header_hash') }}</th>
        <th>{{ __('profile.orders_header_price_cart') }}</th>
        <th>{{ __('profile.orders_header_status') }}</th>
        <th>{{ __('profile.orders_header_currency') }}</th>
        <th>{{ __('profile.orders_header_comments') }}</th>
        <th>&nbsp;</th>
      </thead>
      <tbody>
    @foreach( $orders as $order )
    <tr>
      <td>1</td>
      <td><b>{{ $order->order_hash }}</b></td>
      <td>
        <span class="price-item-total">{{ $order->price_cart }}</span><br/>
        <span class="price-item">{{ $order->price_shipping }}</span><br/>
        {{ $order->price_discount }}
      </td>
      <td>{{ __('basket.order_status_'.$order->status.'_desc') }}</td>
      <td>{{ $order->order_currency }}</td>
      <td>{{ $order->comments }}</td>
      <td>
        <a href="{{ route('order_view', [$order->order_hash, $order->order_pin]) }}">{{ __('profile.link_order_view') }}<a>
      </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    @else 
    <h4>{{ __('profile.no_orders') }}</h4>
    @endif
  </div>
</section>  
@endsection 