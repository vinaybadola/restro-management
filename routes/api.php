<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::post('/restaurants/{id}/categories', [RestaurantController::class, 'addCategory']);
Route::get('/restaurants/{restaurant}/categories', [CategoryController::class, 'getCategoriesByRestaurant']);
Route::get('/showAllCategories', [CategoryController::class, 'showAllCategories']);
Route::delete('/restaurants/{restaurantId}/categories/{categoryId}', [RestaurantController::class, 'deleteCategoryFromResturant']);
