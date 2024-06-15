<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\claimController;
use Illuminate\Support\Facades\Gate;

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
use App\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:colorstock','role:superadmin',])->group(function() {
    
    Route::resource("home", App\Http\Controllers\colorStock\HomeController::class);
    Route::resource("stock", App\Http\Controllers\colorStock\StockController::class);
    Route::resource("page", App\Http\Controllers\colorStock\PageController::class);
    Route::resource("stocklist", App\Http\Controllers\colorStock\StocklistController::class);

});

// path for check role redirect
Route::get('/dashboard', [AuthenticatedSessionController::class, 'create'])->name('dashboard');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified','roleBp:BP','roleBp:admin','roleBp:superadmin'])->group(function () {
    Route::get('/create', function () {
        return view('manageBP.bpClaim');
    })->name('create');
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
        if(Gate::allows('isVerifyrole')) { 
            return view('manageBP.manage-user');
        } else {
            return view('AuthorizeCheck');
        }
    })->name('manage-user');
    Route::get('/manage-job', function() {
        if(Gate::allows('isVerifyrole')) { 
            return view('manageBP.manage-job');
        } else {
            return view('AuthorizeCheck');
        }
    })->name('manage-job');   

    Route::resource('report', App\Http\Controllers\reportController::class);
});
