<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Traits\Conditionable;

class reportController extends Controller
{
    public function index(Request $request) {
        // =====================================================
        // display Condition
        // =====================================================
        if($request->page == 'report') {
            if($request->typeDisplay == 'sendinsure') {
                try {
                   $bill_no = $request->data['no_bill'];

                   $response = DB::table('tbl_claim')
                   ->selectRaw("date_dms, no_regiscar, no_policy, invoice_no, firm_all")
                   ->whereRaw("bill_no = '". $bill_no ."'")->get();

                   if(count($response) == 0) {
                     throw new \Exception("Query not found");
                   }

                   $resView = view('manageBP.report.PDF.bill-export', compact('response', 'bill_no'))->render();

                   return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                   ], 200); 
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'caljob') {
                try {
                    $month = Carbon::parse($request->data['month'])->format('Y-m');
                    $mouthName = Carbon::createFromDate($month)->format('F');
                    $year = Carbon::parse($request->data['month'])->format('Y');

                    $page = $request->typeDisplay;

                    $my = $mouthName. ', ' . $year;

                    $response = DB::table('tbl_wip')
                    ->leftJoin('tbl_claim','tbl_claim.no_claim','=','tbl_wip.no_claimex')
                    ->selectRaw("respon_name, tbl_claim.no_claim, no_regiscar, date_dms, type_doit, cal_doit")
                    ->whereRaw("DATE_FORMAT(date_start, '%Y-%m') = '". $month ."' AND respon_name = '". $request->data['techName'] ."'")->get();

                    if(count($response) == 0) {
                        throw new \Exception("query not found");
                    }

                    $resView = view('manageBP.components.content-report.table', compact('response', 'my', 'page'))->render();

                    return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'car_nopay') {
                try {
                    $page = $request->typeDisplay;
                    $response = DB::table('tbl_claim')
                    ->selectRaw("insure_name, date_bill, bill_no, no_policy, no_regiscar, payment_st, date_paybill, firm_doit, firm_sparepart, firm_all, remark")
                    ->whereRaw("SUBSTR(payment_st, 1, 2) = 'J'")->get();

                    if(count($response) == 0) {
                        throw new \Exception("query not found");
                    }

                    $resView = view("manageBP.components.content-report.table" , compact('response', 'page'))->render();

                    return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'car_nocliam') {
                try {
                    $page = $request->typeDisplay;

                    $response = DB::table('tbl_claim')
                    ->selectRaw("payment_st, car_job, date_cliam, no_claim, no_regiscar, car_model, insure_name, firm_doit, firm_sparepart, date_firmins")
                    ->whereRaw("date_cliam <> '' AND date_carin = '' AND payment_st NOT IN ('K ชำระเงินแล้ว','L ยกเลิกงานเคลม','')")->get();

                     $resView = view("manageBP.components.content-report.table" , compact('response', 'page'))->render();

                     return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'date_peak') {
                try {
                    $page = $request->typeDisplay;
                    $response = DB::table('tbl_claim')
                    ->selectRaw("payment_st, date_cliam, no_claim, no_regiscar, car_model, insure_name, firm_doit, firm_sparepart, firm_all, date_ecliam")
                    ->whereRaw("payment_st NOT IN ('K ชำระเงินแล้ว','L ยกเลิกงานเคลม') AND (date_bill is null OR bill_no='') AND total_pay=0  ORDER BY payment_st")->get();
                    
                    if(count($response) == 0) {
                        throw new \Exception("Query data error");
                    }

                    $resView = view("manageBP.components.content-report.table" , compact('response', 'page'))->render();

                    return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'wait_bill') {
                try {
                    $page = $request->typeDisplay;
                    $response = DB::table('tbl_claim')
                    ->selectRaw("payment_st, date_status, date_cliam, no_claim, no_regiscar, car_model, insure_name, firm_doit, firm_sparepart, firm_all, date_ecliam")
                    ->whereRaw("SUBSTR(payment_st, 1, 2) = 'I'")->get();

                    $resView = view("manageBP.components.content-report.table", compact("response","page"))->render();

                    return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'pase_bill') { 
                try {
                    $page = $request->typeDisplay;
                    $response = DB::table('tbl_claim')
                    ->selectRaw("date_bill, no_claim, no_policy, no_job, no_regiscar, insure_name, date_cliam, date_send, date_fecliam, invoice_no, bill_no, date_transfer, firm_doit, firm_sparepart, firm_all")
                    ->whereRaw("date_bill BETWEEN '". $request->Fdate ."' AND '". $request->Tdate ."' ORDER BY date_bill asc")->get();

                    $resView = view("manageBP.components.content-report.table", compact("response","page"))->render();

                    return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            } else if($request->typeDisplay == 'date_send') {
                try {
                    $page = $request->typeDisplay;
                    $response = DB::table('tbl_claim')
                    ->selectRaw("DATE_FORMAT(date_send, '%a %b %Y') AS DATESF, DATEDIFF(date_send, date_carin) AS sumDate, no_claim, no_regiscar, payment_st, date_send, firm_doit, firm_sparepart, firm_all")
                    ->whereRaw("date_send BETWEEN '". $request->Fdate ."' AND '". $request->Tdate ."'")->get();

                    $resView = view("manageBP.components.content-report.table", compact("response","page"))->render();

                    return response()->json([
                        'message'=> 'Query data successfully',
                        'resHtml' => $resView,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'query data error',
                        'err' => $e->getMessage(),
                    ], 500);
                }
            }

        // =====================================================
        // page Condition
        // =====================================================
        } else if($request->getName == 'techname') {
            try { 
                $page = $request->getName;
                $response = DB::table('tbl_technician')->selectRaw("name")->whereRaw("active = 'yes'")->get();

                $resView = view("manageBP.components.content-report.form", compact("response", "page"))->render();

                return response()->json([
                    "message"=> "get data success",
                    "resHtml" => $resView,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'query data error',
                ], 500);
            }
        } else if($request->getName == 'pastBill') {
            try {
                $page = $request->getName;

                $resView = view("manageBP.components.content-report.form", compact("page"))->render();

                return response()->json([
                    "message"=> "get data success",
                    "resHtml" => $resView,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'query data error',
                ], 500);
            }
        } else if ($request->getName == 'date_send') {
            try {
                $page = $request->getName;

                $resView = view("manageBP.components.content-report.form", compact("page"))->render();

                return response()->json([
                    "message"=> "get data success",
                    "resHtml" => $resView,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'query data error',
                ], 500);
            }
        } else if ($request->getName == 'pase_bill') {
            try {
                $page = $request->getName;

                $resView = view("manageBP.components.content-report.form", compact("page"))->render();

                return response()->json([
                    "message"=> "get data success",
                    "resHtml" => $resView,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'query data error',
                ], 500);
            }
        }
    } 

    public function create(Request $request) {
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $year = $request->year;

        if($request->report == 'dereport') {
            return view('manageBP.report.dereport', compact('fromdate','todate', 'year'));
        } else if($request->report == 'billreport') { 
            return view('manageBP.report.billreport', compact('fromdate', 'todate', 'year'));
        } else if($request->report == 'expectreport') {
            return view('manageBP.report.expectreport', compact('fromdate', 'todate', 'year'));
        } else if($request->report == 'reportCarstatus') {
            return view('manageBP.report.reportCarstatus', compact('fromdate', 'todate', 'year'));
        } else if ($request->report == 'jobreport') {
            return view('manageBP.report.jobreport', compact('fromdate', 'todate', 'year'));
        } else if($request->report == 'pivotclaim') {
            return view('manageBP.report.pivotclaim', compact('fromdate', 'todate', 'year'));
        } else if ($request->report == 'pivotservice') {
            return view('manageBP.report.pivotservice', compact('fromdate', 'todate', 'year'));
        } else if($request->report == 'pivotsend') {
            return view('manageBP.report.pivotsend', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'pivottotalwork') {
            return view('manageBP.report.pivottotalwork', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'todayreport') {
            return view('manageBP.report.todayreport', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'todayservice') {
            return view('manageBP.report.todayservice', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'monthreport') {
            return view('manageBP.report.monthreport', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'reportStatus') {
            return view('manageBP.report.reportStatus', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'reportEvaluate') {
            return view('manageBP.report.reportEvaluate', compact('fromdate', 'todate', 'year'));
        } else if( $request->report == 'pivotamont') {
            return view('manageBP.report.pivotamont', compact('fromdate', 'todate', 'year'));
        }
    }

    public function dereport(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;
        return view('manageBP.report.dereport');
    }

    public function billreport(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.billreport')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function expectreport(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.expectreport')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function reportCarstatus(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.reportCarstatus')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function jobreport(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.jobreport')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function pivotclaim(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.pivotclaim')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function pivotservice(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.pivotservice')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function pivotsend(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.pivotsend')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function pivottotalwork(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.pivottotalwork')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function todayreport(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.todayreport')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function todayservice(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.todayservice')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function monthreport(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.monthreport')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function reportStatus(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.reportStatus')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }

    public function reportEvaluate(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.reportEvaluate')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }
    
    public function pivotamont(Request $request) {
        $fromdata = $request->fromdata;
        $todate = $request->todate;
        $year = $request->year;

        return view('manageBP.report.pivotamont')->with(['fromdate' => $fromdata, 'todate' => $todate, 'year' => $year]);
    }
}
