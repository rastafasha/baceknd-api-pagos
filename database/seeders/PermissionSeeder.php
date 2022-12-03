<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            
            [
                'name' => 'list',
                'description' => 'can see all records',
            ],
            [
                'name' => 'create',
                'description' => 'can create',
            ],
            [
                'name' => 'show',
                'description' => 'can see',
            ],
            [
                'name' => 'edit',
                'description' => 'can edit',
            ],
            [
                'name' => 'destroy',
                'description' => 'can destroy',
            ],
        ];

        foreach ($permissions as $permission) {
            
            $permission = Permission::create($permission);
        }
    }
}
