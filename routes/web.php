<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersProfileController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipeKendController;
use App\Http\Controllers\ItemOprController;
use App\Http\Controllers\KostumerController;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\UnitKendController;
use App\Http\Controllers\PengajuanDanaController;
use App\Http\Controllers\PenjadwalanController;;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\HargaTujuanController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\EtiketController;


use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\RouteGroup;

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

//Route::get('/about', [HomeController::class, 'about']);


/*Route::view('/about', 'v_about', [
    'Nama' => 'Admin Office',
    'Sistem' => 'Booking Bus'
]);

Route::get('/admin/{nama_admin?}', function ($nama_admin = 'EWOK') {
    return view('admin.v_index', ['nama_admin' => $nama_admin]);
});*/

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about']);


Route::group(['middleware' => 'auth'], function () {
    //USERS
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/add', [UserController::class, 'add']);
    Route::post('/users/insert', [UserController::class, 'insert']);
    Route::get('/users/detail/{id}', [UserController::class, 'detail']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('/users/update/{id}', [UserController::class, 'update']);
    Route::get('/users/delete/{id}', [UserController::class, 'delete']);
    Route::post('/users/changePassword/{id}',[UserController::class, 'changePassword']);
    //USERS PROFILE
    Route::get('/users_profile', [UsersProfileController::class, 'index'])->name('users_profile');
    Route::get('/users_profile/add', [UsersProfileController::class, 'add']);
    Route::post('/users_profile/insert', [UsersProfileController::class, 'insert']);
    Route::get('/users_profile/detail/{id}', [UsersProfileController::class, 'detail']);
    Route::get('/users_profile/edit/{id}', [UsersProfileController::class, 'edit']);
    Route::post('/users_profile/update/{id}', [UsersProfileController::class, 'update']);
    Route::get('/users_profile/delete/{id}', [UsersProfileController::class, 'delete']);
    //LEVEL AKSES
    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::get('/role/add', [RoleController::class, 'add']);
    Route::post('/role/insert', [RoleController::class, 'insert']);
    Route::get('/role/edit/{id}', [RoleController::class, 'edit']);
    Route::post('/role/update/{id}', [RoleController::class, 'update']);
    Route::get('/role/delete/{id}', [RoleController::class, 'delete']);
    Route::get('/role/akses/{id}', [RoleController::class, 'akses']);
    Route::post('/role/permission/{id}', [RoleController::class, 'permission']);
    //KOSTUMER
    Route::get('/kostumer', [KostumerController::class, 'index'])->name('kostumer');
    Route::get('/kostumer/add', [KostumerController::class, 'add']);
    Route::post('/kostumer/insert', [KostumerController::class, 'insert']);
    Route::post('/kostumer/insertOther', [KostumerController::class, 'insertOther']);
    Route::get('/kostumer/detail/{id}', [KostumerController::class, 'detail']);
    Route::get('/kostumer/edit/{id}', [KostumerController::class, 'edit']);
    Route::post('/kostumer/update/{id}', [KostumerController::class, 'update']);
    Route::get('/kostumer/delete/{id}', [KostumerController::class, 'delete']);
    //KARYAWAN
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
    Route::get('/karyawan/add', [KaryawanController::class, 'add']);
    Route::post('/karyawan/insert', [KaryawanController::class, 'insert']);
    Route::get('/karyawan/detail/{id}', [KaryawanController::class, 'detail']);
    Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/update/{id}', [KaryawanController::class, 'update']);
    Route::get('/karyawan/delete/{id}', [KaryawanController::class, 'delete']);
    Route::get('/karyawan/addSupir', [KaryawanController::class, 'addSupir']);
    Route::post('/karyawan/insertSupir', [KaryawanController::class, 'insertSupir']);
    //MITRA
    Route::get('/mitra', [MitraController::class, 'index'])->name('mitra');
    Route::get('/mitra/add', [MitraController::class, 'add']);
    Route::post('/mitra/insert', [MitraController::class, 'insert']);
    Route::post('/mitra/insertOther', [MitraController::class, 'insertOther']);
    Route::get('/mitra/detail/{id}', [MitraController::class, 'detail']);
    Route::get('/mitra/edit/{id}', [MitraController::class, 'edit']);
    Route::post('/mitra/update/{id}', [MitraController::class, 'update']);
    Route::get('/mitra/delete/{id}', [MitraController::class, 'delete']);
    //CREW POOL
    Route::get('/crew', [CrewController::class, 'index'])->name('crew');
    Route::get('/crew/add', [CrewController::class, 'add']);
    Route::post('/crew/insert', [CrewController::class, 'insert']);
    Route::get('/crew/edit/{id}', [CrewController::class, 'edit']);
    Route::post('/crew/update/{id}', [CrewController::class, 'update']);
    Route::get('/crew/delete/{id}', [CrewController::class, 'delete']);
    //TUJUAN
    Route::get('/tujuan', [TujuanController::class, 'index'])->name('tujuan');
    Route::get('/tujuan/add', [TujuanController::class, 'add']);
    Route::post('/tujuan/insert', [TujuanController::class, 'insert']);
    Route::get('/tujuan/edit/{id}', [TujuanController::class, 'edit']);
    Route::post('/tujuan/update/{id}', [TujuanController::class, 'update']);
    Route::get('/tujuan/delete/{id}', [TujuanController::class, 'delete']);
    //HARGA TUJUAN
    Route::get('/harga_tujuan', [HargaTujuanController::class, 'index'])->name('harga_tujuan');
    Route::get('/harga_tujuan/add', [HargaTujuanController::class, 'add']);
    Route::post('/harga_tujuan/insert', [HargaTujuanController::class, 'insert']);
    Route::get('/harga_tujuan/edit/{id}', [HargaTujuanController::class, 'edit']);
    Route::post('/harga_tujuan/update/{id}', [HargaTujuanController::class, 'update']);
    Route::get('/harga_tujuan/delete/{id}', [HargaTujuanController::class, 'delete']);
    Route::get('/harga_tujuan/report', [HargaTujuanController::class, 'report']);
    //TIPE KENDARAAN
    Route::get('/tipe_kend', [TipeKendController::class, 'index'])->name('tipe_kendaraan');
    Route::get('/tipe_kend/add', [TipeKendController::class, 'add']);
    Route::post('/tipe_kend/insert', [TipeKendController::class, 'insert']);
    Route::get('/tipe_kend/edit/{id}', [TipeKendController::class, 'edit']);
    Route::post('/tipe_kend/update/{id}', [TipeKendController::class, 'update']);
    Route::get('/tipe_kend/delete/{id}', [TipeKendController::class, 'delete']);
    //UNIT KENDARAAN
    Route::get('/unit_kend', [UnitKendController::class, 'index'])->name('unit_kendaraan');
    Route::get('/unit_kend/add', [UnitKendController::class, 'add']);
    Route::post('/unit_kend/insert', [UnitKendController::class, 'insert']);
    Route::get('/unit_kend/edit/{id}', [UnitKendController::class, 'edit']);
    Route::post('/unit_kend/update/{id}', [UnitKendController::class, 'update']);
    Route::get('/unit_kend/delete/{id}', [UnitKendController::class, 'delete']);
    Route::get('/unit_kend/report', [UnitKendController::class, 'report']);
    //ITEM OPERASIONAL
    Route::get('/item_opr', [ItemOprController::class, 'index'])->name('item_operasional');
    Route::get('/item_opr/add', [ItemOprController::class, 'add']);
    Route::post('/item_opr/insert', [ItemOprController::class, 'insert']);
    Route::get('/item_opr/edit/{id}', [ItemOprController::class, 'edit']);
    Route::post('/item_opr/update/{id}', [ItemOprController::class, 'update']);
    Route::get('/item_opr/delete/{id}', [ItemOprController::class, 'delete']);
    //OPERASIONAL
    Route::get('/operasional', [OperasionalController::class, 'index'])->name('operasional');
    Route::get('/operasional/add', [OperasionalController::class, 'add']);
    Route::post('/operasional/insert', [OperasionalController::class, 'insert']);
    Route::get('/operasional/edit/{id}', [OperasionalController::class, 'edit']);
    Route::post('/operasional/update/{id}', [OperasionalController::class, 'update']);
    Route::get('/operasional/delete/{id}', [OperasionalController::class, 'delete']);
    Route::get('/operasional/report', [OperasionalController::class, 'report']);
    Route::post('/operasional/reportByTanggal', [OperasionalController::class, 'reportByTanggal']);
    //PENGAJUAN DANA
    Route::get('/pengajuan_dana', [PengajuanDanaController::class, 'index'])->name('pengajuan_dana');
    Route::get('/pengajuan_dana/add', [PengajuanDanaController::class, 'add']);
    Route::post('/pengajuan_dana/insert', [PengajuanDanaController::class, 'insert']);
    Route::get('/pengajuan_dana/edit/{id}', [PengajuanDanaController::class, 'edit']);
    Route::post('/pengajuan_dana/update/{id}', [PengajuanDanaController::class, 'update']);
    Route::get('/pengajuan_dana/delete/{id}', [PengajuanDanaController::class, 'delete']);
    Route::get('/pengajuan_dana/report', [PengajuanDanaController::class, 'report']);
    Route::post('/pengajuan_dana/reportByTanggal', [PengajuanDanaController::class, 'reportByTanggal']);
    Route::get('/pengajuan_dana/suratPengajuan/{id}', [PengajuanDanaController::class, 'suratPengajuan']);
    Route::get('/pengajuan_dana/suratPengajuan_print/{id}', [PengajuanDanaController::class, 'suratPengajuan_print']);

    //PENJADWALAN
    Route::get('/penjadwalan', [PenjadwalanController::class, 'index'])->name('penjadwalan');
    Route::get('/penjadwalan/add', [PenjadwalanController::class, 'add']);
    Route::post('/penjadwalan/insert', [PenjadwalanController::class, 'insert']);
    Route::get('/penjadwalan/edit/{id}', [PenjadwalanController::class, 'edit']);
    Route::post('/penjadwalan/update/{id}', [PenjadwalanController::class, 'update']);
    Route::get('/penjadwalan/delete/{id}', [PenjadwalanController::class, 'delete']);
    Route::get('/penjadwalan/selesai/{id}', [PenjadwalanController::class, 'selesai']);
    Route::get('/penjadwalan/prosesUnitJalan/{id}', [PenjadwalanController::class, 'prosesUnitJalan']);
    Route::get('/penjadwalan/report', [PenjadwalanController::class, 'report']);
    Route::get('/penjadwalan/report#service', [PenjadwalanController::class, 'report']);
    Route::post('/penjadwalan/reportByTanggal', [PenjadwalanController::class, 'reportByTanggal']);
    Route::get('/penjadwalan/suratJalan/{id}', [PenjadwalanController::class, 'suratJalan']);
    Route::get('/penjadwalan/suratJalan_print/{id}', [PenjadwalanController::class, 'suratJalan_print']);


    //BOOKING
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::get('/booking/add', [BookingController::class, 'add'])->name('addBooking');
    Route::post('/booking/insert', [BookingController::class, 'insert']);
    Route::get('/booking/edit/{id}', [BookingController::class, 'edit']);
    Route::post('/booking/update/{id}', [BookingController::class, 'update']);
    Route::get('/booking/delete/{id}', [BookingController::class, 'delete']);
    Route::get('/booking/invoice/{id}', [BookingController::class, 'invoice']);
    Route::get('/booking/invoice_print/{id}', [BookingController::class, 'invoice_print']);
    Route::get('/booking/payment/{id}', [BookingController::class, 'payment']);
    Route::get('/booking/report', [BookingController::class, 'report']);
    Route::post('/booking/reportByTanggal', [BookingController::class, 'reportByTanggal']);
    //Manual Booking
    Route::get('/booking/manual/add', [BookingController::class, 'add']);
    //Route::post('/booking/insert', [BookingController::class, 'insert']);
    Route::get('/booking/manual/edit/{id}', [BookingController::class, 'edit']);
    //Route::post('/booking/update/{id}', [BookingController::class, 'update']);

    //OTHER
    Route::get('/penjadwalan/GetTipeUnitKendaraan/{id}', [penjadwalanController::class, 'GetTipeUnitKend']);
    Route::get('/penjadwalan/GetSupirKend/{id}', [penjadwalanController::class, 'GetSupirKend']);
    Route::get('/penjadwalan/GetOtherSupir/{id}', [penjadwalanController::class, 'GetOtherSupir']);
    Route::get('/penjadwalan/GetHelper/{id}', [penjadwalanController::class, 'GetHelper']);
    Route::get('/penjadwalan/GetOtherHelper/{id}', [penjadwalanController::class, 'GetOtherHelper']);
    Route::get('/booking/GetHargaTujuan/{id}', [BookingController::class, 'GetHargaTujuan']);
    Route::get('/etiket/GetHargaTujuan/{id}', [EtiketController::class, 'GetHargaTujuan']);
    Route::get('/karyawan/GetTipeUnitKendaraan/{id}', [KaryawanController::class, 'GetTipeUnitKend']);
    //Route::get('/booking/edit/GetHargaTujuan/{id}', [BookingController::class, 'GetHargaTujuan']);

    //E-Ticket
    Route::get('/etiket', [EtiketController::class, 'index'])->name('etiket');
    Route::get('/etiket/add', [EtiketController::class, 'add']);
    Route::post('/etiket/insert', [EtiketController::class, 'insert']);
    Route::get('/etiket/edit/{id}', [EtiketController::class, 'edit']);
    Route::post('/etiket/update/{id}', [EtiketController::class, 'update']);
    Route::get('/etiket/delete/{id}', [EtiketController::class, 'delete']);
    Route::get('/etiket/ticket/{id}', [EtiketController::class, 'ticket'])->name('tiket');
    Route::get('/etiket/ticket_print/{id}', [EtiketController::class, 'ticket_print']);



});

Route::group(['middleware' => 'karyawan'], function () {
    Route::get('event', [FullCalendarController::class, 'index']);
    Route::post('eventAjax', [FullCalendarController::class, 'ajax']);
});

Route::group(['middleware' => 'pool'], function () {
    //Route::get('/about', [HomeController::class, 'about']);
    //Route::get('/calendar', [HomeController::class, 'calendar']);
});
