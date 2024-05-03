<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\claimController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/getBrand', [App\Http\Controllers\ClaimControllers::class, 'brand']);


Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('manageBP.bpClaim');
    })->name('dashboard');
    Route::get('/cusPage', function() {
        return view('manageBP.customer-screen');
    })->name('cusPage');
    Route::get('/showbp', function() {
        return view('manageBP.showbp-data');
    })->name('showbp');
    Route::get('/postreport', function() {
        return view('manageBP.get-report');
    })->name('postreport');
    Route::get('/billreport', function() {
        return view('manageBP.report.billreport');
    })->name('billreport');
    Route::get('/dereport', function() {
        return view('manageBP.report.dereport');
    })->name('dereport');
    Route::get('/expectreport', function() {
        return view('manageBP.report.expectreport');
    })->name('expectreport');
    Route::get('/reportCarstatus', function() {
        return view('manageBP.report.reportCarstatus');
    })->name('reportCarstatus');

    //Controller
    // Route::get('/getExcel', [App\Http\Controllers\report::class, 'reportExcel']);

    // Route::get('/dereport', [App\Http\Controllers\reportController::class, 'dereport']);
    // Route::get('/billreport', [App\Http\Controllers\reportController::class, 'billreport']);
    // Route::get('/expectreport', [App\Http\Controllers\reportController::class, 'expectreport']);
    // Route::get('/reportCarstatus', [App\Http\Controllers\reportController::class, 'reportCarstatus']); 
    // Route::get('/jobreport', [App\Http\Controllers\reportController::class, 'jobreport']); 
    // Route::get('/pivotclaim', [App\Http\Controllers\reportController::class, 'pivotclaim']); 
    // Route::get('/pivotservice', [App\Http\Controllers\reportController::class, 'pivotservice']); 
    // Route::get('/pivotsend', [App\Http\Controllers\reportController::class, 'pivotsend']); 
    // Route::get('/pivottotalwork', [App\Http\Controllers\reportController::class, 'pivottotalwork']); 
    // Route::get('/todayreport', [App\Http\Controllers\reportController::class, 'todayreport']); 
    // Route::get('/todayservice', [App\Http\Controllers\reportController::class, 'todayservice']); 
    // Route::get('/monthreport', [App\Http\Controllers\reportController::class, 'monthreport']); 
    // Route::get('/reportStatus', [App\Http\Controllers\reportController::class, 'reportStatus']); 
    // Route::get('/reportEvaluate', [App\Http\Controllers\reportController::class, 'reportEvaluate']); 
    // Route::get('/pivotamont', [App\Http\Controllers\reportController::class, 'pivotamont']); 

    Route::resource('report', App\Http\Controllers\reportController::class);
});
