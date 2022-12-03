<?php

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\DirectorioController;

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

Route::post('register', [AuthController::class, 'register'])
    ->name('register');

Route::post('login', [AuthController::class, 'login'])
    ->name('login');

Route::group(['middleware' => 'api', 'JwtAuth', 'prefix' => 'auth'], function ($router) {

    // Auth
    require __DIR__ . '/routes/auth.php';

    // Currency
    require __DIR__ . '/routes/currency.php';

    // Directorios
    require __DIR__ . '/routes/directorios.php';

    // Pagos
    require __DIR__ . '/routes/pagos.php';

    // Pagos
    require __DIR__ . '/routes/permissions.php';

    // Productos
    require __DIR__ . '/routes/products.php';
    
    // Perfil
    require __DIR__ . '/routes/profile.php';

    // Roles
    require __DIR__ . '/routes/roles.php';

});
