<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testcontroller; 

use App\Http\Controllers\TController;


Route::get('/billetterie', [TController::class, 'showFlights'])->name('ticket.showFly');



Route::get('/login_register', function () {
    return view('login_register');
})->name('form:view');

Route::post('/register', [testController::class, 'register'])->name('form:register');
Route::post('/login', [testController::class, 'login'])->name('form:login');

Route::get('/', action: function () {
    return view('home');
});