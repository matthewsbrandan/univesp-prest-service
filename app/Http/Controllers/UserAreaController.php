<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Area;
use App\Models\UserArea;

class UserAreaController extends Controller
{
  public function store($id){
    $data = self::storeUserArea($id);
    if(!$data->result) return $this->sweet(
      redirect()->back(),
      $data->response,
      'error',
      'Vincular ao condomínio'
    );

    return $this->toast(
      redirect()->route('home'),
      $data->response,
      'success',
      'Vincular ao condomínio'
    );
  }
  #region STATIC FUNCTIONS
  public static function storeUserArea($area_id){
    if(!$area = Area::whereId($area_id)->first()) return (object)[
      'result' => false,
      'response' => 'Condomínio não encontrado'
    ];

    $userArea = UserArea::whereUserId(auth()->user()->id)
      ->whereAreaId($area->id)
      ->first();
  
    if($userArea && $userArea->id == auth()->user()->active_area_id) return (object)[
      'result' => false,
      'response' => 'Esse condomínio já está vinculado e selecionado como principal'
    ];

    if(!$userArea) $userArea = UserArea::create([
      'user_id' => auth()->user()->id,
      'area_id' => $area->id
    ]);
    
    auth()->user()->update([
      'active_area_id' => $area->id
    ]);

    return (object)[
      'result' => true,
      'response' => 'Usuário se vinculou ao condomínio com sucesso'
    ];
  }
  #endregion STATIC FUNCTIONS
}