<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormIndexController;
use App\Http\Controllers\Client\FinalizeOrderController;
use App\Http\Controllers\Client\ProductPageController;

require __DIR__ . '/dashboard.php';

Route::get('/', function () {
    return redirect()->route('index');
});
Route::get('/home', function () {
    return view('client.blades.app');
})->name('index');

// Route::get('/produtos', function () {
//     return view('client.blades.products');
// })->name('products');

Route::get('/carrinho', function () {
    return view('client.blades.cart');
})->name('cart');

// Route::get('/finalizar-pedido', function () {
//     return view('client.blades.finalize-order');
// })->name('finalize-order');

Route::get('/produtos', [ProductPageController::class, 'index'])->name('products');
Route::get('/produtos/{category}', [ProductPageController::class, 'products'])->name('product_categories');

Route::get('/finalizar-pedido', [FinalizeOrderController::class, 'index'])->name('finalize-order');
Route::post('/enderecos', [FinalizeOrderController::class, 'store']);
Route::post('/verify-postal-code', [FinalizeOrderController::class, 'verifyPostalCode']);

Route::post('/enviar-formulario', [FormIndexController::class, 'store']);
