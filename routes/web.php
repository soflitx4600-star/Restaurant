<?php

use App\Http\Controllers\MenuController; 

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('landing');
});


// ... tus otras rutas ...

Route::get('/menu', [MenuController::class, 'index'])->name('menu');