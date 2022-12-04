<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
  public function index(){
    $areas = Area::whereUserId(auth()->user()->id)->get()->map(function($area){
      return $area->loadData();
    });

    return view('area.index',[
      'areas' => $areas
    ]);
  }
  public function edit($slug){
    if(!$area = Area::whereSlug($slug)->whereUserId(
      auth()->user()->id
    )->first()) return $this->sweet(
      redirect()->back(),
      'Condomínio não encontrado, ou você não ter permissão de alterá-lo',
      'error',
      'Editar Condomínio'
    );

    $address = $area->getAddress();

    if(isset($address->street)) $area->street = $address->street;
    if(isset($address->number)) $area->number = $address->number;
    if(isset($address->district)) $area->district = $address->district;
    if(isset($address->city)) $area->city = $address->city;
    if(isset($address->state)) $area->state = $address->state;
    if(isset($address->complement)) $area->complement = $address->complement;

    return view('area.create.index',[
      'area' => $area
    ]);
  }
  public function show($slug){
    if(!$area = Area::whereSlug($slug)->first()) return $this->sweet(
      redirect()->back(),
      'Condomínio não encontrado',
      'error',
      'Detalhes do Condomínio'
    );

    $area->loadData(['services']);
    $categories = $area->getCategoriesIncluded();

    return view('area.show',[
      'area' => $area,
      'categories' => $categories
    ]);
  }
  public function create(){
    return view('area.create.index');
  }
  public function store(Request $request){
    #region VALIDATION
    $errors = [];
    if(!$request->name) $errors[]= "Preencha o nome";
    if(!$request->description) $errors[]= "Preencha a descrição";
    if(!$request->code) $errors[]= "Insira o CEP";
    if(!$request->street) $errors[]= "Preencha o nome da rua";
    // if(!$request->number) $errors[]= ""; -- NUMERO É OPCIONAL
    if(!$request->district) $errors[]= "Preencha o nome do bairro";
    if(!$request->city) $errors[]= "Preencha o nome da cidade";
    if(!$request->state) $errors[]= "Preencha a sigla do estado";
    // if(!$request->complement) $errors[]= ""; -- COMPLEMENTO É OPCIONAL
    if(!$request->image_name) $errors[]= "Insira uma foto do conominío";

    if(count($errors) > 0) return $this->sweet(
      redirect()->back(),
      'Alguns campos obrigatórios não foram preenchidos:<br/>- ' . implode('<br/>- ', $errors),
      'error',
      'Salvando Condomínio'
    );

    $area = null;
    if($request->area_id){
      if(!$area = Area::whereId($request->area_id)->whereUserId(
        auth()->user()->id
      )->first()) return $this->sweet(
        redirect()->back(),
        'Condomínio não encontrado ou você não tem permissão de editá-lo',
        'error',
        'Editar Condomínio'
      );
    }
    #endregion VALIDATION

    $slug = $area ? $area->slug : Area::generateSlug($request->name);
    $data = [
      'slug' => $slug,
      'name' => $request->name,
      'description' => $request->description,
      'code' => $request->code,
    ];

    #region ADDRESS
    $address = [
      'code' => $request->code,
      'street' => $request->street,
      'number' => $request->number ?? null,
      'district' => $request->district,
      'city' => $request->city,
      'state' => $request->state,
      'complement' => $request->complement ?? null
    ];
    $data+= ['address' => json_encode($address)];
    #endregion ADDRESS

    #region IMAGE
    $path = 'uploads/areas/';
    $resImage = Controller::handleUploadImage(
      $request->image_name,
      $path
    );
    if($resImage->result) $data+= ['image' => $resImage->response];
    else return $this->sweet(
      redirect()->back(),
      $resImage->response,
      'error',
      'Salvando Condomínio'
    );
    #endregion IMAGE

    $area = Area::updateOrCreate([
      'id' => $request->area_id ?? null
    ],$data);

    UserAreaController::storeUserArea($area->id);

    return $this->toast(
      redirect()->route('home'),
      'Condomínio salvo com sucesso',
      'success',
      'Salvando Condomínio'
    );
  }
  public function get(Request $request, $json = true){
    // FAZER TRATAMENTO DOS DADOS
    return response()->json(
      self::getAreas($request->skip)
    );
  }
  public static function getAreas($skip = 0, $take = 6){
    $query = Area::orderByDesc('updated_at');
    if($take != null && $take > 0) $query->skip($skip)->take($take);    

    return $query->get()->map(function($area){
      return $area->loadData();
    });
  }
}