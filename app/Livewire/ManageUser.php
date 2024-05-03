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
    public function render()
    {
        return view('livewire.manage-user', [
            "userData" => DB::table("users")->get(),
        ]);
    }
}
