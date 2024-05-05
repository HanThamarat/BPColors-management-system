<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NavLink extends Component
{
    public function render() {

        $userId = Auth::id();

        return view('livewire.nav-link', [
            "UserRole" => DB::table("users")->select('role')->whereRaw("id = '". $userId ."'")->get(),
        ]);
    }
}
