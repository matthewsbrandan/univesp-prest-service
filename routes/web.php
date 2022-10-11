<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('cadastrar-se', [UserController::class, 'register'])->name('register');
Route::post('cadastrar-se', [UserController::class, 'store'])->name('store');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function(){
  Route::name('profile.')->group(function(){
    Route::get('perfil/{username?}', [UserController::class, 'profile'])->name('index');
  });
  Route::get('sair', [LoginController::class, 'logout'])->name('logout');
});


Route::get('pages/billing.html', function() { return view('billing'); });
Route::get('pages/icons.html', function() { return view('icons'); });
Route::get('pages/map.html', function() { return view('map'); });
Route::get('pages/notifications.html', function() { return view('notifications'); });
Route::get('pages/profile.html', function() { return view('profile'); });
Route::get('pages/rtl.html', function() { return view('rtl'); });
Route::get('pages/sign-in.html', function() { return view('sign-in'); });
Route::get('pages/sign-up.html', function() { return view('sign-up'); });
Route::get('pages/tables.html', function() { return view('tables'); });
Route::get('pages/template.html', function() { return view('template'); });
Route::get('pages/typography.html', function() { return view('typography'); });
Route::get('pages/virtual-reality.html', function() { return view('virtual-reality'); });