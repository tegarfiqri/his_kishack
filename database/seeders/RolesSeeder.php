<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionList = [
            'Create', 'Read', 'Update', 'Delete',
        ];
        $pageList = [
            0 => 'Users',
            1 => 'Permissions',
            2 => 'Roles',
            3 => 'Master Category',
            4 => 'Master Article',
        ];

        $data = [
            ['Admin', [0, 1, 2, 3, 4]],
            ['Writer', [0, 3, 4]],
            ['User', [4]],
        ];

        foreach ($data as $item) {
            $role = Role::firstOrNew(['name' => $item[0]]);
            $role->save();
            foreach ($item[1] as $key => $value) {
                foreach ($permissionList as $permission) {
                    $permission = Permission::firstOrNew(['name' => $permission . ' ' . $pageList[$value]]);
                    $permission->save();
                    $role->rolePermissions()->firstOrCreate(['permission_id' => $permission->id, 'role_id' => $role->id]);
                }
            }
        }
    }
}
