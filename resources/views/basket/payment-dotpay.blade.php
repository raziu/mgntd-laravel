@if( count( $paymentOptions ) > 0 )
<h3>{{ __('order.dotpay_payment_header') }}</h3>
<div class="gray-bg payment-dotpay">
  @foreach( $paymentOptions as $option )
  <div class="payment-dotpay-option">
    <a href="javascript:void(0);" title="{{ $option->name }}" class="link-tile dotpay-link" data-canal="{{ $option->code }}" data-type="dotpay" data-hash="{{ $orderHash }}">
      <img src="{{ $option->icon }}" alt="" style="max-width:125px;"/>
    </a>
  </div>
  @endforeach
</div>
@endif