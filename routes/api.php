<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Api\HomePageController;

Route::get('/slides', [HomePageController::class, 'slides']);
Route::get('/categorias', [HomePageController::class, 'productCategories']);
Route::get('/produtos', [HomePageController::class, 'products']);
