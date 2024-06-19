<?php

namespace App\Http\Controllers\colorStock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index(Request $req) {
        if($req->page == 'incomingStock') {
            $stockData = DB::select("
                WITH sumGramQuantity AS (
                    SELECT ProductNo,SUM(TB_COLORST_IN.GramQuantity) as GramQuantityIn
                    FROM (TB_COLOR_STOCK 
                    LEFT JOIN TB_COLORST_IN ON TB_COLOR_STOCK.ProductNo = TB_COLORST_IN.Product_Id)
                    WHERE TB_COLORST_IN.GramQuantity IS NOT NULL AND TB_COLORST_IN.status = 'active' GROUP BY TB_COLOR_STOCK.ProductNo
                ),
                sumStockOut AS (
                    SELECT ProductNo,
                    CASE 
                        WHEN SUM(TB_COLORST_OUT.OutGramQuantity) IS NOT NULL THEN (SUM(TB_COLORST_OUT.OutGramQuantity))
                        WHEN SUM(TB_COLORST_OUT.OutGramQuantity) IS NULL THEN 'Stock Out NotFound'
                    END AS StockOutAfter
                    FROM (TB_COLOR_STOCK 
                    LEFT JOIN TB_COLORST_OUT ON TB_COLOR_STOCK.ProductNo = TB_COLORST_OUT.Product_Id)
                    WHERE TB_COLORST_OUT.OutGramQuantity IS NOT NULL AND TB_COLORST_OUT.status = 'active' GROUP BY TB_COLOR_STOCK.ProductNo
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

            return view('stock-color.content-view.content-stock.view', compact('stockData'));
        }
    }

    public function store(Request $req) {
       
    }
}
