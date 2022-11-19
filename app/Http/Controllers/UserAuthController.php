<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;


class UserAuthController extends Controller
{
    /**
     * Create an instace of UserAuthController
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => [
            'login',
            'register',
            'index',
            'show'
            ]]);
    }

    /**
     * Register a User
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'username' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:usuarios',
            'password' => 'required|string|min:5',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $usuarios = Usuarios::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User registered successfully',
            'usuarios' => $usuarios
        ], 201);
    }

    /**
     * Get a JWT token after successful login
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:5',
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
     * Get the Auth user using token.
     * @return \Illuminate\Http\JsonResponse
     */
    public function user() {
        return response()->json(auth()->user());
    }


    /**
     * Logout user (Invalidate the token).
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['status' => 'success', 'message' => 'User logged out successfully']);
    }

    //crud

}
