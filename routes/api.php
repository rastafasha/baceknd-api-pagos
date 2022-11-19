<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProductosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('user', [UserAuthController::class, 'user']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::post('logout', [UserAuthController::class, 'logout']);

    //usuarios
    Route::get('usuarios', [UsuariosController::class, 'index']);
    Route::get('usuarios/recientes/', [UsuariosController::class, 'recientes']);
    Route::get('usuarios/{id}', [UsuariosController::class, 'show']);
    Route::get('usuarios/update/{id}', [UsuariosController::class, 'update']);

    Route::put('usuarios/updateInfo/{id}', [UsuariosController::class, 'updatePersonalInformation']);
    Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'destroy']);
    Route::get('usuarios/uploadImage', [UsuariosController::class, 'upload']);
    Route::get('usuarios/image', [UsuariosController::class, 'getImage']);
    Route::get('usuarios/deleteImage', [UsuariosController::class, 'deleteFotoPerfil']);


    //roles
    Route::get('roles', [RolesController::class, 'index']);
    Route::get('roles/{id}', [RolesController::class, 'rol']);
    Route::put('roles/update/{id}', [RolesController::class, 'update']);

    //directorio
    Route::get('directorios', [DirectorioController::class, 'index']);
    Route::get('directorios/{id}', [DirectorioController::class, 'show']);
    Route::get('update', [DirectorioController::class, 'update']);

    //pagos
    Route::get('pagos', [PagosController::class, 'index']);
    Route::get('pagos/recientes/', [PagosController::class, 'recientes']);
    Route::get('pagos/{id}', [PagosController::class, 'show']);
    Route::get('pagos/pagosbyUser/{id}', [PagosController::class, 'pagosbyUser']);
    Route::get('update', [PagosController::class, 'update']);

    //productos
    Route::get('productos', [ProductosController::class, 'index']);
    Route::get('productos/{id}', [ProductosController::class, 'show']);
    Route::get('update', [ProductosController::class, 'update']);


});
