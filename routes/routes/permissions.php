<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

//Route productos
Route::get('permisos', [PermissionController::class, 'index'])
    ->name('permissions.index');
