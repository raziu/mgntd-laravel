@extends('layouts.app')
@section('pageTitle', __('home.meta_title') )
@section('pageDesc', __('home.meta_description') )
@section('javascript')
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/home.js') }}"></script>
@parent    
@stop
@section('content')
<section id="home" class="home-section home-parallax home-fade home-full-height">
  <div class="hero-slider">
    <ul class="slides">
      <li class="bg-dark-30 bg-dark" style="background-image:url(/img/slide1.jpg)">
        <div class="hs-caption">
          <div class="caption-content">
            <div class="hs-title-size-4 font-alt mb-30">
              {!! __('home.slide_1_header') !!}
            </div>
            <div class="hs-title-size-1 font-alt mb-40">{{ __('home.slide_1_sub') }}</div>
            <a href="{{ route('product') }}" class="section-scroll btn btn-border-w btn-round">{{ __('home.slide_1_btn') }}</a>
          </div>
        </div>
      </li>
      <li class="bg-dark-30 bg-dark" style="background-image:url(/img/slide2.jpg)">
        <div class="hs-caption">
          <div class="caption-content">
            <div class="hs-title-size-4 font-alt mb-30">
            {!! __('home.slide_2_header') !!}
            </div>
            <div class="hs-title-size-1 font-alt mb-40">{{ __('home.slide_2_sub') }}</div>
            <a href="{{ route('login') }}" class="section-scroll btn btn-border-w btn-round">{{ __('home.slide_2_btn') }}</a>
          </div>
        </div>
      </li>
      <li class="bg-dark-30 bg-dark" style="background-image:url(/img/slide3.jpg)">
        <div class="hs-caption">
          <div class="caption-content">
            <div class="hs-title-size-4 font-alt mb-30">
            {!! __('home.slide_3_header') !!}
            </div>
            <div class="hs-title-size-1 font-alt mb-40">{{ __('home.slide_3_sub') }}</div>
            <a href="{{ route('login') }}" class="section-scroll btn btn-border-w btn-round">{{ __('home.slide_3_btn') }}</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</section>
<div class="main front-page-main" style="background-color: #FFF">
  
