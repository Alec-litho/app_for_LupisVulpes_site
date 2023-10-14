<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
Route::get('/', function () {
    return view('welcome', ['name'=>'Oleg']);
})->name('/home');




//-------------------------------------------------------------

Route::post('/art', [artController::class, 'store'])->name('art.store');