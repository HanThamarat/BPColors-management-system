<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function create() {

        $validate = $this->validate([
            "name"=> "required",
            "email"=> "required",
            "password"=> "required",
            "username"=> "required",
        ]);

        $response = DB::insert("insert into users(name, username, email, password, role) values(?,?,?,?,?)", [
            $this->name,
            $this->username,
            $this->email,
            Hash::make($this->password),
            $this->role,
        ]);

        if ($response == 'true') {
            $this->reset('name', 'email', 'password', 'username', 'role');
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'เพิ่มผู้ใช้งานสำเร็จ',
                timer: 1500
            );
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

    public function openForm($userId) {
        $this->Formopen = true;

        $response = DB::table('users')->whereRaw("id = '". $userId ."'")->get()[0]; 

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
        
        $validate = $this->validate([
            "edit_name"=> "required",
            "edit_email"=> "required",
            "edit_password"=> "required",
            "edit_username"=> "required",
        ]);

        $res_up = DB::table("users")->where("id", $this->userId)->update([
            "name" => $this->edit_email,
            "username" => $this->edit_username,
            "email" => $this->edit_email,
            "role" => $this->edit_role,
            "status" => $this->userStatus,
            "password" => Hash::make($this->edit_password),
        ]);

        if($res_up == '1') {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'แก้ไขข้อมูลสำเร็จ',
                timer: 1500
            );
            $this->Formopen = false;
        } else {
            $this->dispatch('alert',
                position: 'center',
                type: 'success',
                title: 'แก้ไขข้อมูลไม่สำเร็จ',
                timer: 1500
            );
            $this->Formopen = false;
        }
    }


    public function render()
    {
        return view('livewire.manage-user', [
            "userData" => DB::table("users")->get(),
        ]);
    }
}
