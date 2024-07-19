<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'auth'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('category', [CategoryController::class, 'store']);
    Route::post('category/{parent_id}/leaf', [CategoryController::class, 'storeLeaf']);
    Route::get('category/{category_id}', [CategoryController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::delete('category/{category_id}', [CategoryController::class, 'destroy']);
});

Route::get('category/{category_id}/tree', [CategoryController::class, 'showTree']);
