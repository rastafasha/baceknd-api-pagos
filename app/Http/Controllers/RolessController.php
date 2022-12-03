<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $roles = Role::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'roles' => $roles
        ], 200);
    }

    public function rol($id){
        $rol = Role::find($id);


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
}
