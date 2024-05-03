<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand_car;
use Illuminate\Support\Facades\DB;

class ClaimControllers extends Controller
{
    public function brand() {
        $brandData = DB::table('brand_cars')->get();
        
        return response()->json($brandData);
    }
}
