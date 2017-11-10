<nav class="navbar navbar-custom navbar-transparent navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="header-container">
      <div class="navbar-header">
        <div class="shop_isle_header_title">
          <div class="shop-isle-header-title-inner">
            <h1 class="site-title">
              <a href="{{ route('home') }}" title="{{ config('app.name', 'MGNTD') }}" rel="home">
                <img src="/img/magnetoid-logo-white-full.svg" alt="" />
              </a>
            </h1>
            <p class="site-description">
              <a href="/" title="{{ config('app.name', 'MGNTD') }}" rel="home"></a>
            </p>
          </div>
        </div>
        <div type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse"> 
          <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        </div>
      </div>
      <div class="header-menu-wrap">
        <div class="collapse navbar-collapse" id="custom-collapse">
          <ul class="nav navbar-nav navbar-right">
          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
              <a href="{{ route('product') }}" title="{{ __('products.navigation_label') }}">{{ __('products.navigation_label') }}</a>
              <?php /*<ul class="sub-menu">
                <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat">
                  <a href="">Magnesy</a>
                </li>
              </ul>*/ ?>
            </li>
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li><a href="{{ route('login') }}" title="{{ __('auth.link_login') }}">{{ __('auth.link_login') }}</a></li>
            <li><a href="{{ route('register') }}" title="{{ __('auth.link_register') }}">{{ __('auth.link_register') }}</a></li>
            @else
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
              <a href="#" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{ route('logout') }}" title="{{ __('auth.link_logout') }}" 
                      onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      {{ __('auth.link_logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
            </li>
            @endif
            <!-- I18n Switch Links -->
            @if (count(config('app.alt_langs'))>0)
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
              <a href="#" title="{{ strtoupper(app()->getLocale()) }}">{{ strtoupper(app()->getLocale()) }}</a>
              <ul class="sub-menu">
              @foreach (config('app.all_langs') as $lang)
              @if( $lang != app()->getLocale())
                <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat">
                  <a href="{{ route('home', [], true, $lang) }}">{{ strtoupper($lang) }}</a>
                </li>
              @endif
              @endforeach
              </ul>
            </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="navbar-cart">
        <?php /*<div class="header-search">
          <div class="glyphicon glyphicon-search header-search-button"></div>
          <div class="header-search-input">
            <form role="search" method="get" class="woocommerce-product-search" action="">
              <input type="search" class="search-field" placeholder="Search Products&hellip;" value="" name="s" title="Search for:" />
              <input type="submit" value="Search" />
              <input type="hidden" name="post_type" value="product" />
            </form>
          </div>
        </div>*/ ?>
        <div class="navbar-cart-inner">
          <a href="{{ route('basket') }}" title="{{ __('basket.navigation_link_title') }}" class="cart-contents"> 
            <span class="icon-basket"></span> 
            <span class="cart-item-number">0</span> 
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>