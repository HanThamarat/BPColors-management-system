<?php

namespace App\Http\Controllers\colorStock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//model to database
use App\Models\TB_STOCK\TB_COLORST;
use App\Models\TB_STOCK\TB_COLORIN;
use App\Models\TB_STOCK\TB_COLOROUT;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index() {
        $stockData = DB::select("
          WITH sumGramQuantity AS (
                SELECT ProductNo,SUM(TB_COLORST_IN.GramQuantity) as GramQuantityIn
                FROM (TB_COLOR_STOCK 
                LEFT JOIN TB_COLORST_IN ON TB_COLOR_STOCK.ProductNo = TB_COLORST_IN.Product_Id)
                WHERE TB_COLORST_IN.GramQuantity IS NOT NULL GROUP BY TB_COLOR_STOCK.ProductNo
            ),
            sumStockOut AS (
                SELECT ProductNo,
                CASE 
                    WHEN SUM(TB_COLORST_OUT.OutGramQuantity) IS NOT NULL THEN (SUM(TB_COLORST_OUT.OutGramQuantity))
                    WHEN SUM(TB_COLORST_OUT.OutGramQuantity) IS NULL THEN 'Stock Out NotFound'
                END AS StockOutAfter
                FROM (TB_COLOR_STOCK 
                LEFT JOIN TB_COLORST_OUT ON TB_COLOR_STOCK.ProductNo = TB_COLORST_OUT.Product_Id)
                WHERE TB_COLORST_OUT.OutGramQuantity IS NOT NULL GROUP BY TB_COLOR_STOCK.ProductNo
            )
            SELECT TB_COLOR_STOCK.ProductNo, ProductDetail, UnitType, UnitPrice, UnitStart ,(GramQuantityIn - StockOutAfter) AS StockInAfter, StockOutAfter
                FROM ((TB_COLOR_STOCK 
                LEFT JOIN sumGramQuantity ON TB_COLOR_STOCK.ProductNo = sumGramQuantity.ProductNo)
                LEFT JOIN sumStockOut ON TB_COLOR_STOCK.ProductNo = sumStockOut.ProductNo
                )
        ");
        return view('stock-color.content-view.content-createstock.view', compact('stockData'));
    }

    public function create(Request $req) {
        $stockCal = DB::select("
            WITH sumGramQuantity AS (
                SELECT ProductNo,SUM(TB_COLORST_IN.GramQuantity) as GramQuantityIn
                FROM (TB_COLOR_STOCK 
                LEFT JOIN TB_COLORST_IN ON TB_COLOR_STOCK.ProductNo = TB_COLORST_IN.Product_Id)
                WHERE TB_COLORST_IN.GramQuantity IS NOT NULL GROUP BY TB_COLOR_STOCK.ProductNo
            ),
            sumStockOut AS (
                SELECT ProductNo,
                CASE 
                    WHEN SUM(TB_COLORST_OUT.OutGramQuantity) IS NOT NULL THEN (SUM(TB_COLORST_OUT.OutGramQuantity))
                    WHEN SUM(TB_COLORST_OUT.OutGramQuantity) IS NULL THEN 'Stock Out NotFound'
                END AS StockOutAfter
                FROM (TB_COLOR_STOCK 
                LEFT JOIN TB_COLORST_OUT ON TB_COLOR_STOCK.ProductNo = TB_COLORST_OUT.Product_Id)
                WHERE TB_COLORST_OUT.OutGramQuantity IS NOT NULL GROUP BY TB_COLOR_STOCK.ProductNo
            )
            SELECT TB_COLOR_STOCK.ProductNo, ProductDetail, UnitType, UnitPrice, UnitStart,
                CASE 
                    WHEN ROUND((((GramQuantityIn - StockOutAfter) / GramQuantityIn) * 100), 0) < 0 THEN 0
                    WHEN ROUND((((GramQuantityIn - StockOutAfter) / GramQuantityIn) * 100), 0) IS NOT NULL THEN ROUND((((GramQuantityIn - StockOutAfter) / GramQuantityIn) * 100), 0)
                    WHEN ROUND((((GramQuantityIn - StockOutAfter) / GramQuantityIn) * 100), 0) IS NULL THEN 100
                END AS StockCal
                FROM ((TB_COLOR_STOCK 
                LEFT JOIN sumGramQuantity ON TB_COLOR_STOCK.ProductNo = sumGramQuantity.ProductNo)
                LEFT JOIN sumStockOut ON TB_COLOR_STOCK.ProductNo = sumStockOut.ProductNo
                )
        ");

        if($req->page == 'manageStock') {
            try {
                $res = TB_COLORST::whereRaw("ProductNo = '". $req->ProductNo ."'")->get();
    
                if(count($res) == 0) {
                    throw new \Exception('ไม่สามารถเพิ่มสต็อกได้ เนื่องจากไม่ทีรหัสที่กรอกมา');
                 }
    
                if($req->StockContent == 'stockIn') {
                    $resHtml = view('stock-color.content-view.content-stock.content-stockin.view', compact('res'))->render();
                } else {
                    $resHtml = view('stock-color.content-view.content-stock.content-stockout.view', compact('res'))->render();
                }
    
                return response()->json([
                    'message' => "",
                    'resHtml' => $resHtml,
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else if($req->page == 'getDataStockCal') {   
            try {

                $resHtml = view('stock-color.content-view.content-stock.content-stockcal.viewFetch', compact('stockCal'))->render();

                return response()->json([
                    "message" => "get stockcal success",
                    "resHtml" => $resHtml,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }
        }
    }

    public function store(Request $req) {
        $page = $req->page;
        $data = $req->data;
        $now = Carbon::now();
        $dataformat = $now->toDateString();
        if($page == 'createStock') {
            try {
                $count = TB_COLORST::where('ProductNo', $data['ProductId'])->count();
                if($count > 0) {
                   throw new \Exception('ไม่สามารถเพิ่มสินค้าได้ เนื่องจากสินค้านี้มีอยู่แล้ว');
                }

                $resStock = TB_COLORST::create([
                    "ProductNo" => $data['ProductId'],
                    "ProductPrice" => $data['ProductPrice'],
                    "UnitStart" => $data['UnitStart'],
                    "UnitPrice" => $data['UnitPrice'],
                    "UnitType" => $data['unitType'],
                    "ProductDetail" => $data['ProductDetail'],
                ]);

                $resSTIN = TB_COLORIN::create([
                    "Product_Id" => $data['ProductId'],
                    "GramQuantity" => $data['UnitStart'],
                    "DateSt_In" => $dataformat,
                    "InUnitPirece" => $data['UnitPrice'],
                    "Product_con" => "good",
                ]);

                return response()->json([
                    'message' => 'เพิมพ์สต็อกสีเรียบร้อยแล้ว',
                    'body' => [$resStock, $resSTIN],
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
        } else if($page == 'stockIn') {
            $data = $req->data;
            try {
                $res = TB_COLORIN::create([
                    "Product_Id" => $data['ProNo'],
                    "GramQuantity" => $data['GramQuantityIn'],
                    "InUnitPirece" => $data['UnitPriceSumIn'],
                    "Product_con" => $data['conditionProduct'],
                    "DateSt_In" => $data['StockData'],
                ]);
                
                return response()->json([
                    'message' => 'เพิมพ์สต็อกสีเรียบร้อยแล้ว',
                    'body' => $res,
                ], 200);
            } catch(\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else if($page =='stockOut') {
            try{
                $data = $req->data;

                $recheckStockout = DB::select("
                   SELECT ProductNo,
                    CASE 
                        WHEN (SUM(TB_COLORST_IN.GramQuantity) - SUM(TB_COLORST_OUT.OutGramQuantity)) IS NOT NULL THEN (SUM(TB_COLORST_IN.GramQuantity) - SUM(TB_COLORST_OUT.OutGramQuantity))
                        WHEN (SUM(TB_COLORST_IN.GramQuantity) - SUM(TB_COLORST_OUT.OutGramQuantity)) IS NULL THEN SUM(TB_COLORST_IN.GramQuantity)
                    END AS StockInAfter
                    FROM ((TB_COLOR_STOCK 
                    LEFT JOIN TB_COLORST_IN ON TB_COLOR_STOCK.ProductNo = TB_COLORST_IN.Product_Id)
                    LEFT JOIN TB_COLORST_OUT ON TB_COLOR_STOCK.ProductNo = TB_COLORST_OUT.Product_Id)
                    WHERE TB_COLORST_IN.GramQuantity IS NOT NULL AND TB_COLOR_STOCK.ProductNo = '". $data['ProNoOut'] ."' GROUP BY TB_COLOR_STOCK.ProductNo
                ");

                $calRecheck = ($recheckStockout[0]->StockInAfter - $data['UnitQuatityOut']);

                if($calRecheck < 0) {
                    throw new \Exception('ไม่สามารถนำออกได้ ้เนื่องจากสต็อกไม่เพียง');
                }

                $res = TB_COLOROUT::create([
                    'Product_Id' => $data['ProNoOut'],
                    'OutGramQuantity' => $data['UnitQuatityOut'],
                    'OutUnitPrice' => $data['UnitPriceOut'],
                    'ReferNo' => $data['referNo'],
                    'DateSt_Out' => $data['StockDataOut'],
                ]);

                return response()->json([
                    'message' => 'นำสต็อกสีออกเรียบร้อยแล้ว',
                    'body' => $res,
                ], 200);
            } catch(\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }
        }
    }
}
