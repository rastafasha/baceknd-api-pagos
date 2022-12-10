<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {   
        
        $permissions = Permission::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'Permissions' => $permissions
        ], 200);
    }

    public function permissionCreate() {

    }

    public function permissionStore() {

    }

    public function permissionEdit() {

    }

    public function permissionUpdate() {

    }

    public function permissionDestroy() {

    }
}
