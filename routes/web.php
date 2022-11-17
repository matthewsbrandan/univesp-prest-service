<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserAreaController;
use App\Http\Controllers\ServiceCategoryController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminServiceCategoryController;

Route::get('/', [HomeController::class, 'welcome'])->name('/');
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('cadastrar-se', [UserController::class, 'register'])->name('register');
Route::post('cadastrar-se', [UserController::class, 'store'])->name('store');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::name('service.')->group(function(){
  Route::get('servicos', [ServiceController::class, 'index'])->name('index');
  Route::get('servico/detalhes/{slug}', [ServiceController::class, 'show'])->name('show');
  // OUTHER PRIVATE ROUTES
});

Route::name('service_category.')->group(function(){
  Route::get('categorias', [ServiceCategoryController::class, 'index'])->name('index');
  Route::get('categoria/{slug}', [ServiceCategoryController::class, 'show'])->name('show');

  // OUTHERS ADMIN ROUTES
});

Route::middleware(['auth'])->group(function(){
  Route::name('profile.')->group(function(){
    Route::get('perfil/{username?}', [UserController::class, 'profile'])->name('index');
  });

  Route::name('gallery.')->group(function(){
    Route::get('/galeria', [GalleryController::class,'index'])->name('index');
    Route::get('/galeria/carregar/{gallery_name}', [GalleryController::class,'get'])->name('get');
    Route::get('/galeria/ver/{gallery_name}', [GalleryController::class,'show'])->name('show');
    Route::post('/galeria/subir-imagem', [GalleryController::class,'upload'])->name('upload');
    Route::post('/galeria/excluir', [GalleryController::class,'delete'])->name('delete');
  });

  Route::name('area.')->group(function(){
    Route::get('condominio/detalhes/{slug}', [AreaController::class, 'show'])->name('show');
    Route::get('condominio/criar', [AreaController::class, 'create'])->name('create');
    Route::post('condominio/salvar', [AreaController::class, 'store'])->name('store');
  });

  Route::name('user_area.')->group(function(){
    Route::get('condominio/vincular/{id}', [UserAreaController::class, 'store'])->name('store');
  });

  Route::name('service.')->group(function(){
    // OUTHER PUBLIC ROUTES
    Route::get('servico/criar', [ServiceController::class, 'create'])->name('create');
    Route::post('servico/salvar', [ServiceController::class, 'store'])->name('store');
  });
  
  Route::name('work.')->group(function(){
    Route::get('historico', [WorkController::class, 'index'])->name('index');
  });

  Route::middleware(['admin'])->name('admin.')->group(function(){
    Route::name('service_category.')->group(function(){
      Route::get('gerenciar/categorias', [AdminServiceCategoryController::class, 'index'])->name('index');
      Route::get('gerenciar/categorias/nova', [AdminServiceCategoryController::class, 'create'])->name('create');
      Route::post('gerenciar/categorias/salvar', [AdminServiceCategoryController::class, 'store'])->name('store');
    });

    Route::name('user.')->group(function(){
      Route::get('gerenciar/usuários', [AdminUserController::class, 'index'])->name('index');
    });
  });

  Route::get('sair', [LoginController::class, 'logout'])->name('logout');
});

Route::view('pages/dashboard','dashboard');
Route::view('pages/billing', 'billing');
Route::view('pages/icons', 'icons');
Route::view('pages/map', 'map');
Route::view('pages/notifications', 'notifications');
Route::view('pages/profile', 'profile');
Route::view('pages/rtl', 'rtl');
Route::view('pages/sign-in', 'sign-in');
Route::view('pages/sign-up', 'sign-up');
Route::view('pages/tables', 'tables');
Route::view('pages/template', 'template');
Route::view('pages/typography', 'typography');
Route::view('pages/virtual-reality', 'virtual-reality');