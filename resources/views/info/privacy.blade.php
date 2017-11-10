@extends('layouts.app')

@section('pageTitle', __('info.meta_title_privacy') )
@section('pageDesc', __('info.meta_description_privacy') )

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="container">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <h1 class="module-title font-alt">{{ __('info.meta_title_privacy') }}</h1>
        <div class="module-subtitle font-serif mb-0"></div>
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="module-title font-alt meet-out-team-title">{{ __('info.privacy_h2') }}</h2>
        <div class="module-subtitle font-serif meet-out-team-subtitle">
        index info privacy
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 