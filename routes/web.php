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

Route::view('/dashboard', 'dashboard')->middleware('auth');
Route::view('/charges', 'charges');
Route::view('/alerts', 'dashboard');
Route::view('/contrats', 'contrats');
Route::view('/reservations', 'reservations');


Route::view('/clients', 'clients.index');
Route::view('/clients/create', 'clients.create');
Route::view('/vehicules', 'vehicules.index');
Route::view('/vehicules/create', 'vehicules.create');

Route::view('/agents', 'agents.index');
Route::view('/agents/create', 'agents.create');
// Route::view('/vehicules/create', 'vehicules.create');

Auth::routes(['login' => false]);

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('/', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
