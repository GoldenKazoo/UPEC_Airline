<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showCreateLogin'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/account', [AuthController::class, 'account'])->middleware('auth')->name('account');
//-----------------------------------------------------------------------------------------------\\
Route::post('/panier/add/{flight}', [PanierController::class, 'add'])->name('panier.add');

Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');

Route::post('/panier/confirm', [PanierController::class, 'confirm'])->name('panier.confirm');

Route::get('/', [FlightController::class, 'index'])->name('flights.index');

//-----------------------------------------------------------------------------------------------\\
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    // grstion vol
    Route::get('/admin/flights', [\App\Http\Controllers\AdminController::class, 'flights'])->name('admin.flights');
    Route::get('/admin/flights/create', [\App\Http\Controllers\AdminController::class, 'createFlight'])->name('admin.flights.create');
    Route::post('/admin/flights/store', [\App\Http\Controllers\AdminController::class, 'storeFlight'])->name('admin.flights.store');
    Route::get('/admin/flights/edit/{flight}', [\App\Http\Controllers\AdminController::class, 'editFlight'])->name('admin.flights.edit');
    Route::post('/admin/flights/update/{flight}', [\App\Http\Controllers\AdminController::class, 'updateFlight'])->name('admin.flights.update');
    Route::post('/admin/flights/delete/{flight}', [\App\Http\Controllers\AdminController::class, 'deleteFlight'])->name('admin.flights.delete');

    // voir les resa
    Route::get('/admin/reservations', [\App\Http\Controllers\AdminController::class, 'reservations'])->name('admin.reservations');
});
