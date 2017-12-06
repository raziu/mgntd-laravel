@extends('layouts.app')
@section('pageTitle', __('info.meta_title_payment') )
@section('pageDesc', __('info.meta_description_payment') )

@section('content')
@include('partials.title',['pageTitle' => __('info.meta_title_payment')])

<section class="module">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="module-title font-alt meet-out-team-title">{{ __('info.payment_h2') }}</h2>
        <div class="module-subtitle font-serif meet-out-team-subtitle">
        {!! nl2br(__('info.payment_body')) !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection