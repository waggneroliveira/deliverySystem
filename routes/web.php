<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormIndexController;

require __DIR__ . '/dashboard.php';

Route::get('/', function () {
    return redirect()->route('index.form');
});
// Route::get('/home', function () {
//     return view('client.blades.app');
// })->name('index.form');

Route::get('/home', [FormIndexController::class, 'index'])->name('index.form');
Route::get('/produtos', function () {
    return view('client.blades.products');
})->name('products');
Route::get('/carrinho', function () {
    return view('client.blades.cart');
})->name('cart');
Route::post('/enviar-formulario', [FormIndexController::class, 'store']);
