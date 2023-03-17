<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->shallow();
Route::apiResource('products', ProductController::class)->shallow();
Route::apiResource('images', ImageController::class)->shallow();
