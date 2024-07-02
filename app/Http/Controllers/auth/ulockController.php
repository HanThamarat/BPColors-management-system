<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ulockController extends Controller
{
    public function index(Request $req) {
        try {
            if($req->page === 'lockscreen') {
                $response = User::where('id', auth()->user()->id)->first();
    
                if(Hash::check($req->passUnLock, $response->password)) {
                    return null;
                } else {
                    throw new \Exception('รหัสผ่านไม่ถูกต้อง');
                }

                return response()->jon([
                    "message" => "authozation successfully"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message" => "authozation faild"
            ]);
        }
    }
}
