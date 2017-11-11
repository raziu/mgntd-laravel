<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$all_langs = config('app.all_langs');
/**
* Iterate over each language prefix 
*/
foreach( $all_langs as $prefix )
{  
  if ($prefix == 'pl') $prefix = '';
  /**
    * Register new route group with current prefix
    */
  Route::group(['prefix' => $prefix], function() use ($prefix) 
  {
    // Now we need to make sure the default prefix points to default  lang folder.
    if ($prefix == '') $prefix = 'pl';
    /**
     * The following line will register:
     *
     * example.com/
     * example.com/en/
     */
    Route::get('/', 'HomeController@getHome')->name($prefix.'_home');
  
    /**
     * The following line will register:
     *
     * example.com/kontakt
     * example.com/en/contact
     */
    Route::get(Lang::get('routes.contact',[], $prefix) , 'HomeController@getContact')->name($prefix.'_contact');

    /**
     * The following line will register:
     *
     * example.com/koszyk
     * example.com/en/basket
     */
    Route::get(Lang::get('routes.basket',[], $prefix) , 'BasketController@index')->name($prefix.'_basket');
  
    /**
     * The following line will register:
     *
     * example.com/info
     * example.com/en/info
     */
    Route::get(Lang::get('routes.info',[], $prefix) , 'InfoController@index')->name($prefix.'_info');
    Route::get(Lang::get('routes.info/privacy',[], $prefix) , 'InfoController@privacy')->name($prefix.'_info_privacy');
    Route::get(Lang::get('routes.info/regulations',[], $prefix) , 'InfoController@regulations')->name($prefix.'_info_regulations');
    Route::get(Lang::get('routes.info/payment',[], $prefix) , 'InfoController@payment')->name($prefix.'_info_payment');

    /**
     * The following line will register:
     *
     * example.com/produkty
     * example.com/en/products
     */
    Route::get(Lang::get('routes.products',[], $prefix) , 'ProductController@index')->name($prefix.'_product');

    // Override Auth default Routes...
    //Auth::routes();
    $this->get(Lang::get('routes.login',[], $prefix), 'Auth\LoginController@showLoginForm')->name($prefix.'_login');
    $this->post(Lang::get('routes.login',[], $prefix), 'Auth\LoginController@login');
    $this->post(Lang::get('routes.logout',[], $prefix), 'Auth\LoginController@logout')->name($prefix.'_logout');
    // Registration Routes...
    $this->get(Lang::get('routes.register',[], $prefix), 'Auth\RegisterController@showRegistrationForm')->name($prefix.'_register');
    $this->post(Lang::get('routes.register',[], $prefix), 'Auth\RegisterController@register');
    // Password Reset Routes...
    $this->get(Lang::get('password/reset',[], $prefix), 'Auth\ForgotPasswordController@showLinkRequestForm')->name($prefix.'_password.request');
    $this->post(Lang::get('password/email',[], $prefix), 'Auth\ForgotPasswordController@sendResetLinkEmail')->name($prefix.'_password.email');
    $this->get(Lang::get('password/reset/{token}',[], $prefix), 'Auth\ResetPasswordController@showResetForm')->name($prefix.'_password.reset');
    $this->post(Lang::get('password/reset',[], $prefix), 'Auth\ResetPasswordController@reset');

    //social routes
    Route::get(Lang::get('/instagram/redirect',[], $prefix), 'SocialAuthInstagramController@redirect')->name($prefix.'_instagram_redirect');
    Route::get(Lang::get('/instagram/callback',[], $prefix), 'SocialAuthInstagramController@callback')->name($prefix.'_instagram_callback');
    //
    Route::get(Lang::get('/facebook/redirect',[], $prefix), 'SocialAuthFacebookController@redirect')->name($prefix.'_facebook_redirect');
    Route::get(Lang::get('/facebook/callback',[], $prefix), 'SocialAuthFacebookController@callback')->name($prefix.'_facebook_callback');

    /**
     * “In another moment down went Alice after it, never once 
     * considering how in the world she was to get out again.”
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () use ($prefix)
    {
      /**
        * The following line will register:
        *
        * example.com/admin/uzivatelia
        * example.com/en/admin/users
        */
      //Route::get(Lang::get('routes.admin.users',[], $prefix), 'AdminController@getUsers')
      //->name($prefix.'_admin-users');
  
    });
  });
}
  
  /**
  * There might be routes that we want to exclude from our language setup.
  * For example these pesky ajax routes! Well let's just move them out of the `foreach` loop.
  * I will get back to this later.
  */
  Route::group(['middleware' => 'ajax', 'prefix' => 'api'], function () {
      /**
      * This will only register example.com/api/login
      */
      //Route::post('login', 'AjaxController@login')->name('ajax-login');
  });

  


/*
 *  Set up locale and locale_prefix if other language is selected
 */
/*if (in_array(Request::segment(1), Config::get('app.alt_langs'))) 
{  
  App::setLocale(Request::segment(1));
  Config::set('app.locale_prefix', Request::segment(1));
}*/
/*
 * Set up route patterns - patterns will have to be the same as 
 * in translated route for current language
 */
/*foreach( Lang::get('routes') as $k => $v) 
{
  Route::pattern($k, $v);
}*/

/*Route::group(array('prefix' => Config::get('app.locale_prefix')), function()
{
    Route::get(
        '/',
        function () {
            return "main page - ".App::getLocale();
        }
    )->name('home-'.App::getLocale());


    Route::get(
        '/{contact}/',
        function () {
            return "contact page ".App::getLocale();
        }
    );



    Route::get(
        '/{about}/',
        function () {
            return "about page ".App::getLocale();

        }
    );

    Route::get(
      '/{basket}/',
      function () {
          return "basket page ".App::getLocale();

      }
  );

});*/

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/basket', 'BasketController@index')->name('basket');
Route::post('/basket/add', 'BasketController@create');
Route::get('/basket/{basket}', 'BasketController@edit');
Route::post('/basket/{basket}', 'BasketController@update'); */