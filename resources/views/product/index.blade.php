@extends('layouts.app')

@section('pageTitle', __('products.meta_title') )
@section('pageDesc', __('products.meta_description') )

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('products.meta_title') }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sub-nav" id="sub-nav">
  <div class="container">
    <div class="actions">
      <?php /*<a class="primary" href="#"><span>Get started</span></a>*/ ?>
    </div>
    <div class="destinations">
      <div class="content">
      @if (count($products) > 0)
        @foreach ($products as $product)
        <a class="btn btn-sub" href="{{ route('product') }}#{{ $product->group }}">{{ __("products.$product->group") }}</a>
        @endforeach
      @endif
      </div>
    </div>
  </div>
</section>

<hr class="divider-w">

<section class="module product-listing">
  @if (count($products) > 0)
  @foreach ($products as $product)
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a name="{{ $product->group }}"></a>
        <h2>{{ $product->getTitleAttributeForTranslation($product->group) }}</h2>
        <h4>{{ $product->getIntroAttribute($product->group) }}</h4>
        <p>{!! __("products.$product->desc") !!}</p>
       </div>
    </div>
  </div>

  <section class="home-banners gray-bg">
    <div class="container">
      <div class="row">
        @foreach( $product->setTypeAttribute( $product->type ) as $type )
        <div class="col-sm-4">
          <a href="{!! route('product_view',[$product->group,$type]) !!}" class="content-box-type">
            <div class="content-box-image">
              <img src="/img/{{ $type }}.svg" alt="" style="height:150px;" />
              <h3>{{ $type }}</h3>
            </div>
          </a>
        </div>
        @endforeach  
      <div>
    <div>
  </section>

  <div class="container">
    <div class="grid-photos">
      <div class="column">
        <div class="grid-2-at-medium">
          <div class="column">
            <div class="image aspect-ratio-square home-{{ $product->group }}-1"></div>
          </div>
          <div class="column">
            <div class="grid-1">
              <div class="column">
                <div class="image aspect-ratio-rect home-{{ $product->group }}-2"></div>
              </div>
              <div class="column">
                <div class="grid-2">
                  <div class="column">
                    <div class="image aspect-ratio-square home-{{ $product->group }}-3"></div>
                  </div>
                  <div class="column">
                    <div class="image aspect-ratio-square home-{{ $product->group }}-4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endforeach
  @endif
</section>
@endsection 