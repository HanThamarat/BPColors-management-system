<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageUser extends Component
{
    public $name;
    public $username;
    public $password;
    public $email;
    public $role;
    public $userId;
    public $Formopen;
    public $userStatus;

    public $edit_name;
    public $edit_username;
    public $edit_password;
    public $edit_email;
    public $edit_role;

    public $user_original = true;
    public $user_PA = false;

    public $createUser = true;
    public $changeRole = false;

    public $createRoleName;
    public $PermissionName;

    public function placeholder() {
        return view('components.manage-placholder');
    }


    public function create() {
        if ($this->role != "PA") {
            $validate = $this->validate([
                "name"=> "required",
                "password"=> "required",
                "username"=> "required",
            ]);


            $response = User::create([
                "name" => $this->name,
                "username" => $this->username,
                "password" => Hash::make($this->password),
            ]);
            
            $response->assignRole($this->role);
        } else {
            $response = User::create([
                "name" => $this->name,
            ]);
            $response->assignRole($this->role);
        }

        if ($response == 'true') {
            $this->reset('name', 'email', 'password', 'username', 'role');
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'เพิ่มผู้ใช้งานสำเร็จ',
                timer: 1500
            );
            $this->user_PA = true;
            $this->user_original = false;
        } else {
            $this->dispatch('alert',
                position: 'center',
                type: 'error',
                title: 'เพิ่มผู้ใช้งานไม่สำเร็จ',
                timer: 1500
            );
        }


    }

    public function deleteUser($userId) {
        $res = DB::table('users')->where('id', $userId)->delete();

        if($res == '1') {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                timer: 1500
            );
        } else {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'ลบข้อมูลไม่สำเร็จ',
                timer: 1500
            );
        }
    }

    public function handledetail($tail_id) {
        if($tail_id == 1) {
            $this->user_PA = true;
            $this->user_original = false;
        } else {
            $this->user_original = true;
            $this->user_PA = false;
        }
    }

    public function handleHeader($tail_id) {
        if($tail_id == 1) {
            $this->createUser = false;
            $this->changeRole = true;
        } else {
            $this->changeRole = false;
            $this->createUser = true;
        }
    }


    public function openForm($userId) {
        $this->Formopen = true;

        $response = DB::table('users')
        ->selectRaw("name, username, email, role, status")
        ->whereRaw("id = '". $userId ."'")
        ->get()[0]; 

        $this->edit_name =  $response->name;
        $this->edit_username = $response->username;
        $this->edit_email = $response->email;
        $this->edit_role = $response->role;
        $this->userStatus = $response->status;
        $this->userId = $userId;
    }

    public function closeForm() {
        $this->Formopen = false;
    }

    public function saveUser() {

        $res = DB::table("users")->selectRaw("role")->whereRaw("id = '". $this->userId ."'")->get()[0];

        if($res->role != 'PA') {
            $validate = $this->validate([
                "edit_name"=> "required",
                "edit_username"=> "required",
            ]);
    
            if($this->edit_password != '') {
                $res_up = DB::table("users")->where("id", $this->userId)->update([
                    "name" => $this->edit_name,
                    "username" => $this->edit_username,
                    "role" => $this->edit_role,
                    "status" => $this->userStatus,
                    "password" => Hash::make($this->edit_password),
                ]);
            } else {
                $res_up = DB::table("users")->where("id", $this->userId)->update([
                    "name" => $this->edit_name,
                    "username" => $this->edit_username,
                    "role" => $this->edit_role,
                    "status" => $this->userStatus,
                ]);
            }
    
            if($res_up == '1') {
                $this->reset('edit_name', 'edit_username', 'edit_password', 'edit_role', 'userStatus');
                $this->dispatch('alert',
                    position: 'center',
                    type: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ',
                    timer: 1500
                );
                $this->Formopen = false;
            } else {
                $this->reset('edit_name', 'edit_username', 'edit_password', 'edit_role', 'userStatus');
                $this->dispatch('alert',
                    position: 'center',
                    type: 'success',
                    title: 'แก้ไขข้อมูลไม่สำเร็จ',
                    timer: 1500
                );
                $this->Formopen = false;
            }
        } else {
            $validate = $this->validate([
                "edit_name"=> "required",
            ]);

            $res_up = DB::table("users")->where("id", $this->userId)->update([
                "name" => $this->edit_name,
                "status" => $this->userStatus,
            ]);

            if($res_up == '1') {
                $this->reset('edit_name', 'edit_email', 'edit_username', 'edit_password', 'edit_role', 'userStatus');
                $this->dispatch('alert',
                    position: 'center',
                    type: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ',
                    timer: 1500
                );
                $this->Formopen = false;
            } else {
                $this->reset('edit_name', 'edit_email', 'edit_username', 'edit_password', 'edit_role', 'userStatus');
                $this->dispatch('alert',
                    position: 'center',
                    type: 'success',
                    title: 'แก้ไขข้อมูลไม่สำเร็จ',
                    timer: 1500
                );
                $this->Formopen = false;
            }
        }
    }

    public function createRole() {
        
        $this->validate([
            "createRoleName"=> "required",
            "PermissionName"=> "required",
        ]);

        $role = Role::create(['name' => $this->createRoleName, 'guard_name' => 'web']);
        $permission = Permission::create(['name' => $this->PermissionName, 'guard_name' => 'web']);

        $role->syncPermissions($permission);

        $this->reset('createRoleName', 'PermissionName');
        $this->dispatch('alert',
            position: 'center',
            type: 'success',
            title: 'เพิ่มสิทธ์สำเร็จ',
            timer: 1500
        );
    }
    
    public function render()
    {
        $pa_role = ['PA'];
        $user_role = ['admin','superadmin', 'BP', 'colorstock'];
        return view('livewire.manage-user', [
            "userData" => User::
            selectRaw("id ,name, username, status, email")
            ->whereHas('roles', function($query) use ($user_role) {
                $query->whereIn('name', $user_role);
            })->get(),
            "userdata_pa" => User::
            selectRaw("id ,name, username, status, email")
            ->whereHas('roles', function($q) use ($pa_role){
                $q->whereIn('name', $pa_role);
            })->get(),
            "count_u_original" => User::
            selectRaw("COUNT(id) AS COUNTU")
            ->whereHas('roles', function($query) use ($user_role) {
                $query->whereIn('name', $user_role);
            })->get()[0],
            "count_u_pa" => User::
            selectRaw("COUNT(id) AS COUNTPA")
            ->whereHas('roles', function($query) use ($pa_role) {
                $query->whereIn('name', $pa_role);
            })->get()[0],
            "getRole" => DB::table('roles')->selectRaw("name")->get(),
            "getRoledetail" => DB::table('roles')
            ->selectRaw("roles.name AS roleName, permissions.name AS permissionName")
            ->join("role_has_permissions", "roles.id", "=", "role_has_permissions.role_id")
            ->join("permissions", "permissions.id", "=", "role_has_permissions.permission_id")
            ->get(),
        ]);
    }
}
