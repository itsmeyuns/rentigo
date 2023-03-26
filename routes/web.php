<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'dashboard');
Route::view('/clients', 'clients');
Route::view('/agents', 'dashboard');
Route::view('/charges', 'dashboard');
Route::view('/alerts', 'dashboard');
Route::view('/contrats', 'dashboard');
Route::view('/reservation', 'dashboard');
Route::view('/vehicules', 'vehicules');