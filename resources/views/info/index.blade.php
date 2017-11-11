@extends('layouts.app')

@section('pageTitle', __('info.meta_title') )
@section('pageDesc', __('info.meta_description') )

@section('content')
<section class="page-header-module module bg-dark header-short" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('info.meta_title_privacy') }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 