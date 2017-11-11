<div class="bottom-page-wrap">
  <footer class="footer">
      <div class="container">
          <div class="row">
              <div class="col-sm-5">
                <img src="/img/magnetoid-logo-footer-full.svg" alt="{{ config('app.name', 'MGNTD') }}" style="max-width:150px;" /><br/>
                <strong></strong> {!! __('global.footer_powered_by') !!}
              </div>
              <div class="col-sm-3">
                <ul class="footer-links nav navbar-nav">
                  <li>
                    <a href="{{ route('info_payment') }}">{{ __('info.meta_title_payment') }}</a>
                  </li>
                  <li>
                    <a href="{{ route('info_regulations') }}">{{ __('info.meta_title_regulations') }}</a>
                  </li>
                  <li>
                    <a href="{{ route('info_privacy') }}">{{ __('info.meta_title_privacy') }}</a>
                  </li>
                </ul>
              </div>
              <div class="col-sm-3">
                <ul class="footer-links nav navbar-nav">
                  <li>
                    <a href="{{ route('home') }}">{{ __('home.meta_title') }}</a>
                  </li>
                  <li>
                    <a href="{{ route('product') }}">{{ __('products.meta_title') }}</a>
                  </li>
                  <li>
                    <a href="{{ route('basket') }}">{{ __('basket.meta_title') }}</a>
                  </li>
                </ul>
              </div>
              <div class="col-sm-1">
                  <div class="footer-social-links">
                    <a href="#" target="_blank"><span class="social_facebook"></span></a>
                    <a href="#" target="_blank"><span class="social_instagram"></span></a>
                  </div>
              </div>
          </div>
          <hr class="divider-d">
          <div class="row">
            <div id="catapult-cookie-bar" class="">
              <div class="ctcc-inner ">
                  {{ __('global.cookies_info') }} 
                  <a class="ctcc-more-info-link" tabindex=0 href="{{route('info_privacy')}}" title="{{ __('global.cookies_details_link_label') }}">{{ __('global.cookies_details_link_label') }}</a>
                  <button class="btn btn-default" id="catapultCookie" tabindex=0 onclick="catapultAcceptCookies();">{{ __('global.cookies_agree_label') }}</button>
              </div>
            </div>
          </div>
      </div>
  </footer>
</div>