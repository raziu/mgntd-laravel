@extends('layouts.app')

@section('pageTitle', __('basket.meta_title') )
@section('pageDesc', __('basket.meta_description') )

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('basket.meta_title') }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module">
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            basket
          </div>
      </div>
  </div>
</section>  
@endsection 