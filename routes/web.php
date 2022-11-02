<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DonaturController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DashboardController;

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
    return view('welcome');
});

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {

        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        
        //route resource categories
        Route::resource('/category', CategoryController::class,['as' => 'admin']);

        //route resource campaign
        Route::resource('/campaign', CampaignController::class, ['as' => 'admin']);

        //route donatur
        Route::get('/donatur', [DonaturController::class, 'index'])->name('admin.donatur.index');

        //route donation
        Route::get('/donation', [DonationController::class, 'index'])->name('admin.donation.index');
        Route::get('/donation/filter', [DonationController::class, 'filter'])->name('admin.donation.firter');
    });
});
