<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use JWTAuth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveAccess', 'list.roles');

        $roles = Role::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'roles' => $roles,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roleShow(Role $role)
    {
        Gate::authorize('haveAccess', 'show.role');

        if (!$role) {
            return response()->json([
                'message' => 'Role not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'role' => $role->load('permissions'),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roleEdit(Role $role)
    {
        Gate::authorize('haveAccess', 'edit.role');

        $permissionAll = Permission::get();

        return response()->json([
            'code' => 200,
            'status' => 'Edit Role',
            'role' => $role->load('permissions'),
            'permissionAll' => $permissionAll,
        ], 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roleUpdate(Request $request, Role $role)
    {    
        Gate::authorize('haveAccess', 'edit.role');
        $request->only([
            'name' => 'required' . $role->id,
            'description' => 'string|min:10|max:500',
        ]);

        $role->update($request->all());
        
        if ($request->get('permissions')) {
            // $role->permissions()->sync($request->get('permissions'));
            $role->permissions()->sync(request("permissions"));
        }

        return response()->json([
            'code' => 200,
            'status' => 'Update role success',
            'role' => $role,
            'role' => $role->load('permissions'),
        ], 200);

         //Validación de datos
        //  $data = $request->only('name', 'description');
        //  $validator = Validator::make($data, [
        //      'name' => 'required|max:50|string',
        //      'description' => 'required|max:50|string'
        //  ]);
        //  //Si falla la validación error.
        //  if ($validator->fails()) {
        //      return response()->json(['error' => $validator->messages()], 400);
        //  }
        //  //Buscamos el producto
        //  $role = Role::findOrfail($id);
        //  //Actualizamos el producto.
        //  $role->update([
        //      'name' => $request->name,
        //      'description' => $request->description,
        //  ]);
        //  //Devolvemos los datos actualizados.
        //  return response()->json([
        //      'message' => 'Product updated successfully',
        //      'data' => $role
        //  ], 200);

         // $role->load('permissions');

        // $permissionsRole = [];
        
        // foreach ($role->permissions as $permission) {
        //     $permissionsRole[]= $permission->id;
        // }
    }
}
