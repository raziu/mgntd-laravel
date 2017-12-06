@extends('layouts.app')
@section('pageTitle', __('info.meta_title_regulations') )
@section('pageDesc', __('info.meta_description_regulations') )

@section('content')
@include('partials.title',['pageTitle' => __('info.meta_title_regulations')])

<section class="module">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="module-title font-alt meet-out-team-title">{{ __('info.regulations_h2') }}</h2>
        <div class="module-subtitle font-serif meet-out-team-subtitle">
        {!! nl2br(__('info.regulations_body')) !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection