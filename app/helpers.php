<?php
/**
 * CUSTOM HELPERS used in app
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
//Same parameters and a new $lang parameter
function route($name, $parameters = [], $absolute = true, $lang = null)
{
    /*
    * Remember the ajax routes we wanted to exclude from our lang system?
    * Check if the name provided to the function is the one you want to
    * exclude. If it is we will just use the original implementation.
    **/
    if (str_contains($name, ['ajax', 'autocomplete'])){
        return app('url')->route($name, $parameters, $absolute);
    }

   //Check if $lang is valid and make a route to chosen lang
   //if ( $lang && in_array($lang, config('app.alt_langs')) ){
   if ( $lang && in_array($lang, config('app.all_langs')) ){
      //echo $lang.'_'.$name; exit;
      return app('url')->route($lang . '_' . $name, $parameters, $absolute);
   }
    //echo __LINE__; exit;
    /**
    * For all other routes get the current locale_prefix and prefix the name.
    */
    $locale_prefix = config('app.locale_prefix');
    if ($locale_prefix == '') $locale_prefix = 'pl';

    //echo $locale_prefix.'_'.$name; exit;
    //echo "<!-- route: ".$locale_prefix.'_'.$name."   -->\n";

    return app('url')->route($locale_prefix . '_' . $name, $parameters, $absolute);
}
/**
 * Custom helper for plural translations
 */
if (!function_exists('variety')) 
{
  function variety( $number, $varietyFor1, $varietyFor234, $varietyForOthers )
  {
    if( $number == 1 )
    {
      return $varietyFor1;
    }
    if( $number % 100 >= 10 && $number % 100 <= 20 )
    {
      return $varietyForOthers;
    }
    if( in_array( $number % 10, array( 2, 3, 4 ) ) )
    {
      return $varietyFor234;
    }
    return $varietyForOthers;
  }
}
