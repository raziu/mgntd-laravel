<h6 class="text-center product-view-h6">{{ __('products.tabs_header') }}</h6>

<ul class="nav nav-tabs product-view-tabs" role="tablist" id="productViewTabs">
  <li class="active" role="presentation"> 
    <a href="/add/magnets/1x9#upload" aria-controls="upload" role="tab" data-toggle="tab" title="{{ __('products.tab_upload') }}">
      <i class="fa fa-2x fa-upload" aria-hidden="true"></i> 
    </a>
  </li>
  <li role="presentation"> 
    <a href="{!! route('product_view',[$product->group,$type]) !!}#instagram" aria-controls="instagram" role="tab" data-toggle="tab" title="{{ __('products.tab_instagram') }}">
      <i class="fa fa-2x fa-instagram" aria-hidden="true"></i> 
    </a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="upload">
    @include('product.tab_upload')
  </div>
  <div role="tabpanel" class="tab-pane" id="instagram">
    @include('product.tab_instagram')
  </div>
</div>