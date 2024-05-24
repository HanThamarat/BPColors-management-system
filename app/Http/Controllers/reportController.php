<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function create(Request $request) {
        $fromdate = $request->fromdata;
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
