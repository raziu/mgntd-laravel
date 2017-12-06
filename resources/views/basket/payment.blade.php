@extends('layouts.app')

@section('pageTitle', __('basket.meta_title_payment') )
@section('pageDesc', __('basket.meta_description_payment') )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
  var URL_MAKE_PAYMENT = '{{ route("order_pay") }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/payment.js') }}"></script>
@parent    
@stop

@section('content')
@include('partials.title',['pageTitle' => __('basket.meta_title_payment')])

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