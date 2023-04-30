<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehiculeController;
use App\Http\Requests\VehiculeRequest;
use App\Models\Client;

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

Route::view('/dashboard', 'dashboard')->middleware('auth');
Route::view('/charges', 'charges');
Route::view('/alerts', 'dashboard');
Route::view('/contrats', 'contrats');
Route::view('/reservations', 'reservations');




Route::view('/vehicules/create', 'vehicules.create');

Route::view('/agents', 'agents.index');
Route::view('/agents/create', 'agents.create');
// Route::view('/vehicules/create', 'vehicules.create');

Auth::routes(['login' => false]);
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('/', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

Route::prefix('/clients')->group(function () {
  Route::get('/', [ClientController::class, 'index'])->name('clients.index');
  Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
  Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
  Route::patch('/{id}', [ClientController::class, 'update'])->name('clients.update');

  Route::middleware('ajax_only')->group( function() {
    Route::get('/{id}/show', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/fetch', [ClientController::class, 'all'])->name('clients.fetch')->middleware('ajax_only');
    Route::get('/{id}/delete', [ClientController::class, 'delete'])->name('clients.delete');
    Route::get('/search', [ClientController::class, 'search'])->name('clients.search');
    Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
  });

});

Route::prefix('/vehicules')->group(function () {
  Route::get('/', [VehiculeController::class, 'index'])->name('vehicules.index');
  Route::post('/store', [VehiculeController::class, 'store'])->name('vehicules.store');
  Route::put('/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');
  Route::delete('/{id}', [VehiculeController::class, 'destroy'])->name('vehicule.destroy');
  Route::get('/searchCheck', [VehiculeController::class, 'searchCheck'])->name('vehicule.searchCheck');

  Route::middleware('ajax_only')->group(function ()
  {
    Route::get('/fetch', [VehiculeController::class, 'all']);
    Route::get('/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
    Route::get('/{id}/delete', [VehiculeController::class, 'delete'])->name('vehicule.delete');
    Route::get('/search', [VehiculeController::class, 'search'])->name('vehicule.search');
  });

});

Route::get('/test', [VehiculeController::class, 'test']);