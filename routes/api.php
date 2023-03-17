<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->shallow();
Route::apiResource('products', ProductController::class)->shallow();
