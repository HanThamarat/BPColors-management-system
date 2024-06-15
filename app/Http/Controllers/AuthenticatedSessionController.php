<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public function create(){
        $role = ['colorstock'];
        $response = User::
        selectRaw("id, name")
        ->whereRaw("id = '". auth()->user()->id ."'")
        ->whereHas('roles', function($q) use ($role) {
            $q->whereIn('name', $role);
        })->get();

        if (count($response) > 0) {
            return redirect()->intended(RouteServiceProvider::COLOR);
        } 
        return redirect()->intended(RouteServiceProvider::BP);
    }
}