<section class="module home-products">
    <div class="container">
      @if (count($products) > 0)
      @foreach ($products as $product)
      <div class="row">
        <div class="col-sm-8">
          <div>
            <div class="post-thumbnail">
              <img src="{{ $product->getImageAttribute($product->image) }}" class="attachment-shop_isle_blog_image_size size-shop_isle_blog_image_size wp-post-image" alt="" width="750" height="500">
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <h3 class="post-title entry-title">{{ $product->getTitleAttributeForTranslation($product->group) }}</h3>
          <h4>{{ $product->getDescAttributeForTranslation($product->group) }}</h4>
          <p><a href="{{ route('product') }}" class="btn btn-default">{{ __('global.find_out_more') }}</a></p>
          <h5 class="price">{{ __('global.from') }} @if(!empty(Session::get('currency'))){!! Session::get('currency') !!}@endif {{ $product->setPriceAttribute($product->price) }}</h5>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </section>

  <section class="module module-advantages">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title font-alt">{{ __('home.editor_header') }}</h2>
        </div>
      </div>  
      <div class="row multi-columns-row">
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="features-item">
            <div class="features-icon">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25px" viewBox="0 0 172.094 172.094" style="enable-background:new 0 0 172.094 172.094;" xml:space="preserve"><path style="fill:#2dde98;" d="M172.094,17.186L154.908,0l-39.942,39.942H43.902V20.344H19.598v19.598H0v24.304h19.598v88.25h88.25v19.598h24.304v-19.598h19.598v-24.304h-19.598V57.127L172.094,17.186z M43.902,64.246h46.761l-46.761,46.761V64.246z M107.848,128.192H61.087l46.761-46.761V128.192z"></path></svg>
            </div>
            <h3 class="features-title font-alt">{{ __('home.editor_cropping') }}</h3>
            {{ __('home.editor_cropping_text') }}
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="features-item">
            <div class="features-icon">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25px" viewBox="0 0 205 205" style="enable-background:new 0 0 205 205;" xml:space="preserve"><path style="fill:#2dde98;" d="M70.406,0H205v134.597h-15V15H70.406V0z M40.138,45.266h119.597v119.597h15V30.266H40.138V45.266z M142.096,205H0V62.904h142.096V205z M127.096,77.904H15V190h112.096V77.904z"></path></svg>
            </div>
            <h3 class="features-title font-alt">{{ __('home.editor_frames') }}</h3>
            {{ __('home.editor_frames_text') }}
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="features-item">
            <div class="features-icon">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25px" viewBox="0 0 209.009 209.009" style="enable-background:new 0 0 209.009 209.009;" xml:space="preserve"><path style="fill:#2dde98;" d="M149.202,202.86l59.807-97.246l-15.626-9.61l13.163-43.601L189,47.106V6.148H0v114.166h14.981L149.202,202.86zM144.282,182.226l-93.79-57.681l34.68,10.47l21.224,13.054l3.447-5.605l13.86,4.186l-5.383,8.752l22.146,13.621l8.98-14.602l10.066,3.039L144.282,182.226z M163.524,143.002l-75.146-22.687h44.217l-1.02,3.381l24.89,7.514l3.29-10.894h10.62L163.524,143.002z M15,21.148h159v84.166H15V21.148z M57.833,30.397h26v65.668h-26V30.397z M97.833,30.397h26v65.668h-26V30.397z M137.833,30.397h26v65.668h-26V30.397z M38.833,89.065c0,3.867-3.134,7-7,7s-7-3.133-7-7c0-3.865,3.134-7,7-7S38.833,85.199,38.833,89.065z"></path></svg>
            </div>
            <h3 class="features-title font-alt">{{ __('home.editor_filters') }}</h3>
            {{ __('home.editor_filters_text') }}
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="features-item">
            <div class="features-icon">
              <svg version="1.1" id="ico-draw" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25px" viewBox="0 0 441 441" style="enable-background:new 0 0 441 441;" xml:space="preserve"><path style="fill:#2dde98;" d="M435.5,155.408c3.037,0,5.5-2.462,5.5-5.5s-2.463-5.5-5.5-5.5h-84.329v-50.7H435.5c3.037,0,5.5-2.462,5.5-5.5s-2.463-5.5-5.5-5.5h-84.329V12.76c0-3.038-2.463-5.5-5.5-5.5s-5.5,2.462-5.5,5.5v69.947H100.829V12.76c0-3.038-2.462-5.5-5.5-5.5s-5.5,2.462-5.5,5.5v69.947H5.5c-3.038,0-5.5,2.462-5.5,5.5s2.462,5.5,5.5,5.5h84.329v50.7H5.5c-3.038,0-5.5,2.462-5.5,5.5s2.462,5.5,5.5,5.5h84.329v169.037H5.5c-3.038,0-5.5,2.462-5.5,5.5s2.462,5.5,5.5,5.5h84.329v92.795c0,3.038,2.462,5.5,5.5,5.5s5.5-2.462,5.5-5.5v-92.795h239.342v92.795c0,3.038,2.463,5.5,5.5,5.5s5.5-2.462,5.5-5.5v-92.795H435.5c3.037,0,5.5-2.462,5.5-5.5s-2.463-5.5-5.5-5.5h-84.329V155.408H435.5z M340.171,93.707v50.7H169.725l18.727-50.7H340.171z M100.829,93.707h75.897l-18.727,50.7h-57.169V93.707z M153.935,155.408l-53.106,143.773V155.408H153.935z M165.865,324.444l13.05-37.867h81.614l13.047,37.867H165.865z M340.171,324.444h-54.96l-15.56-45.159c-0.765-2.219-2.854-3.708-5.2-3.708h-89.458c-2.347,0-4.435,1.489-5.2,3.708l-15.563,45.159h-51.007l62.438-169.037h46.442l-27.327,79.562c-0.577,1.68-0.307,3.536,0.725,4.982c1.033,1.446,2.7,2.304,4.477,2.304h59.486c1.776,0,3.444-0.858,4.477-2.304c1.032-1.446,1.303-3.302,0.726-4.982l-27.323-79.562h112.827V324.444z M219.723,167.086l22.037,64.17h-44.077L219.723,167.086z"></path></svg>
            </div>
            <h3 class="features-title font-alt">{{ __('home.editor_draw') }}</h3>
            {{ __('home.editor_draw_text') }}
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="features-item">
            <div class="features-icon">
              <svg version="1.1" id="ico-customize" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25px" viewBox="0 0 224 224" style="enable-background:new 0 0 224 224;" xml:space="preserve"><path style="fill:#2dde98;" d="M177,112c0-35.841-29.159-65-65-65c-35.841,0-65,29.159-65,65s29.159,65,65,65C147.841,177,177,147.841,177,112z M112,147c-19.299,0-35-15.701-35-35s15.701-35,35-35c19.299,0,35,15.701,35,35S131.299,147,112,147z M216.495,68.99l-28.291,16.333l-15-25.98l28.291-16.333L216.495,68.99z M201.495,180.99l-28.29-16.334l15-25.98l28.29,16.334L201.495,180.99z M97.001,191.333h30.001L127,224H97L97.001,191.333z M22.504,180.99L7.505,155.01l28.291-16.333l14.999,25.98L22.504,180.99z M50.795,59.344l-15,25.98L7.505,68.99l15-25.98L50.795,59.344z M127,32.667H97V0h30V32.667z"></path></svg>
            </div>
            <h3 class="features-title font-alt">{{ __('home.editor_customize') }}</h3>
            {{ __('home.editor_customize_text') }}
          </div>
        </div>
      </div>
    </div>  
  </section>

  <?php /*<section class="module-small home-banners">
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
  </section>  */ ?>

  <section class="module bg-dark-60 about-page-video" data-background="/img/newsletter.jpg">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="video-box">
            <div class="newsletter-message"></div>
            <div class="video-title font-alt">{{ __('home.newsletter_header') }}</div>
            <div class="video-subtitle font-alt">{{ __('home.newsletter_text') }}</div>
            <div style="padding: 10px 0px;">
              <form action="post">
                <?php /* required="" oninvalid="this.setCustomValidity('Enter your email')" onchange="this.setCustomValidity('')"*/ ?>
                <input id="newsletter-email" name="newsletter-email" class="form-control" placeholder="{{ __('home.newsletter_input_placeholder') }}" value="" type="text">
                <br/>
                <button type="submit" id="newsletter-submit" name="newsletter-submit" class="pirate-forms-submit-button btn btn-primary" placeholder="">{{ __('home.newsletter_btn') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php /*<hr class="divider-w">
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
  </div>*/ ?>
</div>
@endsection