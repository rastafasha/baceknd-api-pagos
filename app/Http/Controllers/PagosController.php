<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos;
use App\Models\Usuarios;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class PagosController extends Controller
{

     /**
     * Create an instace of UserAuthController
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => [
            'index',
            'show',
            'pagosbyUser',
            'recientes',
            ]]);
    }

    public function index()
    {
        $pagos = Pagos::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'pagos' => $pagos
        ], 200);
    }

    public function show($id){
        $pago = Pagos::find($id);


        if(is_object($pago)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'pago' => $pago
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

    public function pagos($id){
        $pago = Pagos::find($id)->load('usuarios');


        if(is_object($usuario)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'usuario' => $usuario
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


    public function pagosbyUser($id){
        $pagos = Pagos::where('user_id', $id)->get();


        if(is_object($pagos)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'pagos' => $pagos
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

    public function recientes()
    {
        $pagos = Pagos::orderBy('created_at', 'DESC')
        ->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'pagos' => $pagos
        ], 200);
    }
}
