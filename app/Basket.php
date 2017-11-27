<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use AWS;

class Basket extends Model
{
  /**
   * Create Eloquent Relationship
   * Eloquent will bind the models
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function setPriceAttribute($value)
  {
    $request = request();
    $currency = $request->session()->get('currency');
    if( $currency == 'PLN' )
    {
      $price = number_format($value,2);
    }
    else
    {
      $converter = 0.5;
      $price = number_format(ceil($value*$converter), 2);
    }
    return $this->attributes['price'] = $price;
  }

  public function totalPrice($value)
  {
    $request = request();
    $currency = $request->session()->get('currency');
    if( $currency == 'PLN' )
    {
      $price = number_format($value,2);
    }
    else
    {
      $converter = 0.5;
      $price = number_format(ceil($value*$converter), 2);
    }
    //return $this->attributes['price'] = $price * $this->attributes['quantity'];
    return $price * $this->attributes['quantity'];
  }

  public function basketThumb( Basket $basket, $class = '', $width = 80, $onlyTileLink = false )
  {
    $html = '';
    $basketTilePhotos = json_decode(base64_decode($basket->pictures));
    $cntPhotos = count( $basketTilePhotos ) ;
    $tmp = explode('x', $basket->type );    
    switch( $basket->product_type )
    {
      case 'magnets':
      case 'poster':
        if( $basket->type == '1x9' )
        {
          $photoUrl = $basketTilePhotos[0];
          $html .= '
          <div class="basket-mask">
            <img src="'.$photoUrl.'" alt="" style="width:'.$width.'px;" />
            <div class="jigsaw-mask">'.$this->grid($basket->type, $basket->border_color, $width, 4).'</div>
          </div>';          
        }
        else
        {
          $i = 1;
          $width0 = $width;
          $width = $width / $tmp[0];
          $html .= '<div class="basket-mask"><div class="basket-mask-in">';
          foreach( $basketTilePhotos as $photo )
          {
            $photoUrl = $photo;
            $html .= '
            <div class="basket-photo" style="width:' . $width . 'px;">
              <img src="' . $photoUrl . '" alt="" style="width:' . $width . 'px;" />
            </div>';
            if ($i%$tmp[0] == 0)
            {
              $html .= '<br style="clear: both;"/>';
            }
            $i++;
          }
          //$html .= '<div class="jigsaw-mask">'.$this->grid($basket->type, $basket->border_color, $width0, 4).'</div>';
          $html .= '</div></div>';
        }
        break;
    }
    return $html;
  }

  public function grid( $type = '3x3', $hex_color = "#ff0000", $size = 640, $stroke = 20 )
  {
      switch( $type )
      {
          case '3x3':
          case '1x9':
              $s1 = floor($size / 3);
              $s2 = floor($size / 3) * 2;

              return '<?xml version="1.0" standalone="no"?>
              <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
              <svg width="'.$size.'" height="'.$size.'" xmlns="http://www.w3.org/2000/svg" version="1.1">
                  <g stroke="'.$hex_color.'" >
                      <line x1="0" y1="0" x2="'.$size.'" y2="0" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="'.$size.'" x2="'.$size.'" y2="'.$size.'" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="0" x2="0" y2="'.$size.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$size.'" y1="0" x2="'.$size.'" y2="'.$size.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$s1.'" y1="0" x2="'.$s1.'" y2="'.$size.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$s2.'" y1="0" x2="'.$s2.'" y2="'.$size.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s1.'" x2="'.$size.'" y2="'.$s1.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s2.'" x2="'.$size.'" y2="'.$s2.'" stroke-width="'.($stroke/2).'" />
                  </g>
              </svg>';
              break;
          case '2x2':
              $s1 = floor($size / 2);

              return '<?xml version="1.0" standalone="no"?>
              <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
              <svg width="'.$size.'" height="'.$size.'" xmlns="http://www.w3.org/2000/svg" version="1.1">
                  <g stroke="'.$hex_color.'" >
                      <line x1="0" y1="0" x2="'.$size.'" y2="0" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="'.$size.'" x2="'.$size.'" y2="'.$size.'" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="0" x2="0" y2="'.$size.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$size.'" y1="0" x2="'.$size.'" y2="'.$size.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$s1.'" y1="0" x2="'.$s1.'" y2="'.$size.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s1.'" x2="'.$size.'" y2="'.$s1.'" stroke-width="'.($stroke/2).'" />
                  </g>
              </svg>';
              break;

          case '4x6':

              $s1 = floor($size / 4);
              $s2 = floor($size / 4) * 2;
              $s3 = floor($size / 4) * 3;
              $s4 = floor($size / 4) * 6;
              $s5 = floor($size / 4) * 5;

              return '<?xml version="1.0" standalone="no"?>
              <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
              <svg width="'.$size.'" height="'.$s4.'" xmlns="http://www.w3.org/2000/svg" version="1.1">
                  <g stroke="'.$hex_color.'" >
                      <line x1="0" y1="0" x2="'.$size.'" y2="0" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="'.$s5.'" x2="'.$size.'" y2="'.$s5.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s4.'" x2="'.$size.'" y2="'.$s4.'" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="0" x2="0" y2="'.$s4.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$size.'" y1="0" x2="'.$size.'" y2="'.$s4.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$s1.'" y1="0" x2="'.$s1.'" y2="'.$s4.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$s2.'" y1="0" x2="'.$s2.'" y2="'.$s4.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$s3.'" y1="0" x2="'.$s3.'" y2="'.$s4.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s1.'" x2="'.$size.'" y2="'.$s1.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s2.'" x2="'.$size.'" y2="'.$s2.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s3.'" x2="'.$size.'" y2="'.$s3.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$size.'" x2="'.$size.'" y2="'.$size.'" stroke-width="'.($stroke/2).'" />
                  </g>
              </svg>';
              break;

          case '5x7':

              $s1 = floor($size / 5);
              $s2 = floor($size / 5) * 2;
              $s3 = floor($size / 5) * 3;
              $s4 = floor($size / 5) * 4;
              $s6 = floor($size / 5) * 6;
              $s7 = floor($size / 5) * 7;

              return '<?xml version="1.0" standalone="no"?>
              <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
              <svg width="'.$size.'" height="'.$s7.'" xmlns="http://www.w3.org/2000/svg" version="1.1">
                  <g stroke="'.$hex_color.'" >
                      <line x1="0" y1="0" x2="'.$size.'" y2="0" stroke-width="'.$stroke.'" />
                      <line x1="0" y1="'.$s1.'" x2="'.$size.'" y2="'.$s1.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s2.'" x2="'.$size.'" y2="'.$s2.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s3.'" x2="'.$size.'" y2="'.$s3.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s4.'" x2="'.$size.'" y2="'.$s4.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$size.'" x2="'.$size.'" y2="'.$size.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s6.'" x2="'.$size.'" y2="'.$s6.'" stroke-width="'.($stroke/2).'" />
                      <line x1="0" y1="'.$s7.'" x2="'.$size.'" y2="'.$s7.'" stroke-width="'.$stroke.'" />

                      <line x1="0" y1="0" x2="0" y2="'.$s7.'" stroke-width="'.$stroke.'" />
                      <line x1="'.$s1.'" y1="0" x2="'.$s1.'" y2="'.$s7.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$s2.'" y1="0" x2="'.$s2.'" y2="'.$s7.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$s3.'" y1="0" x2="'.$s3.'" y2="'.$s7.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$s4.'" y1="0" x2="'.$s4.'" y2="'.$s7.'" stroke-width="'.($stroke/2).'" />
                      <line x1="'.$size.'" y1="0" x2="'.$size.'" y2="'.$s7.'" stroke-width="'.$stroke.'" />
                  </g>
              </svg>';
              break;

      }

  }


}
