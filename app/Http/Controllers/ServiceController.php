<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
  public function index(){
    return view('service.index');
  }
  public function show($slug){
    dd($slug);
  }
  public function create(){
    $categories = ServiceCategory::get()->map(function($category){
      return $category->loadData();
    });

    if($categories->count() == 0) return $this->sweet(
      redirect()->back(),
      'Não é possível cadastrar um novo serviço, pois não há categorias disponíveis',
      'error',
      'Cadastrar Serviço'
    );

    return view('service.create.index',[
      'categories' => $categories
    ]);
  }
  public function store(Request $request){
    #region HANDLE FILL VALIDATION
    $errors = [];
    if(!$request->name) $errors[]= 'Preencha o nome';
    if(!$request->description) $errors[]= 'Preencha a descrição';
    if(!$request->service_category_id) $errors[]= 'Selecione a categoria do serviço';  
    if(!$request->contacts || !json_decode($request->contacts)) $errors[]= 'Preencha no mínimo uma informação de contato';
    // if(!$request->instructions) -- nullable
    // if(!$request->image_name) -- nullable
    if(count($errors) > 0) return $this->sweet(
      redirect()->back(),
      'Alguns campos obrigatórios não foram preenchidos:<br/>- ' . implode(
        '<br/>- ', $errors
      ),
      'error',
      'Salvar Serviço'
    );
    #region HANDLE FILL VALIDATION

    if(!$category = ServiceCategory::whereId(
      $request->service_category_id
    )->first()) return $this->sweet(
      redirect()->back(),
      'Categoria não encontrada',
      'error',
      'Salvar Serviço'
    );

    #region HANDLE IF IS UPDATE
    $id = null;
    if($request->service_id){
      if(!$service = Service::whereId($request->service_id)
        ->whereUserId(auth()->user()->id)
        ->first()
      ) return $this->sweet(
        redirect()->back(),
        'Serviço não encontrado ou você não tem permissão para editar esse serviço',
        'error',
        'Salvar Serviço'
      );
    }
    #endregion HANDLE IF IS UPDATE
    $contacts = json_decode($request->contacts); // COLOCAR ALGUMA FUNÇÃO PARA VERIFICAR SE ESTÁ DENTRO DO PADRÃO ESPERADO
    
    #region HANDLE IMAGE
    $image = null; // LIDAR COM IMAGEM
    if($request->image_name){
      $path = 'uploads/services/';
      $resImage = Controller::handleUploadImage(
        $request->image_name,
        $path
      );
      if($resImage->result) $data+= ['image' => $resImage->response];
      else return $this->sweet(
        redirect()->back(),
        $resImage->response,
        'error',
        'Salvar Serviço'
      );
    }
    #endregion HANDLE IMAGE

    $data = [
      'name' => $request->name,
      'description' => $request->description,
      
      'service_category_id' => $category->id,
      
      'contacts' => json_encode($contacts),
      'instructions' => $instructions,

      'image' => $image,
    ];
    
    if(!$id){
      $slug = Service::generateSlug($request->name);
      $data+=[
        'slug' => $slug,
        'user_id' => auth()->user()->id
      ];
    }

    Service::updateOrCreate(['id' => $id], $data);

    return $this->toast(
      redirect()->route('service.index'),
      'Serviço salvo com sucesso',
      'success',
      'Salvar Serviço'
    );
  }
}