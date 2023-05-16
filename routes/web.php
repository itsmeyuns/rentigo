<?php

use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\CarteGriseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\ExtraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\VidangeController;
use App\Http\Controllers\VisiteTechniqueController;


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
    Route::get('/fetch', [ClientController::class, 'fetch'])->name('clients.fetch');
    Route::get('/all', [ClientController::class, 'all'])->name('clients.all');
    Route::get('/{id}/delete', [ClientController::class, 'delete'])->name('clients.delete');
    Route::get('/search', [ClientController::class, 'search'])->name('clients.search');
    Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
  });

});

// Start Vehicule
Route::prefix('/vehicules')->group(function () {
  Route::get('/', [VehiculeController::class, 'index'])->name('vehicules.index');
  Route::post('/store', [VehiculeController::class, 'store'])->name('vehicules.store');
  Route::put('/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');
  Route::delete('/{id}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy');
  Route::get('/{id}/show', [VehiculeController::class, 'show'])->name('vehicules.show');
  
  Route::middleware('ajax_only')->group(function ()
  {
    Route::get('/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
    Route::get('/{id}/delete', [VehiculeController::class, 'delete'])->name('vehicules.delete');
    Route::get('/fetch', [VehiculeController::class, 'fetch'])->name('vehicules.fetch');
    Route::get('/all', [VehiculeController::class, 'all'])->name('vehicules.all');
    Route::get('/search', [VehiculeController::class, 'search'])->name('vehicules.search');
    Route::get('/filter', [VehiculeController::class, 'filterDisponibilite'])->name('vehicules.filter');
    Route::get('/{id}/get-prix-location', [VehiculeController::class, 'getPrixLocation'])->name('vehicules.get-prix-location');
    Route::get('/disponible', [VehiculeController::class, 'getVehiculesDisponible'])->name('vehicules.disponible');
  });

});

  // Start Vidange
  Route::prefix('vidanges')->group(function () {
    Route::post('/store', [VidangeController::class, 'store'])->name('vidanges.store');
    Route::put('/{id}', [VidangeController::class, 'update'])->name('vidanges.update');
    Route::delete('/{id}', [VidangeController::class, 'destroy'])->name('vidanges.destroy');

    Route::middleware('ajax_only')->group(function () {
      Route::get('/{id}/fetch', [VidangeController::class, 'all'])->name('vidanges.fetch');
      Route::get('/{id}/delete', [VidangeController::class, 'delete'])->name('vidanges.delete');
      Route::get('/{id}/edit', [VidangeController::class, 'edit'])->name('vidanges.edit');
    });

  });
  // End Vidange
  // Start Assurance
  Route::prefix('assurances')->group(function () {
    Route::post('/store', [AssuranceController::class, 'store'])->name('assurances.store');
    Route::put('/{id}', [AssuranceController::class, 'update'])->name('assurances.update');
    Route::delete('/{id}', [AssuranceController::class, 'destroy'])->name('assurances.destroy');

    Route::middleware('ajax_only')->group(function () {
      Route::get('/{id}/fetch', [AssuranceController::class, 'all'])->name('assurances.fetch');
      Route::get('/{id}/delete', [AssuranceController::class, 'delete'])->name('assurances.delete');
      Route::get('/{id}/edit', [AssuranceController::class, 'edit'])->name('assurances.edit');
    });

  });
  // End Assurance

  // Start Carte Grise
  Route::prefix('carte-grises')->group(function () {
    Route::post('/store', [CarteGriseController::class, 'store'])->name('carte-grises.store');
    Route::put('/{id}', [CarteGriseController::class, 'update'])->name('carte-grises.update');
    Route::delete('/{id}', [CarteGriseController::class, 'destroy'])->name('carte-grises.destroy');

    Route::middleware('ajax_only')->group(function () {
      Route::get('/{id}/fetch', [CarteGriseController::class, 'all'])->name('carte-grises.fetch');
      Route::get('/{id}/delete', [CarteGriseController::class, 'delete'])->name('carte-grises.delete');
      Route::get('/{id}/edit', [CarteGriseController::class, 'edit'])->name('carte-grises.edit');
    });

  });
  // End Carte Grise

  // Start Visite Technique
  Route::prefix('visite-techniques')->group(function () {
    Route::post('/store', [VisiteTechniqueController::class, 'store'])->name('visite-techniques.store');
    Route::put('/{id}', [VisiteTechniqueController::class, 'update'])->name('visite-techniques.update');
    Route::delete('/{id}', [VisiteTechniqueController::class, 'destroy'])->name('visite-techniques.destroy');

    Route::middleware('ajax_only')->group(function () {
      Route::get('/{id}/fetch', [VisiteTechniqueController::class, 'all'])->name('visite-techniques.fetch');
      Route::get('/{id}/delete', [VisiteTechniqueController::class, 'delete'])->name('visite-techniques.delete');
      Route::get('/{id}/edit', [VisiteTechniqueController::class, 'edit'])->name('visite-techniques.edit');
    });

  });
  // End Visite Technique


  // Start Entretien
  Route::prefix('entretiens')->group(function () {
    Route::post('/store', [EntretienController::class, 'store'])->name('entretiens.store');
    Route::put('/{id}', [EntretienController::class, 'update'])->name('entretiens.update');
    Route::delete('/{id}', [EntretienController::class, 'destroy'])->name('entretiens.destroy');

    Route::middleware('ajax_only')->group(function () {
      Route::get('/{id}/fetch', [EntretienController::class, 'all'])->name('entretiens.fetch');
      Route::get('/{id}/delete', [EntretienController::class, 'delete'])->name('entretiens.delete');
      Route::get('/{id}/edit', [EntretienController::class, 'edit'])->name('entretiens.edit');
    });

  });
  // End Entretien

// End Vehicule



// Start Reservation 

Route::prefix('/reservations')->group(function () {

  Route::get('/', [ReservationController::class, 'index'])->name('reservations.index');
  Route::post('/store', [ReservationController::class, 'store'])->name('reservations.store');
  Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
  Route::put('/{id}', [ReservationController::class, 'update'])->name('reservations.update');

  Route::middleware('ajax_only')->group(function ()
  {
    Route::get('/fetch', [ReservationController::class, 'all'])->name('reservations.fetch');
    Route::get('/{id}/delete', [ReservationController::class, 'delete'])->name('reservations.delete');
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::get('/search', [ReservationController::class, 'search'])->name('reservations.search');
    Route::get('/filter', [ReservationController::class, 'filter'])->name('reservations.filter');
  });

});

// End Reservation 



// Start Contrat

Route::prefix('/contrats')->group(function ()
{
  Route::get('/', [ContratController::class, 'index'])->name('contrats.index');
  Route::post('/store', [ContratController::class, 'store'])->name('contrats.store');
  Route::delete('/{id}', [ContratController::class, 'destroy'])->name('contrats.destroy');
  Route::put('/{id}', [ContratController::class, 'update'])->name('contrats.update');
  Route::get('/{id}/imprimer', [ContratController::class, 'pdf']);

  Route::middleware('ajax_only')->group(function () {
    Route::get('/fetch', [ContratController::class, 'fetch'])->name('contrats.fetch');
    Route::get('/{id}/delete', [ContratController::class, 'delete'])->name('contrats.delete');
    Route::get('/{id}/edit', [ContratController::class, 'edit']);
    Route::get('/search', [ContratController::class, 'search'])->name('contarts.search');
    Route::get('/filter', [ContratController::class, 'filter'])->name('reservations.filter');
  });

});

// End Contrat



Route::prefix('/extras')->group(function ()
{
  Route::get('/', [ExtraController::class, 'all'])->middleware('ajax_only');
});