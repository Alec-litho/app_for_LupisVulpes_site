<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\ColorController;
Route::get('/', function () {
    return view('welcome', ['colors'=>'colors']); 
})->name('/home');




//-------------------------------------------------------------

Route::post('/art', [artController::class, 'store'])->name('art.store');




//--------------------------Color table--------------------------

Route::post('/colors',[ColorController::class, 'store'])->name('color.store');



//--------------------------Color table--------------------------