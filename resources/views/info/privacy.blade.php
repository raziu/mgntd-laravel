@extends('layouts.app')
@section('pageTitle', __('info.meta_title_privacy') )
@section('pageDesc', __('info.meta_description_privacy') )

@section('content')
@include('partials.title',['pageTitle' => __('info.meta_title_privacy')])

<section class="module">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="module-title font-alt meet-out-team-title">{{ __('info.privacy_h2') }}</h2>
        <div class="module-subtitle font-serif meet-out-team-subtitle">
        {!! nl2br(__('info.privacy_body')) !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 