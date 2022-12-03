<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
     /**
     * Create an instace of UserAuthController
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => [
            'login',
            'index',
            'show',
            'recientes',
            ]]);
    }


    /**
     * Get a JWT token after successful login
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'string',
            'password' => 'required|string|min:5',
            // 'email' => 'string|email|max:100|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['status' => 'failed', 'message' => 'Invalid username and password.', 'error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

     /**
     * Get the token array structure.
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


    /**
     * Refresh a JWT token
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Logout user (Invalidate the token).
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['status' => 'success', 'message' => 'User logged out successfully']);
    }


    public function index()
    {
        $usuarios = Usuarios::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'usuarios' => $usuarios
        ], 200);
    }

    public function show($id){
        $usuario = Usuarios::find($id)->load('directorios')->load('pagos');


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

    public function recientes()
    {
        $usuarios = Usuarios::orderBy('created_at', 'DESC')
        ->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'usuarios' => $usuarios
        ], 200);
    }

    public function update($id, Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        // datos para devolver
        $data = array(
            'code' => 200,
            'status' => 'success',
            'usuario' => $params_array
        );

        if(!empty($params_array)){
            // validar los datos
        $validate = \Validator::make($params_array, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        if($validate->fails()){

            $data['errors'] = $validate->errors();

            return response()->json($data, $data['code']);
        }
        // eliminar lo que no queremos actualizar
        unset($params_array['id']);
        unset($params_array['user_id']);
        unset($params_array['created_at']);
        unset($params_array['user']);

        // conseguir el usuario identificado
        $usuario = $this->getIdentity($request);

        //buscar el registro
        $usuario = Usuario::where('id', $id)
                    ->updateOrCreate($params_array);

        if(!empty($usuario) && is_object($usuario)){

            //Actualizar el registro en concreto
            $usuario->update($params_array);

            // devolver respuesta
            $data = array(
                'code' => 200,
                'status' => 'success',
                'usuario' => $usuario,
                'changes' => $params_array
            );
        }


        // actualizar registro
        $usuario = Usuario::where('id', $id)
                    ->updateOrCreate($params_array);
        }


        return response()->json($data, $data['code']);
    }

    public function updatePersonalInformation(Request $request, $id)
    {
        $data = $request->json()->all();

        $user = User::findOrFail($id);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->is_active = $data['is_active'];
        $user->role_id = $data['role_id'];
        $user->save();


        // devolver array con resultado
        $data = array(
            'status' => 'success',
            'code' => 200,
            'user' => $user
        );

        return response()->json($data, $data['code']);

    }

    // subir imagen avatar
    public function upload(Request $request)
    {
        $user_auxiliar = User::find($request->user()->id);


        // recoger datos
        $image = $request->file('file0'); // llama los archivos file0, file1...

        // validar imagen
        $validate = \Validator::make($request->all(), [
            'file0' => 'required|mimes:jpg,jpeg,png,gif' // comprobar el tipo de archivo (imagen)
        ]);

        // guardar imagen


        if ($image) {

            $image_name = time() . $image->getClientOriginalName(); // hace la imagen unica
            $image->storeAs('users', $image_name, 'public');

            $user_auxiliar->image = $image_name;
            $user_auxiliar->save();

            $data = array(
                'code' => 200,
                'status' => 'success',
                'image' => $image_name
            );

        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'mesaje' => 'Error al subir imagen',
            );

        }

        //return response($data, $data['code'])->header('Content-Type', 'text/plain'); //devuelve el resultado

        return response()->json($data, $data['code']);// devuelve un objeto json
    }

    public function getImage($filename)
    {

        //comprobar si existe la imagen
        $isset = \Storage::disk('users')->exists($filename);
        if ($isset) {
            $file = \Storage::disk('users')->get($filename);
            return new Response($file, 200);
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'Imagen no existe',
            );

            return response()->json($data, $data['code']);
        }

    }



    public function deleteFotoPerfil($id)
    {
        $user = User::findOrFail($id);
        Storage::delete('users/' . $user->image);
        $user->image = '';
        $user->save();
        return response()->json([
            'data' => $user,
            'msg' => [
                'summary' => 'Archivo eliminado',
                'detail' => '',
                'code' => ''
            ]
        ]);
    }

    public function destroy($id, Request $request){

        // conseguir el usuario identificado
        $user = $this->getIdentity($request);


        // conseguir el post
        $user =  User::where('id', $id)
                        ->first();

        if(!empty($user)){

            // borrar
            $user->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el user no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

    private function getIdentity($request){
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);

    }
}
