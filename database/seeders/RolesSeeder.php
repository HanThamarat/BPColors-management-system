<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $superadmin = Role::create(['name' =>'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $bp = Role::create(['name' => 'bp']);
        $color = Role::create(['name' => 'color']);
        $pa = Role::create(['name' => 'pa']);

        //office
        $manage_systemBP_permission = Permission::create(['name' =>'manage all system bp']);
        $bpAdmin_permission = Permission::create(['name' =>'manage bp all']);
        $bpEmpy_permission = Permission::create(['name' =>'manage bp']);

        //color stock
        $manage_systemColor_permission = Permission::create(['name' =>'manage all system color stock']);
        $EmpyColor_permission = Permission::create(['name' =>'manage system color stock']);

        $pa_permission = Permission::create(['name' =>'nole permission']);


        $permissions_superadmin = [
            $manage_systemBP_permission,
            $manage_systemColor_permission
        ];

        $permissions_admin = [
            $bpAdmin_permission
        ];

        $permissions_bp = [
            $bpEmpy_permission
        ];

        $permission_color = [
            $EmpyColor_permission
        ];

        $superadmin->syncPermissions($permissions_superadmin);
        $admin->syncPermissions($permissions_admin);
        $bp->syncPermissions($permissions_bp);
        $color->syncPermissions($permission_color);
        $pa->syncPermissions($pa_permission);
    }
}
