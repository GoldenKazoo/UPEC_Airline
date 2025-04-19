<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\VolController;

Route::get('/vols/create', [VolController::class, 'create'])->name('vols.create');

Route::post('/vols', [VolController::class, 'store'])->name('vols.store');

Route::get('/vols/delete', [VolController::class, 'deletePage'])->name('vols.delete');

Route::delete('/vols/{id}', [VolController::class, 'destroy'])->name('vols.destroy');


