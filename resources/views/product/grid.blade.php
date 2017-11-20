@php
//---------------------------
$max = $elements;
$single = 9;
if( $elements == 1 )
{
  $single = $max;
}
if( $elements == 4 )
{
  $single = 4;
}
$slides = ceil($max/$single);
$cnt = 0;
//---------------------------
@endphp
<div id="carousel-{{ $max }}" class="carousel slide" data-ride="carousel" data-interval="false">
  @if($slides > 1)
  <ol class="carousel-indicators">
  @for( $j=0; $j<=$slides; $j++ )
    <li data-target="#carousel-{{ $max }}" data-slide-to="{{ $j }}" {!! ($j==0?'class="active"':'') !!}></li>
  @endfor
  </ol>
  @endif
  <div class="carousel-inner" role="listbox">
    @for( $k=0; $k<$slides; $k++ )
    <div class="item {!! ($k==0?'active':'') !!}">
      @php
      $from = ( ( $k ) * $single ) + 1;
      $to = ( ( $k ) * $single ) + ( $single + $k );
      if( $k > 0 )
      {
        $to -= 1;
      }
      if( $k == ($slides-1) )
      {
        $to = $max;
      }
      $currentSlide = ($k + 1);
      $max2 = $single;
      if( $slides == $currentSlide && ( ($max%$single) > 0 ) )
      {
        $max2 = $max%$single;
      }
      @endphp
      <h6 class="text-center product-view-h6">( {{ $from }} - {{ $to }}  )</h6>
      @for( $cnt=1; $cnt<=$max2; $cnt++ )
      <div class="square-{{ $elements }}">
        <div class="square-in add_to_set" data-i="{{ $cnt }}" id="idx-{{ $cnt }}" data-has-image="" data-width="" data-height="" data-is-square="" data-big-id="" style="">
          <div class="square-content hidden">
            <div class="table">
                <div class="table-cell">
                  <span data-idx="{{ $cnt }}" class="btn btn-default edit-set-image edit-{{ $cnt }}"><i class="fa fa-pencil-square-o"></i> {{ __('global.edit') }}</span>
                  <span data-idx="{{ $cnt }}" class="btn btn-danger remove-set-image remove-{{ $cnt }}"><i class="fa fa-times"></i>{{ __('global.remove') }}</span>
                  <img id="editable-{{ $cnt }}" src="" class="editable hidden" style=""/>
                </div>
            </div>        
          </div>
        </div>
        @if( $elements == 1 )
        <div class="jigsaw-mask-big jigsaw-mask-big-{{ $elements }}"></div>
        @endif
      </div>
      @endfor
    </div>
    @endfor
  </div>
</div>

<div class="row">
  <div class="text-center">
    <a href="javascript:void(0);" class="btn btn-primary btn-add-to-cart hidden" id="btn-add-to-cart" data-group="{{ $group }}" data-type="{{ $type }}">{{ __('products.btn_add_to_cart') }}</a>
  </div>
</div>