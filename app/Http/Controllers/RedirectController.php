<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RedirectController extends Controller
{
    public function create(Request $req) {
        $page = $req->page;
        if (empty(Session::get('page'))) {
            Session::put('page', 'stock');
            return redirect()->route('home.index');
        } else if ($page == 'bp') {
            Session::put('page', 'bp');
            return redirect()->route('create');
        } else if ($page =='stock') {
            Session::put('page', 'stock');
            return redirect()->route('home.index');
        }
    }
}
