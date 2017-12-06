@extends('layouts.app')

@section('pageTitle', __('order.meta_title_view', ['hash'=>$hash]) )
@section('pageDesc', __('order.meta_description_view', ['hash'=>$hash]) )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
  @php echo "var LOCATIONS = ". json_encode($locations) . ";\n"; @endphp;
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initGoogleMap&key=AIzaSyCVaL6DpD2gvg8MXCBLbPQE9xacvKsZ5Jk" async defer></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/order.js') }}"></script>
@parent    
@stop

@php
$total = 0;
@endphp

@section('content')
@include('partials.title',['pageTitle' => __('order.meta_title_view', ['hash'=>$hash])])

@if( Auth::check() )
<section class="sub-nav" id="sub-nav">
  <div class="container">
    <div class="actions">
      <?php /*<a class="primary" href="#"><span>Get started</span></a>*/ ?>
    </div>
    <div class="destinations">
      <div class="content">
        <a class="btn btn-sub" href="{{ route('profile_orders') }}">{{ __("global.btn_back") }}</a>
      </div>
    </div>
  </div>
</section>
@endif

<hr class="divider-w">
<section class="module shipping">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if( count($orderData) == 1 )
          <h3 class="text-center">{{ __('order.view_header') }}</h3>

          <div class="woocommerce-info">
            <div class="row">
              <div class="col-md-6 col-sm-12">{{ __('order.current_status') }}<br/><b>{{ __('basket.order_status_'.$orderData->status.'_desc') }}</b></div>
              <div class="col-md-6 col-sm-12 text-center">
                @if( $orderData->status == 1 && $payment->code != 'wire' )
                <a href="{{ route('order_repay', [$payment->code, $orderData->order_hash, $orderData->order_pin]) }}" class="btn btn-primary">{{ __('order.btn_pay') }}</a>
                @endif
              </div>
            </div>  
          </div>

          @if( count( $baskets ) )
            <div class="order-items" style="overflow: hidden">
            <div class="col-md-12">
            @foreach( $baskets as $item )
              @php
                $total += $item->totalPrice( $item->price );
              @endphp	
              <div class="row order-item">
                <div class="col-md-3 text-center">
                  {!! $item->basketThumb( $item, 'order-item-thumb' ) !!}
                </div>
                <div class="col-md-6">
                  <h4>{{ __('products.'.$item->product_type) }}</h4>
                  {{__('order.type')}}: {{ $item->type }}
                  <br/>
                  {{ __('basket.border_color') }} <span style="background: {{ $item->border_color }}" class="border_color">&nbsp;</span>
                </div>
                <div class="col-md-3 text-center order-item-price">
                  <span class="price-item">{{ $item->quantity }} x {{ $item->setPriceAttribute( $item->price ) }}</span>
                  <br/>
                  =
                  <br/>
                  <span class="price-item-total">{{ $item->setPriceAttribute( $item->price ) }}</span>
                </div>
              </div>
            @endforeach

            
            
              <div class="row order-item">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">&nbsp;</div>
                <div class="col-md-3 text-center">
                  @if( $orderData->price_shipping > 0 )
                  <span class="price-item">{{ __('order.shipping') }} + {{ $orderData->price_shipping }}</span><br/>
                  @php $total += $orderData->price_shipping; @endphp
                  @endif
                  @php $total -= $orderData->price_discount; @endphp
                  {{__('order.total_price')}}:<br/>
                  <span class="price-total">{{ $total }}</span>
                </div>  
              </div>  
            </div>

            </div>
          @endif

          <div class="gray-bg" style="margin-bottom: 20px;">
            <div class="row">
              <div class="col-md-6 col-sm-12 text-center">
                {{ __('order.chosen_payment') }}
                <h4>{{ __('basket.'.$payment->name) }}</h4>
                <img src="/img/ico/{{ $payment->icon }}" alt="" style="max-height: 40px;" />
                <p>{{ __('basket.'.$payment->desc) }}</p>
              </div>
              <div class="col-md-6 col-sm-12 text-center">
                {{ __('order.chosen_delivery') }}
                <h4>{{ __('basket.'.$delivery->name) }}</h4>
                <img src="/img/ico/{{ $delivery->icon }}.svg" alt="" style="max-height: 40px;" />
                <p>{{ __('basket.'.$delivery->desc) }}<br/>{{ __('basket.'.$delivery->delivery_time) }}</p>
              </div>
            </div>
          </div>

          <div class="row" style="margin-bottom: 30px;">
              <div class="col-md-12 col-sm-12">
                  <div id="map" style="height:250px;"></div>
                  <div id="mapLegend"></div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              
                <table class="table table-stripped">
                <thead>
                  <tr>
                    <th>{{ __('order.header_address') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><b>{{ $address->fullname }}</b></td>
                  </tr>
                  <tr>
                    <td>{{ $address->address }}, {{ $address->zip }} {{ $address->city }}, {{ $address->country }}</td>
                  </tr>
                  <tr>
                    <td>{{ $address->email }}</td>
                  </tr>
                <tbody>
                </table>
            </div>
            <div class="col-md-6 col-sm-12">
              
              <table class="table table-stripped">
              <thead>
                <tr>
                  <th>{{ __('order.header_history') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $history as $h )
                <tr>
                  <td><b>{{ __($h->description) }}</b> / {{ $h->created_at }}</td>
                </tr>
                @endforeach
              </tbody>
              </table>
            </div>
          </div>

          

          

        @else
          <h4 class="text-center">{{ __('global.not_found') }}</h4>
        @endif
        <br/><br/>
        <hr class="divider-w divider-p">
        <p class="text-center">
          <a href="{{ route('home') }}" class="btn btn-default">{{ __('global.btn_back_home') }}</a>
        </p>
      </div>
    </div>
  </div>
</section>
@endsection  