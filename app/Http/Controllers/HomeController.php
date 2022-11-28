<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(){
    $areas = AreaController::getAreas();
    return view('home.index',[
      'areas' => $areas
    ]);
  }
  public function welcome(){
    $areas = AreaController::getAreas();

    return view('welcome.index',[
      'areas' => $areas
    ]);
  }
}