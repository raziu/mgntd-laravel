<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
  public function index()
  {
    return view('info.index', compact('user'));
  }
  public function privacy()
  {
    return view('info.privacy', compact('user'));
  }
}
