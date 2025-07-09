<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Modules\DashboardController;
use App\Http\Controllers\Modules\DataHasilProduksiController;
use App\Http\Controllers\Modules\DataHasilQcController;
use App\Http\Controllers\Modules\KelolaPermasalahanController;
use App\Http\Controllers\Modules\LaporanHasilProduksiController;
use App\Http\Controllers\Modules\MasterProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\PermissionController;
use App\Http\Controllers\UserManagement\UserManagementController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reloadCaptcha');
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'loginAction'])->name('login.action');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('default', [IndexController::class, 'default'])->name('default');

Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['prefix' => 'master_produk'], function () {
        Route::get('/', [MasterProdukController::class, 'index'])->name('master_produk');
        Route::get('create', [MasterProdukController::class, 'create'])->name('master_produk.create');
        Route::post('store', [MasterProdukController::class, 'store'])->name('master_produk.store');
        Route::get('edit/{id}', [MasterProdukController::class, 'edit'])->name('master_produk.edit');
        Route::patch('update/{id}', [MasterProdukController::class, 'update'])->name('master_produk.update');
        Route::post('destroy', [MasterProdukController::class, 'destroy'])->name('master_produk.destroy');
    });

    Route::group(['prefix' => 'laporan_hasil_produksi'], function () {
        Route::get('/', [LaporanHasilProduksiController::class, 'index'])->name('laporan_hasil_produksi');
        Route::get('export-pdf', [LaporanHasilProduksiController::class, 'exportPdf'])
        ->name('laporan_hasil_produksi.exportPdf');
        Route::get('create', [LaporanHasilProduksiController::class, 'create'])->name('laporan_hasil_produksi.create');
        Route::post('store', [LaporanHasilProduksiController::class, 'store'])->name('laporan_hasil_produksi.store');
        Route::get('edit/{id}', [LaporanHasilProduksiController::class, 'edit'])->name('laporan_hasil_produksi.edit');
        Route::patch('update/{id}', [LaporanHasilProduksiController::class, 'update'])->name('laporan_hasil_produksi.update');
        Route::post('destroy', [LaporanHasilProduksiController::class, 'destroy'])->name('laporan_hasil_produksi.destroy');
    });

    Route::group(['prefix' => 'kelola_permasalahan'], function () {
        Route::get('/', [KelolaPermasalahanController::class, 'index'])->name('kelola_permasalahan');
        Route::get('create', [KelolaPermasalahanController::class, 'create'])->name('kelola_permasalahan.create');
        Route::post('store', [KelolaPermasalahanController::class, 'store'])->name('kelola_permasalahan.store');
        Route::get('edit/{id}', [KelolaPermasalahanController::class, 'edit'])->name('kelola_permasalahan.edit');
        Route::patch('update/{id}', [KelolaPermasalahanController::class, 'update'])->name('kelola_permasalahan.update');
        Route::post('destroy', [KelolaPermasalahanController::class, 'destroy'])->name('kelola_permasalahan.destroy');
    });

    Route::group(['prefix' => 'data_hasil_qc'], function () {
        Route::get('/', [DataHasilQcController::class, 'index'])->name('data_hasil_qc');
        Route::get('create', [DataHasilQcController::class, 'create'])->name('data_hasil_qc.create');
        Route::post('store', [DataHasilQcController::class, 'store'])->name('data_hasil_qc.store');
        Route::get('edit/{id}', [DataHasilQcController::class, 'edit'])->name('data_hasil_qc.edit');
        Route::patch('update/{id}', [DataHasilQcController::class, 'update'])->name('data_hasil_qc.update');
        Route::post('destroy', [DataHasilQcController::class, 'destroy'])->name('data_hasil_qc.destroy');
    });

    Route::group(['prefix' => 'data_hasil_produksi'], function () {
        Route::get('/', [DataHasilProduksiController::class, 'index'])->name('data_hasil_produksi');
        Route::get('create', [DataHasilProduksiController::class, 'create'])->name('data_hasil_produksi.create');
        Route::post('store', [DataHasilProduksiController::class, 'store'])->name('data_hasil_produksi.store');
        Route::get('edit/{id}', [DataHasilProduksiController::class, 'edit'])->name('data_hasil_produksi.edit');
        Route::patch('update/{id}', [DataHasilProduksiController::class, 'update'])->name('data_hasil_produksi.update');
        Route::post('destroy', [DataHasilProduksiController::class, 'destroy'])->name('data_hasil_produksi.destroy');
    });

    
    Route::get('/settings', [UserManagementController::class, 'index'])->name('settings');
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('user');
            Route::get('create', [UserManagementController::class, 'create'])->name('user.create');
            Route::post('store', [UserManagementController::class, 'store'])->name('user.store');
            Route::get('edit/{id}', [UserManagementController::class, 'edit'])->name('user.edit');
            Route::patch('update/{id}', [UserManagementController::class, 'update'])->name('user.update');
            Route::post('destroy', [UserManagementController::class, 'destroy'])->name('user.destroy');
        });
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::get('load-data', [RoleController::class, 'loadData'])->name('role.load_data');
            Route::get('create', [RoleController::class, 'create'])->name('role.create');
            Route::post('store', [RoleController::class, 'store'])->name('role.store');
            Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::get('show/{id}/{user_id}', [RoleController::class, 'show'])->name('role.show');
            Route::post('update', [RoleController::class, 'update'])->name('role.update');
            Route::post('destroy', [RoleController::class, 'destroy'])->name('role.destroy');
        });
        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission');
            Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
            Route::post('store', [PermissionController::class, 'store'])->name('permission.store');
            Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('permission.show');
            Route::patch('update/{id}', [PermissionController::class, 'update'])->name('permission.update');
            Route::post('destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
        });
    });
});
