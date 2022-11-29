<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Work;

class HomeController extends Controller
{
  public function index(){
    $data = WorkController::getResume();
    if(!$data->result) return $this->sweet(
      redirect()->back(),
      'Houve um erro ao carregar os dados da página Home',
      'error',
      'Home'
    );
    $params = $data->response; /* @return
      [
        'works' => $works,
        'finalizedWorks' => $finalizedWorks,
        'requestedInThisMonth' => $requestedInThisMonth,
        'finalizedInThisMonth' => $finalizedInThisMonth
      ]
    */
    return view('home.index', $params);
  }
  public function welcome(){
    $areas = AreaController::getAreas(0, null);

    return view('welcome.index',[
      'areas' => $areas
    ]);
  }
}