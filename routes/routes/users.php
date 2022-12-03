<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

//route usuarios
Route::get('usuarios', [UsuariosController::class, 'index'])
    ->name('users.index');
Route::get('usuarios/recientes/', [UsuariosController::class, 'recientes'])
    ->name('users.recientes');
Route::get('usuarios/{id}', [UsuariosController::class, 'show'])
    ->name('users.show');
Route::get('usuarios/update/{id}', [UsuariosController::class, 'update'])
    ->name('users.update');

Route::put('usuarios/updateInfo/{id}', [UsuariosController::class, 'updatePersonalInformation'])
    ->name('users.updatePersonalInformation');
Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'destroy'])
    ->name('users.destroy');
Route::get('usuarios/uploadImage', [UsuariosController::class, 'upload'])
    ->name('users.upload');
Route::get('usuarios/image', [UsuariosController::class, 'getImage'])
    ->name('users.getImage');
Route::get('usuarios/deleteImage', [UsuariosController::class, 'deleteFotoPerfil'])
    ->name('users.deleteFotoPerfil');