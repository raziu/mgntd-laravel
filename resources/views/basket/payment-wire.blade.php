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
  <p><a href="{{ route('home') }}">{{ __('global.btn_back_home') }}</a></p>
</div>
