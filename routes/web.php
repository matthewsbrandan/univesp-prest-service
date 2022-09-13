<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return redirect()->route('home'); });
Route::get('pages/billing.html', function() { return view('billing'); });
Route::get('pages/dashboard.html', function() { return view('dashboard'); })->name('home');
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