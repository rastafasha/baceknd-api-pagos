<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Roles;
use App\Models\User;
use App\Models\Usuarios;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{

    /**
     * Create an instace of UserAuthController
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => [
            'index',
            'rol',
            'update',
            ]]);
    }

    public function index()
    {
        $roles = Roles::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'roles' => $roles
        ], 200);
    }

    public function rol($id){
        $rol = Roles::find($id);


        if(is_object($post)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'rol' => $rol
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

    public function update($id, Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){

        // validar los datos
        $validar = \Validate::make($params_array, [
            'username' => 'required',
            'rol_id' => 'required'
        ]);
        // quitar lo que no quiero actualizar
        unset($params_array['id']);
        unset($params_array['created_at']);

        // actualizar el registro(categoria)
        $rol = Roles::where('id', $id)
                    ->where('id', $user->sub)
                    ->updateOrCreate($params_array);

        $data = [
            'code' => 200,
            'status' => 'success',
            'rol' => $params_array
        ];

        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No has enviado ninguna rol.'
            ];
        }
        // devolver los datos
        return response()->json($data, $data['code']);
    }

    private function getIdentity($request){
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);

    }
}
