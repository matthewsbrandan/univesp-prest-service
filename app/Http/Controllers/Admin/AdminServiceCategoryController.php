<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceCategory;

class AdminServiceCategoryController extends Controller
{
  public function index(){
    $categories = ServiceCategory::get();
    return view('admin.service_category.index',[
      'categories' => $categories
    ]);
  }
  public function create(){
    return view('admin.service_category.create.index');
  }
  public function store(Request $request){
    $errors = [];
    if(!$request->name) $errors[] = 'Preencha o nome';
    if(!$request->keywords) $errors[] = 'Insira alguma palavra chave';
    if(!$request->description) $errors[] = 'Preencha a descrição';
    if(!$request->image_name) $errors[] = 'Adicione uma imagem';

    if(count($errors) > 0) return $this->sweet(
      redirect()->back(),
      'Alguns campos obrigatórios não foram preenchidos.<br/><br/>-' . (implode('<br/>- ', $errors)),
      'error',
      'Salvar Categoria'
    );

    $slug = ServiceCategory::generateSlug($request->name);
    $data = [
      'name' => $request->name,
      'slug' => $slug,
      'keywords' => $request->keywords,
      'description' => $request->description,
    ];
    
    #region HANDLE IMAGE
    if($request->image_name){
      $path = 'uploads/service_categories/';
      $resImage = Controller::handleUploadImage(
        $request->image_name,
        $path
      );
      if($resImage->result) $data+= ['image' => $resImage->response];
      else return $this->sweet(
        redirect()->back(),
        $resImage->response,
        'error',
        'Salvar Categoria'
      );
    }
    #endregion HANDLE IMAGE

    ServiceCategory::create($data);
    return $this->toast(
      redirect()->route('admin.service_category.index'),
      'Categoria salva com sucesso',
      'success',
      'Salvavr Categoria'
    );
  }
}
