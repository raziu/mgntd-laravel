<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request; //replaced to above
use Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Subscribers;

class SubscribersController extends Controller
{
  //The method to show the form to add a new feed
  public function getIndex() 
  {
    //We load a view directly and return it to be served
    return View::make('subscribe_form');
  }

  //This method is to process the form
  public function postSubmit() 
  {
    //we check if it's really an AJAX request
    if(Request::ajax()) 
    {  
      $validation = Validator::make(Input::all(), array(
        //email field should be required, should be in an email//format, and should be unique
        'email' => 'required|email|unique:subscribers,email'
      )
      );
      if($validation->fails()) 
      {
        return response()->json([
          'response' => __('home.newsletter_save_error_pre').$validation->errors()->first(), 
          'status' => 'error'
          ]);
      } 
      else 
      {
        $create = Subscribers::create(
          [
          'email' => Input::get('email')
          ]
        );
        if( $create )
        {
          return response()->json([
            'response' => __('home.newsletter_saved'), 
            'status' => 'success'
            ]);
        }
        else
        {
          return response()->json([
            'response' => __('home.newsletter_save_error_pre').__('home.newsletter_save_error'), 
            'status' => 'error'
            ]);
        }
      }
    } 
    else 
    {
      return Redirect::to('subscribers');
    }
  }
}
