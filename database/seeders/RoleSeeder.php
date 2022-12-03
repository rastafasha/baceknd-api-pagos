<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            
            [
                'name' => 'Superadmin',
                'description' => 'Obtiene todos los privilegios',
            ],
            [
                'name' => 'Admin',
                'description' => 'Administrador del servicio',
            ],
            [
                'name' => 'Miembro',
                'description' => 'Miembro',
            ],
            [
                'name' => 'Invitado',
                'description' => 'Para los visitantes',
            ],
        ];

        foreach ($roles as $role) {
            
            $role = Role::create($role);
        }

        $permissions_all = [];

        $permission = Permission::create([
            'name' => 'List Roles',
            'description' => 'can see all Roles',
        ]);

        $permissions_all = $permission->id;

        $permission = Permission::create([
            'name' => 'Show Roles',
            'description' => 'can see show Role',
        ]);

        $permissions_all = $permission->id;
        
        $permission = Permission::create([
            'name' => 'Edit Roles',
            'description' => 'can see edit Role',
        ]);

        $permissions_all = $permission->id;
    }
}
