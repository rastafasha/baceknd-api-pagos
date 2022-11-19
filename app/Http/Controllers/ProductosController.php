<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productos;
use App\Models\Pagos;
use App\Models\Usuarios;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
     /**
     * Create an instace of UserAuthController
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => [
            'index',
            'show',
            ]]);
    }

    public function index()
    {
        $productos = Productos::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'productos' => $productos
        ], 200);
    }

    public function rol($id){
        $producto = Productos::find($id);


        if(is_object($producto)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $producto
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La entrada no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }
}
