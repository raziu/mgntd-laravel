@extends('layouts.app')

@section('pageTitle', __('basket.meta_title_shipping') )
@section('pageDesc', __('basket.meta_description_shipping') )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
  var URL_CHANGE_COUNTRY = '{{ route("basket_country") }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/jquery.tmpl.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/shipping.js') }}"></script>
@parent    
@stop

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
  <div class="bg-gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h1 class="module-title font-alt">{{ __('basket.meta_title_shipping') }}</h1>
          <div class="module-subtitle font-serif mb-0"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<hr class="divider-w">
<section class="module shipping">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        
        <form method="POST" action="{{ route('basket_shipping') }}" autocomplete="off">
          
          @if (count($errors) > 0)
          <div class="alert alert-danger toppage-slider">
            <div class="alert-container">
            {!!__('basket.error_header') !!}
              {{-- <br /><ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul> --}}
              <a class="alert-close-icon" href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20"><path fill="#fff" d="M11.4 10l6.3-6.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L10 8.6 3.7 2.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4L8.6 10l-6.3 6.3c-.4.4-.4 1 0 1.4s1 .4 1.4 0l6.3-6.3 6.3 6.3c.4.4 1 .4 1.4 0s.4-1 0-1.4L11.4 10z"></path><path d="M17 2c.3 0 .5.1.7.3.4.4.4 1 0 1.4L11.4 10l6.3 6.3c.4.4.4 1 0 1.4-.2.2-.4.3-.7.3-.3 0-.5-.1-.7-.3L10 11.4l-6.3 6.3c-.2.2-.4.3-.7.3s-.5-.1-.7-.3c-.4-.4-.4-1 0-1.4L8.6 10 2.3 3.7c-.4-.4-.4-1 0-1.4.2-.2.4-.3.7-.3s.5.1.7.3L10 8.6l6.3-6.3c.2-.2.4-.3.7-.3m0-1c-.5 0-1 .2-1.4.6L10 7.2 4.4 1.6C4 1.2 3.5 1 3 1s-1 .2-1.4.6c-.8.8-.8 2 0 2.8L7.2 10l-5.6 5.6c-.8.8-.8 2 0 2.8.4.4.9.6 1.4.6s1-.2 1.4-.6l5.6-5.6 5.6 5.6c.4.4.9.6 1.4.6.5 0 1-.2 1.4-.6.8-.8.8-2 0-2.8L12.8 10l5.6-5.6c.8-.8.8-2 0-2.8-.4-.4-.9-.6-1.4-.6z" opacity=".1"></path></svg>
              </a>
            </div>
          </div>
          @endif

          <div class="box">
            <div class="row">
            <h3>{{ __('basket.header') }}</h3>
            <h6>{{ __('basket.header_sub') }}</h6>
            <hr class="divider-w divider-p">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
                  <label for="fullname">{{ __('basket.label_fullname') }}</label>
                  <input type="text" id="fullname" name="fullname" class="form-control" placeholder="{{ __('basket.placeholder_fullname') }}" value="{{ old('fullname') }}">
                  <span class="text-danger">{{ $errors->first('fullname') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                  <label for="address">{{ __('basket.label_address') }}</label>
                  <input type="text" id="address" name="address" class="form-control" placeholder="{{ __('basket.placeholder_address') }}" value="{{ old('address') }}">
                  <span class="text-danger">{{ $errors->first('address') }}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                  <label for="fullname">{{ __('basket.label_city') }}</label>
                  <input type="text" id="city" name="city" class="form-control" placeholder="{{ __('basket.placeholder_city') }}" value="{{ old('city') }}">
                  <span class="text-danger">{{ $errors->first('city') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('zip') ? 'has-error' : '' }}">
                  <label for="address">{{ __('basket.label_zip') }}</label>
                  <input type="text" id="zip" name="zip" class="form-control" placeholder="{{ __('basket.placeholder_zip') }}" value="{{ old('zip') }}">
                  <span class="text-danger">{{ $errors->first('zip') }}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                  <label for="mobileno">{{ __('basket.label_country') }}</label>
                  <select id="country" name="country" class="form-control country-code" style="background-image: url(/img/ico/ico-{{ old('country') }}.png)">
                  <option value="">{{ __('global.choose') }}</option>
                    @foreach( $countries as $country )
                    <option 
                      value="{{ $country->iso }}" 
                      @if ($country->iso == old('country'))
                        selected="selected"
                      @endif
                    >{!! $country->{app()->getLocale()} !!}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">{{ $errors->first('country') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                  <label for="email">{{ __('basket.label_email') }}</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="{{ __('basket.placeholder_email') }}" value="{{ old('email') }}">
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">&nbsp;</div>
              <div class="col-md-6">
                @if (Auth::check())
                <div class="form-group checkbox {{ (old('save_address') && $errors->first('address_name')) ? 'has-error' : '' }}">  
                  <input type="checkbox" name="save_address" id="save_address" value="1"
                  @if( old('save_address') ) checked="checked" @endif
                  /> <label>{{ __('basket.save_address') }}</label>                
                  <div id="address_name_div">
                    <label for="email">{{ __('basket.label_address_name') }}</label>
                    <input type="text" id="address_name" name="address_name" class="form-control" placeholder="{{ __('basket.placeholder_address_name') }}" value="{{ old('address_name') }}">
                    @if( old('save_address') )
                    <span class="text-danger">{{ $errors->first('address_name') }}</span>
                    @endif
                  </div>
                </div>  
                @endif
              </div>
            </div>

          </div>
          
          <div class="box">
            
          <div class="row">
            <div class="col-md-5">
              <div class="row">
                <h3>{{ __('basket.header_delivery') }}</h3>
                <h6>{{ __('basket.header_sub_delivery') }}</h6>
                <hr class="divider-w divider-p">
                <div id="delivery-container" class="col-md-12 col-sm-12 delivery {{ $errors->has('delivery_type') ? 'has-error' : '' }}">
                  @foreach( $deliveries as $delivery )
                  <div class="form-group delivery-option">
                    <div class="row">
                      <div class="option-col option-radio">
                        <input type="radio" name="delivery_type" id="delivery_type" value="{{ $delivery->id }}" data-price="{{ $delivery->d_price }}" 
                        @if( old('delivery_type') == $delivery->id )
                        checked="checked"
                        @endif
                        />
                      </div>
                      <div class="option-col option-ico">
                        <img src="/img/ico/{{ $delivery->d_icon }}.svg" alt="" />
                      </div>
                      <div class="option-col">
                        <label>{{ __('basket.'.$delivery->d_name) }} ({{ $delivery->d_price }})</label>
                        <p>{{ __('basket.'.$delivery->d_desc) }}</p>
                        <p>{{ __('basket.'.$delivery->d_time) }}</p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <span class="text-danger">{{ $errors->first('delivery_type') }}</span>
              </div>

              

            </div>

            <div class="col-md-2"></div>

            <div class="col-md-5">
            <div class="row">
                <h3>{{ __('basket.header_payment') }}</h3>
                <h6>{{ __('basket.header_sub_payment') }}</h6>
                <hr class="divider-w divider-p">
                <div id="payment-container" class="col-md-12 col-sm-12 payment {{ $errors->has('payment_type') ? 'has-error' : '' }}">
                  @foreach( $payments as $payment )
                  <div class="form-group payment-option">
                    <div class="row">
                      <div class="option-col option-radio">
                        <input type="radio" name="payment_type" id="payment_type" value="{{ $payment->id }}" data-code="{{ $payment->code }}" 
                        @if( old('payment_type') == $payment->id )
                        checked="checked"
                        @endif
                        />
                      </div>
                      <div class="option-col option-ico">
                        <img src="/img/ico/{{ $payment->icon }}" alt="" />
                      </div>
                      <div class="option-col">
                        <label>{{ __('basket.'.$payment->name) }}</label>
                        <p>{{ __('basket.'.$payment->desc) }}</p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <span class="text-danger">{{ $errors->first('payment_type') }}</span>
              </div>
            </div>
          </div>

          </div>
          

          <div class="box">
          <div class="row">
                <h3>{{ __('basket.header_summary') }}</h3>
                <h6>{{ __('basket.header_sub_summary') }}</h6>
                <div>
                  @php
                  $total = 0;
                  foreach( $cart as $item ){
                    //echo 'p='.$item->price;
                    $total += $item->totalPrice( $item->price );
                  }
                  @endphp
                  <table class="table table-bordered">
                  <tr>
                    <th width="50%">{{ __('basket.summary_total') }}</th>
                    <td class="summary_products" id="summary_products">{{ $total }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('basket.summary_shipping') }}</th>
                    <td class="summary_shipping" id="summary_shipping">0.00</td>
                  </tr>
                  <tr>
                    <th>{{ __('basket.summary_discount') }}</th>
                    <td class="summary_discount" id="summary_discount">0.00</td>
                  </tr>
                  <tr>
                    <th>{{ __('basket.summary_to_pay') }}</th>
                    <td class="summary_to_pay" id="summary_to_pay">{{ $total }}</td>
                  </tr>
                  </table>
                </div>
              </div>
          </div>

          @if( !Auth::check() )
          <div class="row" style="margin-top:30px;">
          <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="form-group agreement-option {{ ($errors->has('agreement_1') || $errors->has('agreement_2')) ? 'has-error' : '' }}">
                <div class="row">
                  <div class="option-col option-checkbox">
                    <input type="checkbox" name="agreement_1" id="agreement_1" value="1"
                    @if( old('agreement_1') == 1 )
                      checked="checked"
                    @endif
                     /> 
                  </div>
                  <div class="option-col option-label">{{ __('basket.agreement_1_text') }}</div>
                  <span class="text-danger">{{ $errors->first('agreement_1') }}</span>
                </div>
                <div class="row">
                  <div class="option-col option-checkbox">
                  <input type="checkbox" name="agreement_2" id="agreement_2" value="1"
                    @if( old('agreement_2') == 1 )
                      checked="checked"
                    @endif
                     /> 
                  </div>
                  <div class="option-col option-label">{{ __('basket.agreement_2_text') }}</div>
                  <span class="text-danger">{{ $errors->first('agreement_2') }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-1"></div>
          </div>
          @else
          <input type="hidden" name="agreement_1" id="agreement_1" value="1" />
          <input type="hidden" name="agreement_2" id="agreement_2" value="1" /> 
          @endif

          <div class="row" style="margin-top:30px;">
            <hr class="divider-w divider-p">
            <div class="col-md-6">
              <div class="form-group">
                <a href="{{ route('basket') }}" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('global.btn_back') }}</a>
              </div>  
            </div>
            <div class="col-md-6">
              <div class="form-group text-right">
                <button class="btn btn-primary">{{ __('basket.label_btn') }} <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
              </div>  
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</section>

<script id="delivery-option-template" type="text/x-jquery-tmpl">
<div class="form-group delivery-option">
  <div class="row">
    <div class="option-col option-radio">
      <input type="radio" name="delivery_type" id="delivery_type" value="${id}" />
    </div>
    <div class="option-col option-ico">
      <img src="/img/ico/${icon}.svg" alt="" />
    </div>
    <div class="option-col">
      <label>${name} (${price})</label>
      <p>${desc}</p>
      <p>${time}</p>
    </div>
  </div>
</div>
</script>

@endsection  