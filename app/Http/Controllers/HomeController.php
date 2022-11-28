<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Work;

class HomeController extends Controller
{
  public function index(){
    $now = Carbon::now();
    $month = $now->format('m');
    $year = $now->format('Y');

    $query = Work::whereStatus('requested');
    $works = $query->get();
    $requestedInThisMonth = $query->whereMonth('created_at', $month)
      ->whereYear('created_at', $year)
      ->count();


    $query = Work::whereStatus('ended');
    $finalizedWorks = $query->get();
    $finalizedInThisMonth = $query->whereMonth('created_at', $month)
      ->whereYear('created_at', $year)
      ->count();

    return view('home.index',[
      'works' => $works,
      'finalizedWorks' => $finalizedWorks,
      'requestedInThisMonth' => $requestedInThisMonth,
      'finalizedInThisMonth' => $finalizedInThisMonth
    ]);
  }
  public function welcome(){
    $areas = AreaController::getAreas();

    return view('welcome.index',[
      'areas' => $areas
    ]);
  }
}