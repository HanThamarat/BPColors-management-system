<?php

namespace App\Http\Controllers\colorStock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TB_STOCK\TB_COLORIN;
use App\Models\TB_STOCK\TB_COLOROUT;
use App\Models\TB_STOCK\TB_COLORST;

class StocklistController extends Controller
{
    public function index() {
        return view('stock-color.content-view.content-list.view');
    }

    public function create(Request $req) {
        if($req->page == 'stockIn') {
            $res = TB_COLORIN::whereRaw("DateSt_In BETWEEN '". $req->Fdate ."' AND '". $req->Tdate ."'")->get();

            $resHtml = view('stock-color.content-view.content-list.content-listin.view', compact('res'))->render();

            return response()->json([
               'message' => "getData successfully",
               'resHtml' => $resHtml,
            ], 200);
        } else if($req->page == 'stockOut') {
            $res = TB_COLOROUT::whereRaw("DateSt_Out BETWEEN '". $req->Fdate ."' AND '". $req->Tdate ."'")->get();

            $resHtml = view('stock-color.content-view.content-list.content-listout.view', compact('res'))->render();

            return response()->json([
               'message' => "getData successfully",
               'resHtml' => $resHtml,
            ], 200);
        }
    }
}
