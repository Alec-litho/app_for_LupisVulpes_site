<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnimationController;
use Root\Config\AuthorizeGoogleService;
use App\Http\Controllers\Api\V1\ArtController;
use App\Http\Controllers\Api\V1\ColorController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix("v1/googledriveapi")->group(function() {
    Route::get("/animations/{id}", [AnimationController::class, "getAnimation"]);
    Route::post("/animations/uploadAnimation", [AnimationController::class, "uploadAnimationToDrive"]);

}); 

Route::prefix('v1/db/arts')->group(function() {
    Route::get('/', [artController::class, 'index'])->name('art.index');
    Route::get('/{id}', [artController::class, 'getArt'])->name('art.get');

    Route::post('/', [artController::class, 'store'])->name('art.store');
    Route::post('/if_exists',[ArtController::class, 'checkIfExists'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

Route::prefix('v1/db/colors')->group(function() {
    Route::post('/',[ColorController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::delete('/destroy_last',[ColorController::class, 'destroyLastColors'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

Route::prefix('v1/db/animations')->group(function() {
    Route::post('/',[AnimationController::class, 'uploadAnimationToDB'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::delete('/{id}',[AnimationController::class, 'destroyLastColors'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});





