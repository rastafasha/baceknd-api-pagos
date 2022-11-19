<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Directorio;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class DirectorioController extends Controller
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
        $directorios = Directorio::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'directorios' => $directorios
        ], 200);
    }

    public function show($id){
        $directorio = Directorio::find($id);


        if(is_object($directorio)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'directorio' => $directorio
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

    public function update(Request $request, $id)
    {

        //rcoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        // validar datos
        $validate = \Validator::make($params_array, [

            'role_id' => 'number',
        ]);


        // actualizar usuario en bd
        $user_update = User::where('id', $id)
            ->update($params_array);

        $user_update = User::find($id);
        $user_update->save();

        // devolver array con resultado
        $data = array(
            'status' => 'success',
            'code' => 200,
            'user' => $user_update,
            'changes' => $params_array
        );

        return response()->json($data, $data['code']);

    }
}
