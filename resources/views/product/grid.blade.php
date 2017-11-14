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
      <h6 class="text-center">( {{ $from }} - {{ $to }}  )</h6>
      @for( $i=1; $i<=$max2; $i++ )
      <div class="square-{{ $elements }} img_1-{{ $i }} add_to_set" data-i="{{ $cnt }}"  id="idx-{{ $cnt }}" data-has-image="" data-width="" data-height="" data-is-square="" data-big-id="">
        <div class="square-content">
          <div class="table">
              <div class="table-cell">
                <span data-idx="{{ $cnt }}" class="btn btn-default edit-set-image hidden2"><i class="fa fa-pencil-square-o"></i></span>
                <span data-idx="{{ $cnt }}" class="btn btn-danger edit-remove-image hidden2"><i class="fa fa-times"></i></span>
              </div>
          </div>        
        </div>
        @if( $elements == 1 )
        <div class="jigsaw-mask-big no-pointer-events jigsaw-mask-big-{{ $type }}"></div>
        @endif
      </div>
      @endfor
    </div>
    @endfor
  </div>
</div>