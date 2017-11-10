<nav class="navbar navbar-custom navbar-transparent navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="header-container">
      <div class="navbar-header">
        <div class="shop_isle_header_title">
          <div class="shop-isle-header-title-inner">
            <h1 class="site-title"><a href="/" title="ShopIsle" rel="home">{{ config('app.name', 'MGNTD') }}</a></h1>
            <p class="site-description">
              <a href="/" title="ShopIsle" rel="home"></a>
            </p>
          </div>
        </div>
        <div type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse"> 
          <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        </div>
      </div>
      <div class="header-menu-wrap">
        <div class="collapse navbar-collapse" id="custom-collapse">
          <ul id="menu-menu-1" class="nav navbar-nav navbar-right">
            <li class="menu-item menu-item-type-post_type menu-item-object-page">
              <a href="/">About</a>
            </li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page">
              <a href="/">Contact</a>
            </li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
              <a href="/">Products</a>
              <ul class="sub-menu">
                <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat">
                  <a href="">Magnesy</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="navbar-cart">
        <div class="header-search">
          <div class="glyphicon glyphicon-search header-search-button"></div>
          <div class="header-search-input">
            <form role="search" method="get" class="woocommerce-product-search" action="">
              <input type="search" class="search-field" placeholder="Search Products&hellip;" value="" name="s" title="Search for:" />
              <input type="submit" value="Search" />
              <input type="hidden" name="post_type" value="product" />
            </form>
          </div>
        </div>
        <div class="navbar-cart-inner">
          <a href="#" title="View your shopping cart" class="cart-contents"> <span class="icon-basket"></span> <span class="cart-item-number">0</span> </a>
        </div>
      </div>
    </div>
  </div>
</nav>

<?php /*<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'MGNTD') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- I18n Switch Links -->
                @if (count(config('app.alt_langs'))>0)
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }} <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                  @foreach (config('app.all_langs') as $lang)
                  @if( $lang != app()->getLocale())
                    <li>
                      <a href="{{ route('home', [], true, $lang) }}">{{ strtoupper($lang) }}</a>
                    </li>
                  @endif
                  @endforeach
                  </ul>
                </li>
                @endif
                <!-- Basket Link -->
                <li><a href="{{ route('basket') }}">{{ __('basket.navigation_link') }}</a></li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">{{ __('auth.link_login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('auth.link_register') }}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    {{ __('auth.link_logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>*/ ?>