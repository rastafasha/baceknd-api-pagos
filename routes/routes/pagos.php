<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagosController;

//pagos
Route::get('pagos', [PagosController::class, 'index'])
    ->name('payments.index');
Route::get('pagos/recientes/', [PagosController::class, 'recientes'])
    ->name('payments.recientes');
Route::get('pagos/{id}', [PagosController::class, 'show'])
    ->name('payments.show');
Route::get('pagos/pagosbyUser/{id}', [PagosController::class, 'pagosbyUser'])
    ->name('payments.pagosbyUser');
Route::get('update', [PagosController::class, 'update'])
    ->name('payments.update');