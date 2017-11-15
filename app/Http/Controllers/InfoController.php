<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }
  public function index()
  {
    return view('info.index', compact('user'));
  }
  public function privacy()
  {
    return view('info.privacy', compact('user'));
  }
  public function regulations()
  {
    return view('info.regulations', compact('user'));
  }
  public function payment()
  {
    return view('info.payment', compact('user'));
  }
}
