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
    if(UserArea::whereUserId(auth()->user()->id)
      ->whereAreaId($area->id)
      ->first()
    ) return (object)[
      'result' => false,
      'response' => 'Você já está vinculado a esse condomínio'
    ];

    UserArea::create([
      'user_id' => auth()->user()->id,
      'area_id' => $area->id
    ]);
    
    auth()->user()->update([
      'active_area_id' => auth()->user()->id
    ]);

    return (object)[
      'result' => true,
      'response' => 'Usuário se vinculou ao condomínio com sucesso'
    ];
  }
  #endregion STATIC FUNCTIONS
}