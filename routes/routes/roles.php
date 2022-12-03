<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

//roles
Route::get('roles', [RoleController::class, 'index'])
    ->name('roles.index');

Route::get('role/show/{role}', [RoleController::class, 'roleShow'])
    ->name('role.show');

Route::get('role/edit/{role}', [RoleController::class, 'roleEdit'])
    ->name('role.edit');

Route::put('role/update/{role}', [RoleController::class, 'roleUpdate'])
    ->name('role.update');