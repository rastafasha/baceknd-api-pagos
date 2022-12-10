<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectorioController;

//directorio
    Route::get('directorios', [DirectorioController::class, 'index'])
        ->name('directorios.index');
    Route::get('directorios/{id}', [DirectorioController::class, 'show'])
        ->name('directorio.show');
    Route::get('update', [DirectorioController::class, 'update'])
        ->name('directorio.update');