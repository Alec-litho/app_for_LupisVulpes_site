<?php

use Illuminate\Support\Facades\Route;



Route::get('/arts', function () {
    return view('arts', ['colors'=>'colors']);  
})->name('/arts');

Route::get('/animations', function () {
    return view('animation'); 
})->name('/animations');
Route::get('/characters', function () {
    return view('characters'); 
})->name('/characters');



