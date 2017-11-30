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

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('order.meta_title_view', ['hash'=>$hash]) }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module shipping">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if( count($orderData) == 1 )
          <h3 class="text-center">{{ __('order.view_header') }}</h3>
          @if( count( $baskets ) )
            <div class="box" style="overflow: hidden">
            @foreach( $baskets as $item )
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-4">
                    {!! $item->basketThumb( $item ) !!}
                  </div>
                  <div class="col-md-8">
                    <h4>{{ __('products.'.$item->product_type) }}, {{ $item->type }}</h4>
                    <br/>
                    {{ $item->quantity }} x {{ $item->setPriceAttribute( $item->price ) }}
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          @endif

          <div class="row" style="margin-bottom: 30px;">
              <div class="col-md-12 col-sm-12">
                  <div id="map" style="height:250px;"></div>
                  <div id="mapLegend"></div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <h4>Dane adresowe</h4>
                <table class="table table-stripped">
                <tr>
                  <td>{{ $address->fullname }}</td>
                </tr>
                <tr>
                  <td>{{ $address->address }}, {{ $address->zip }} {{ $address->city }}, {{ $address->country }}</td>
                </tr>
                <tr>
                  <td>{{ $address->email }}</td>
                </tr>
                </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <h4>Historia zamówienia</h4>
              <table class="table table-stripped">
                @foreach( $history as $h )
                <tr>
                  <td><b>{{ __($h->description) }}</b> / {{ $h->created_at }}</td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>

          <div class="woocommerce-info">
            <div class="row">
              <div class="col-md-6 col-sm-12">Aktualny status zamówienia: <b>{{ $orderData->status }}</b></div>
              <div class="col-md-6 col-sm-12">
                @if( $orderData->status == 1 )
                <a href="#" class="showlogin">Zapłać za zamówienie</a>
                @endif;
              </div>
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