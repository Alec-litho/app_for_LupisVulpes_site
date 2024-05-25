<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArtController;
use App\Http\Controllers\Api\V1\ColorController;
Route::get('/', function () {
    return view('welcome', ['colors'=>'colors']); 
})->name('/home');




//-------------------------------------------------------------
Route::prefix('api/v1')->group(function() {
    Route::get('/arts', [artController::class, 'index'])->name('art.index');
    Route::post('/art', [artController::class, 'store'])->name('art.store');
    Route::post('/art/if_exists',[ArtController::class, 'checkIfExists'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});
// Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1'], function() {
//     Route::apiResource('store', ArtController::class);
// });



//--------------------------Color table--------------------------
Route::prefix('api/v1')->group(function() {
    Route::post('/color',[ColorController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::delete('/color/destroy_last',[ColorController::class, 'destroyLastColors'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

// Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1'], function() {
//     Route::apiResource('store', ColorController::class);
// });


//--------------------------Color table--------------------------