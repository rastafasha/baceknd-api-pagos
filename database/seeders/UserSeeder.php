<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Currency;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userSuperAdmin = User::create([
            'username' => 'SuperAdmin',
            'email' => 'superadmin@superadmin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        $roleSuperAdmin = Role::create([
            'name' => 'Superadmin',
            'description' => 'Obtiene todos los privilegios',
        ]);

        $userSuperAdmin->roles()->sync([$roleSuperAdmin->id]);

        //permisos para ver usuarios superadmin
        $permissions_all = [];

        // permission number 1
        $permission = Permission::create([
            'name' => 'list.users',
            'description' => 'Puede ver todos los usuarios',
        ]);

        $permissions_all[] = $permission->id;

        // permission number 2
        $permission = Permission::create([
            'name' => 'ban.user',
            'description' => 'Puede banear usuarios',
        ]);

        $permissions_all[] = $permission->id;

        // permission number 3
        $permission = Permission::create([
            'name' => 'show.user',
            'description' => 'Puede ver al usuario',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 4
        $permission = Permission::create([
            'name' => 'edit.user',
            'description' => 'Puede editar al usuario',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 5
        $permission = Permission::create([
            'name' => 'destroy.user',
            'description' => 'Puede borrar a los usuarios',
        ]);

        $permissions_all[] = $permission->id;

        // permission number 6
        $permission = Permission::create([
            'name' => 'list.roles',
            'description' => 'Puede ver los roles',
        ]);

        $permissions_all[] = $permission->id;

    // permission number 7
        $permission = Permission::create([
            'name' => 'show.role',
            'description' => 'Puede ver el role',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 8
        $permission = Permission::create([
            'name' => 'edit.role',
            'description' => 'Puede editar el role',
        ]);

        // permission number 9
        $permission = Permission::create([
            'name' => 'list.directories',
            'description' => 'Puede ver todos los directorios',
        ]);

        $permissions_all[] = $permission->id;

         // permission number 10
        $permission = Permission::create([
            'name' => 'show.directory',
            'description' => 'Puede ver el directorio',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 11
        $permission = Permission::create([
            'name' => 'edit.directory',
            'description' => 'Puede editar el directorio',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 12
        $permission = Permission::create([
            'name' => 'destroy.directory',
            'description' => 'Puede eliminar el directorio',
        ]);

        $permissions_all[] = $permission->id;

        // permission number 13
        $permission = Permission::create([
            'name' => 'list.products',
            'description' => 'Puede listar los productos',
        ]);

        $permissions_all[] = $permission->id;

         // permission number 14
        $permission = Permission::create([
            'name' => 'show.product',
            'description' => 'Puede ver el producto',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 15
        $permission = Permission::create([
            'name' => 'edit.product',
            'description' => 'Puede editar el producto',
        ]);

        $permissions_all[] = $permission->id;
        
        // permission number 16
        $permission = Permission::create([
            'name' => 'destroy.product',
            'description' => 'Puede eliminar el producto',
        ]);

        $permissions_all[] = $permission->id;

        // permission number 17
        $permission = Permission::create([
            'name' => 'list.currencies',
            'description' => 'Puede listar las divisas',
        ]);

        $permissions_all[] = $permission->id;

         // Currency number 18
        $permission = Permission::create([
            'name' => 'show.currency',
            'description' => 'Puede ver la divisa',
        ]);

        $permissions_all[] = $permission->id;
        
        // Currency number 19
        $permission = Permission::create([
            'name' => 'edit.currency',
            'description' => 'Puede editar la divisa',
        ]);

        $permissions_all[] = $permission->id;
        
        // Currency number 20
        $permission = Permission::create([
            'name' => 'destroy.currency',
            'description' => 'Puede eliminar la divisa',
        ]);

        $permissions_all[] = $permission->id;

        $roleSuperAdmin->permissions()->sync($permissions_all);


        //Role Admin
        $userAdmin = User::create([
            'username' => 'Administrador',
            'email' => 'adminitrador@administrador.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'Administrador del servicio',
        ]);

        $userAdmin->roles()->sync([$roleAdmin->id]);

        $roleAdmin->permissions()->sync([1, 3, 9, 10, 13, 14, 17, 18]);

        //Role Miembro
        $roleMember = Role::create([
            'name' => 'Miembro',
            'description' => 'Miembro',
        ]);

        // permission number 17
        $permission = Permission::create([
            'name' => 'create.your.directory',
            'description' => 'Puede crear directorios',
        ]);

        $permissions_all[] = $permission->id;

        // permission number 18
        $permission = Permission::create([
            'name' => 'see.my.directories',
            'description' => 'Puede ver sus directorios',
        ]);

        $permissions_all[] = $permission->id;

        $roleMember->permissions()->sync([17, 18]);

        //Role Invitado
        $roleGuest = Role::create([
            'name' => 'Invitado',
            'description' => 'Invitado',
        ]);
    }
}
