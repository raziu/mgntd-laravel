@extends('layouts.app')

@section('pageTitle', __('order.meta_title_placed') )
@section('pageDesc', __('order.meta_description_placed') )

@section('styles')

@parent    
@stop

@section('javascript')

@parent    
@stop

@section('content')
@include('partials.title',['pageTitle' => __('order.meta_title_placed')])

<section class="module shipping">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h3>{{ __('order.placed_header') }}</h3>
        <h4 class="text-center">{!! $info_header !!}</h4>
        <p class="text-center">{!! $info_message !!}</p>
        <br/><br/>
        <hr class="divider-w divider-p">
        <p class="text-center">
          <a href="{{ route('home') }}" class="btn btn-default">{{ __('global.btn_back_home') }}</a>
          @if( $status == 'FAIL' )
          &nbsp; {{ __('global.or') }} &nbsp;<a href="{{ route('order_repay', [$payment->code, $hash, $pin]) }}" class="btn btn-primary">{{ __('order.btn_repay') }}</a>
          @endif
          @if( $status == 'OK' )
          &nbsp; {{ __('global.or') }} &nbsp;<a href="{{ route('order_view',[$hash, $pin]) }}" class="btn btn-primary">{{ __('order.btn_view_order') }}</a>
          @endif
        </p>
      </div>
    </div>
  </div>
</section>
@endsection  