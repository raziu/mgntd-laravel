<h6 class="text-center">{{ __('order.header_wire') }}</h6>
<h3>{{ __('order.header_wire_sub') }}</h3>
<hr class="divider-w divider-p">
<div class="payment-wire">
  <h4>{{ __('order.wire_acknowledgement') }}</h4>
  <p>{{ __('order.wire_info') }}</p>
  <div class="company-info">{!! __('order.company_info') !!}</div>
  <p>{!! __('order.wire_payment_title_info', ['orderHash' => $orderHash]) !!}</p>
  <p class="tip">{{ __('order.wire_tip') }}</p>
  <hr class="divider-w divider-p">
  <div class="row">
    <div class="col-md-6">
      <p><a href="{{ route('home') }}">{{ __('global.btn_back_home') }}</a></p>
    </div>
    <div class="col-md-6 text-right">
      <p><a href="{{ route('order_view',[$order->order_hash, $order->order_pin]) }}">{{ __('order.btn_view_order') }}</a></p>
    </div>
  </div>
  
</div>
