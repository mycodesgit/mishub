<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentlistController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\AccomplishmentController;
use App\Http\Controllers\OptionTaskController;
use App\Http\Controllers\GenerateReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//Login
Route::get('/login',[LoginController::class,'getLogin'])->name('getLogin');
Route::post('/login',[LoginController::class,'postLogin'])->name('postLogin');

Route::group(['middleware'=>['login_auth']],function(){
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');

    Route::get('/campuswifi/students/reg',[StudentlistController::class,'studentRead'])->name('studentRead');
    Route::get('/campuswifi/students/edit/{id}',[StudentlistController::class,'studentEdit'])->name('studentEdit');
    Route::post('/campuswifi/students/studupdatePass',[StudentlistController::class,'studentUpdate'])->name('studentUpdate');
    Route::get('/campuswifi/vouchers/code',[VoucherController::class,'voucherRead'])->name('voucherRead');
    Route::post('/campuswifi/vouchers/add',[VoucherController::class,'process'])->name('process');

    Route::get('/users/list',[UserController::class,'userRead'])->name('userRead');
    Route::post('/users/list/add',[UserController::class,'userCreate'])->name('userCreate');
    Route::get('users/edit/{id}', [UserController::class, 'userEdit'])->name('userEdit');
    Route::post('users/update', [UserController::class, 'userUpdate'])->name('userUpdate');
    Route::post('users/updatePass', [UserController::class, 'userUpdatePassword'])->name('userUpdatePassword');
    Route::get('/users/delete{id}', [UserController::class,'userDelete'])->name('userDelete');

    Route::get('/daily/accomplishment', [AccomplishmentController::class,'dailyRead'])->name('dailyRead');
    Route::post('/daily/accomplishment/add', [AccomplishmentController::class,'dailyCreate'])->name('dailyCreate');
    Route::get('/daily/accomplishment/edit/{id}', [AccomplishmentController::class,'dailyEdit'])->name('dailyEdit');
    Route::post('/daily/accomplishment/update', [AccomplishmentController::class,'dailyUpdate'])->name('dailyUpdate');
    Route::get('/daily/accomplishment/delete{id}', [AccomplishmentController::class,'dailyDelete'])->name('dailyDelete');

    Route::get('/option/taskList', [OptionTaskController::class,'optiontaskRead'])->name('optiontaskRead');
    Route::post('/option/taskList/add', [OptionTaskController::class,'optiontaskCreate'])->name('optiontaskCreate');
    Route::get('/option/taskList/edit/{id}', [OptionTaskController::class,'optiontaskEdit'])->name('optiontaskEdit');
    Route::post('/option/taskList/update', [OptionTaskController::class,'optiontaskUpdate'])->name('optiontaskUpdate');
    Route::get('/option/taskList/delete{id}', [OptionTaskController::class,'optiontaskDelete'])->name('optiontaskDelete');

    Route::get('/reports/option', [GenerateReportController::class,'genoptionRead'])->name('genoptionRead');
    Route::get('/reports/generate', [GenerateReportController::class,'generateReports'])->name('generateReports');

    Route::get('/acccount/information',[ProfileController::class,'profileRead'])->name('profileRead');
    Route::post('/acccount/information/update',[ProfileController::class,'profileUpdate'])->name('profileUpdate');
    Route::post('/acccount/information/updatePass',[ProfileController::class,'profilePassUpdate'])->name('profilePassUpdate');

    Route::get('/destroy', [DashboardController::class,'destroy'])->name('destroy');
});
