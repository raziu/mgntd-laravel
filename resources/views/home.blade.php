@extends('layouts.app')
@section('pageTitle', __('home.meta_title') )
@section('pageDesc', __('home.meta_description') )
@section('content')
<section id="home" class="home-section home-parallax home-fade home-full-height">
  <div class="hero-slider">
    <ul class="slides">
      <li class="bg-dark-30 bg-dark" style="background-image:url(/img/slide1.jpg)">
        <div class="hs-caption">
          <div class="caption-content">
            <div class="hs-title-size-4 font-alt mb-30">
              Huge Sale
              <br> Up to 80% off
            </div>
            <div class="hs-title-size-1 font-alt mb-40">Paris Street Style</div>
            <a href="#" class="section-scroll btn btn-border-w btn-round">Shop Now</a>
          </div>
        </div>
      </li>
      <li class="bg-dark-30 bg-dark" style="background-image:url(/img/slide2.jpg)">
        <div class="hs-caption">
          <div class="caption-content">
            <div class="hs-title-size-4 font-alt mb-30">
              New arrival for man<br>a modern style
            </div>
            <div class="hs-title-size-1 font-alt mb-40">Discovery the new collection</div>
            <a href="#" class="section-scroll btn btn-border-w btn-round">View Collection</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</section>
<div class="main front-page-main" style="background-color: #FFF">
  <section class="module-small home-banners">
    <div class="container">
      <div class="row shop_isle_bannerss_section">
        <div class="col-sm-4">
          <div class="content-box mt-0 mb-0">
            <div class="content-box-image">
              <a href="#"><img src="/img/banner1.jpg"></a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="content-box mt-0 mb-0">
            <div class="content-box-image">
              <a href="#"><img src="/img/banner1.jpg"></a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="content-box mt-0 mb-0">
            <div class="content-box-image">
              <a href="#"><img src="/img/banner1.jpg"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <hr class="divider-w">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>
          <div class="panel-body">
            @if (session('status'))
            <div class="alert alert-success">
            {{ session('status') }}
            </div>
            @endif
            {{ app()->getLocale() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection