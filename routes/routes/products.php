<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductosController;

//Route productos
Route::get('/planes', [ProductController::class, 'index'])
    ->name('plan.index');

Route::post('/plan/store', [ProductController::class, 'planStore'])
    ->name('plan.store');

Route::get('/plan/show/{plan}', [ProductController::class, 'planShow'])
    ->name('plan.show');

Route::put('/plan/update/{plan}', [ProductController::class, 'planUpdate'])
    ->name('plan.update');

Route::delete('/plan/destroy/{plan}', [ProductController::class, 'planDestroy'])
    ->name('plan.destroy');