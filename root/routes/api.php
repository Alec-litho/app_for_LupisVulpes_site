<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnimationController;
use Root\Config\AuthorizeGoogleService;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix("/googledriveapi")->group(function() {
    Route::get("/animations/id/{id}", [AnimationController::class, "getAnimation"])->defaults("AuthorizedGoogleService",[AuthorizeGoogleService::class]);
    Route::post("/animations/uploadAnimation", [AnimationController::class, "uploadAnimation"])->defaults("AuthorizedGoogleService",[AuthorizeGoogleService::class]);

}); 
