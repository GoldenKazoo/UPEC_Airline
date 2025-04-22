<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\VolController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/billetterie', [VolController::class, 'searchFlights'])->name('ticket.showFly');

Route::get('/reservation/create/{volId}', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'addToPanier'])->name('reservation.store');

Route::get('/panier', [ReservationController::class, 'showPanier'])->name('panier.show');
Route::post('/panier/confirm', [ReservationController::class, 'confirmPurchase'])->name('panier.confirm');
Route::get('/reservation/confirmation', [ReservationController::class, 'confirmation'])->name('reservation.confirmation');

// Authentification
Route::get('/register', [LogController::class, 'createForm'])->name('auth.registerForm');
Route::post('/register', [LogController::class, 'create'])->name('auth.register');

Route::get('/login', [LogController::class, 'login'])->name('auth.loginForm');
Route::post('/login', [LogController::class, 'doLogin'])->name('auth.doLogin');

// Routes protégées (nécessitent d’être connecté)
Route::middleware('auth')->group(function () {
    Route::get('/compte', [LogController::class, 'account'])->name('auth.compte');
    Route::delete('/logout', [LogController::class, 'logout'])->name('auth.logout');

    // Gestion des vols
    Route::get('/vols/create', [VolController::class, 'create'])->name('vols.create');
    Route::post('/vols', [VolController::class, 'store'])->name('vols.store');
    Route::get('/vols/delete', [VolController::class, 'deletePage'])->name('vols.delete');
    Route::delete('/vols/{id}', [VolController::class, 'destroy'])->name('vols.destroy');

    // Visualisation des réservations
    Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations');
});

