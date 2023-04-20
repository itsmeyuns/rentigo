<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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




Route::view('/vehicules', 'vehicules.index');
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
  Route::get('/show/{id}', [ClientController::class, 'show'])->name('clients.show');
  Route::get('/search', [ClientController::class, 'search'])->name('clients.search');
  Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
  Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
  Route::get('/{id}/delete', [ClientController::class, 'delete'])->name('clients.delete');
  Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
  Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
  Route::patch('/{id}', [ClientController::class, 'update'])->name('clients.update');
});
Route::get('/fetch', [ClientController::class, 'all']);