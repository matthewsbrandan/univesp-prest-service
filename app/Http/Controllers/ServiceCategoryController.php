<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceCategory;

class ServiceCategoryController extends Controller
{
  public function index(){

  }
  public function show($slug){
    if(!$category = ServiceCategory::whereSlug($slug)->first()) return $this->sweet(
      redirect()->back(),
      'Categoria não localizada',
      'error',
      'Ver Categoria'
    );
    if($category->services->count() == 0) return $this->sweet(
      redirect()->back(),
      'Essa categoria ainda não possui nenhum serviço cadastrado',
      'error',
      'Ver Categoria'
    );
    
    return view('service_category.show',[
      'category' => $category
    ]);
  }
}