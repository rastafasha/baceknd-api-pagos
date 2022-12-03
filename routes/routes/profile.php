<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

//Router Profile
    Route::get('profile/{profile}', [ProfileController::class, 'profile'])
        ->name('profile');

    Route::get('profile/create', [ProfileController::class, 'profileCreate'])
        ->name('profile.create');
    Route::post('profile/create', [ProfileController::class, 'profileStore'])
        ->name('profile.store');
    
    Route::get('profile/edit/{profile:id}', [ProfileController::class, 'profileEdit'])
        ->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'profileUpdate'])
        ->name('profile.update');
    
    Route::delete('profile/delete/{profile:id}', [ProfileController::class, 'profileDelete'])
        ->name('profile.delete');