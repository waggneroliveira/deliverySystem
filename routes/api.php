<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Api\HomePageController;
use App\Http\Controllers\Client\Api\ServiceLocationClientController;

Route::get('/locais-de-atendimentos', [ServiceLocationClientController::class, 'locations']);
Route::get('/slides', [HomePageController::class, 'slides']);
Route::get('/categorias', [HomePageController::class, 'categories']);
Route::get('/produtos-destaques', [HomePageController::class, 'products']);

Route::get('/produtos/{category?}', [HomePageController::class, 'productWithCategory'])->name('productWithCategory');
