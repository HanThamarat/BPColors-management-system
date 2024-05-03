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

        dd($response);
    }
    public function render()
    {
        return view('livewire.manage-user');
    }
}
