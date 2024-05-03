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
    Route::get('/manage-user', function() {
        return view('manageBP.manage-user');
    })->name('manage-user');

    Route::resource('report', App\Http\Controllers\reportController::class);
});
