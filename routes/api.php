<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\categories\CategoriesController;
use App\Http\Controllers\products\ProductController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sign-up',[AuthController::class,'signUp']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/fetch-sub-category/{id}',[CategoriesController::class,'fetchSubCategory']);
Route::get('/sub-categories',[CategoriesController::class,'SubCategories']);
Route::get('/fetch-categories',[CategoriesController::class,'getCategories']);
Route::get('/fetch-porduct/{id}',[ProductController::class,'fetchProduct']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/add-category',[CategoriesController::class,'addCategory']);
    Route::post('/add-subcategory',[CategoriesController::class,'addSubCategory']);
    Route::post('/add-product',[ProductController::class,'addProduct']);
});