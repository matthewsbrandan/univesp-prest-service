<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaController extends Controller
{
  public function index(){

  }
  public function create(){
    return view('area.create.index');
  }
  public function store(Request $request){
    dd($request->all());
  }
}