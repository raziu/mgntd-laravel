<div class="bottom-page-wrap">
  <footer class="footer bg-dark">
      <hr class="divider-d">
      <div class="container">
          <div class="row">
              <div class="col-sm-6">
                  <p>
                    <strong>{{ config('app.name', 'MGNTD') }}</strong> {!! __('global.footer_powered_by') !!}
                  </p>
              </div>
              <div class="col-sm-6">
                  <div class="footer-social-links">
                    <a href="#" target="_blank"><span class="social_facebook"></span></a>
                    <a href="#" target="_blank"><span class="social_twitter"></span></a>
                    <a href="#" target="_blank"><span class="social_dribbble"></span></a>
                    <a href="#" target="_blank"><span class="social_skype"></span></a></div>
              </div>
          </div>
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