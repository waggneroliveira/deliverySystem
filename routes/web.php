<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormIndexController;
use App\Http\Controllers\Client\FinalizeOrderController;
use App\Http\Controllers\Client\ProductPageController;
use App\Http\Controllers\NewsletterController;

require __DIR__ . '/dashboard.php';

Route::get('/', function () {
    return view('client.blades.app');
})->name('index');

Route::get('/carrinho', function () {
    return view('client.blades.cart');
})->name('cart');

Route::get('/locais-de-atendimentos', function () {
    return view('client.blades.service-location');
})->name('service-location');

Route::get('/produtos', [ProductPageController::class, 'index'])->name('products');
Route::get('/produtos/{category}', [ProductPageController::class, 'products'])->name('product_categories');

Route::get('/finalizar-pedido', [FinalizeOrderController::class, 'index'])->name('finalize-order');
Route::post('/enderecos', [FinalizeOrderController::class, 'store']);
Route::post('/verify-postal-code', [FinalizeOrderController::class, 'verifyPostalCode']);

Route::post('/enviar-formulario', [NewsletterController::class, 'store'])->name('send-form');
