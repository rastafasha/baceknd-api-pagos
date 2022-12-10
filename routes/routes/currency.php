<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

//currencies
Route::get('currencies', [CurrencyController::class, 'index'])
    ->name('currency.index');

Route::post('/currency/store', [CurrencyController::class, 'currencyStore'])
    ->name('currency.store');

Route::get('/currency/show/{currency}', [CurrencyController::class, 'currencyShow'])
    ->name('currency.show');

Route::put('currency/update/{currency}', [CurrencyController::class, 'currencyUpdate'])
    ->name('currency.update');

Route::delete('/currency/destroy/{currency}', [CurrencyController::class, 'currencyDestroy'])
    ->name('currency.destroy');