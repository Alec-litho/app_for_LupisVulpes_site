<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome', ['name'=>'Oleg']);
});




//-------------------------------------------------------------

Route::post('/art', 'App\Http\Controllers\ArtController@store')->name('art.store');