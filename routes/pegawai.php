<?php

// use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\TpdController;
// use App\Http\Controllers\PegawaiController;
// use App\Http\Controllers\UserManagement\UserManagementController;

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

// Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
//     Route::group(['prefix' => 'pegawai', 'as' => 'pegawai.'], function() {

//         Route::match(['get', 'post'],'/', [PegawaiController::class, 'index'])->name('index'); //---untuk menu hkk kepegawaian
//         Route::match(['get', 'post'],'/kerjasama', [PegawaiController::class, 'kerjasama_dashboard'])->name('kerjasama.index'); //--- untuk menu hkk kerjasama

//         Route::match(['get', 'post'], '/create', [PegawaiController::class, 'create'])->name('create');
//         Route::post('/getData', [PegawaiController::class, 'getDataStruktural'])->name('getDataStruktural');
//         Route::post('/get_atasan', [PegawaiController::class, 'getAtasan'])->name('getAtasan');
//         Route::post('/getKota', [PegawaiController::class, 'getDataKabKot'])->name('getKota');

//         Route::get('/image/{filename}', [PegawaiController::class, 'ShowImage'])->name('image.displayImage');
//         Route::get('/file/{filename}', [PegawaiController::class, 'GetFile'])->name('file.getFile');

//         Route::match(['get', 'post'], 'action/{aksi}/{id}', [PegawaiController::class, 'create'])
//         ->where(['aksi'=>'edit', 'id'=>'[0-9]+'])
//         ->name('edit');
//         Route::post('/delete', [PegawaiController::class, 'delete'])->name('destroy');
//         Route::get('/rekap', [PegawaiController::class,'rekap'])->name('rekap');

//         Route::match(['get', 'post'],'/kerjasama/form', [PegawaiController::class, 'kerjasama'])->name('kerjasama.form');
//         Route::match(['get', 'post'], '/kerjasama/action/{aksi}/{id}', [PegawaiController::class, 'kerjasama'])
//         ->where(['aksi'=>'edit', 'id'=>'[0-9]+'])
//         ->name('kerjasama.edit');
//         Route::post('/kerjasama/delete', [PegawaiController::class, 'DeleteKerjasama'])->name('kerjasama.destroy');

//         Route::post('/data_pegawai', [PegawaiController::class, 'json_data_pegawai'])->name('api.data_pegawai');

//     });

//     Route::group(['prefix' => 'tpd_dkpp', 'as' => 'tpd_dkpp.'], function() {
//         // --------------- START Tolong Tambah Route Ini pada Menu TPD -------------------------//
//             Route::match(['get', 'post'],'/', [TpdController::class, 'index'])->name('index'); //--menu pertama tpd
//             Route::match(['get'],'/rekap', [TpdController::class, 'rekap'])->name('rekap'); // -- menu rekap tpd
//         // --------------- START Tolong Tambah Route Ini pada Menu TPD -------------------------//

//         Route::match(['get', 'post'],'/form', [TpdController::class, 'form'])->name('form');
//         Route::match(['get', 'post'], '/form/action/{aksi}/{id}', [TpdController::class, 'form'])
//         ->where(['aksi'=>'edit', 'id'=>'[0-9]+'])
//         ->name('form.edit');

//         Route::post('/delete', [TpdController::class, 'delete'])->name('destroy');

//         Route::get('/lihat_foto/{filename}', [TpdController::class, 'ShowImage'])->name('image.displayImage');

//     });

// });


