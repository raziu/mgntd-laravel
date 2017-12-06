<?php
/**
 * ROUTES EN translations
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */

return array(
    'contact' => 'contact',
    'about'   => 'about-us',
    'basket'  => 'cart',
    'basket/add' => 'cart/add',
    'basket/update' => 'cart/update',
    'basket/shipping' => 'cart/shipping',
    'basket/validation' => 'cart/validation',
    'basket/payment/{payment}/{hash}' => 'cart/payment/{payment}/{hash}',
    'basket/country' => 'cart/country',
    'basket/address' => 'basket/address',
    'basket/payment_options' => 'cart/payment-options',
    //
    'profile' => 'my-profile',
    'profile/orders' => 'my-orders',
    'profile/address/{id}' => 'edit-address/{id}',
    //
    'order/pay' => 'order/pay',
    'order/status' => 'order/status',
    'order/placed/{hash}/{pin}' => 'order/placed/{hash}/{pin}',
    'order/view/{hash}/{pin}' => 'order/view/{hash}/{pin}',
    'order/repay/{payment}/{hash}/{pin}' => 'order/repay/{payment}/{hash}/{pin}',
    //
    'login'   => 'login',
    'logout'   => 'logout',
    'register'   => 'register',
    'password/reset'   => 'password/reset',
    'password/email'   => 'password/email',
    'password/reset/{token}' => 'password/reset/{token}',
    'products'  => 'products',
    'info'  => 'info',
    'info/privacy'  => 'info/privacy',
    'info/regulations'  => 'info/regulations',
    'info/payment'  => 'info/payment',
    'subscribers/submit' => 'subscribers/submit',
    'change/currency' => 'change/currency',
    //
    'product/{group}/{type}' => 'add/{group}/{type}',
    'product/s3' => 'product/s3',
    //
    'instagram/redirect' => 'instagram/redirect',
    'instagram/callback' => 'instagram/callback',
    'facebook/redirect' => 'facebook/redirect',
    'facebook/callback' => 'facebook/callback',
);