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
Route::view('/agents', 'agents');
Route::view('/charges', 'charges');
Route::view('/alerts', 'dashboard');
Route::view('/contrats', 'contrats');
Route::view('/reservations', 'reservations');


Route::view('/vehicules', 'vehicules.index');
Route::view('/vehicules/create', 'vehicules.create');
// Route::view('/vehicules/create', 'vehicules.create');