@extends('layouts.app')

@section('pageTitle', __('basket.meta_title_payment') )
@section('pageDesc', __('basket.meta_description_payment') )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/payment.js') }}"></script>
@parent    
@stop

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('basket.meta_title_payment') }}</h1>
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
        @include('basket.payment-'.$paymentCode)
      </div>
    </div>
  </div>
</section>
@endsection  