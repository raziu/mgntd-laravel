<?php
/**
 * ERROR HANDLER Controller
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;


class ErrorHandlerController extends Controller
{
    public function errorCode404()
    {
    	return view('errors.404');
    }

    public function errorCode405()
    {
    	return view('errors.405');
    }
}