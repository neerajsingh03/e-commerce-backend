<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\categories\CategoriesController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sign-up',[AuthController::class,'signUp']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/fetch-sub-caregory/{id}',[CategoriesController::class,'fetchSubCategory']);
Route::get('/fetch-categories',[CategoriesController::class,'getCategories']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/add-category',[CategoriesController::class,'index']);
    Route::post('/add-subcategory',[CategoriesController::class,'addSubCategory']);
});