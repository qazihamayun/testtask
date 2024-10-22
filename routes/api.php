<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsitePostController;
use App\Http\Controllers\SubscriptionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function (){
    Route::prefix('websites/{website:website_uuid}')->group(function (){
        Route::post('/posts', [WebsitePostController::class, 'store']);

        //subscribe website
        Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
    });
});
