<?php

use App\Http\Controllers\Admins\Dashboard;
use App\Http\Controllers\Admins\Login;
use App\Http\Controllers\Admins\TablePengguna;
use App\Http\Controllers\Admins\TablePesanan;
use App\Http\Controllers\Admins\TableProduk;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PakaianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChekoutController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RatingsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->middleware('verified');


// untuk user register dan login
Route::group(['middleware' => 'guest'], function () {
    //group ini menjelaskan user belum login dan mimddleware manganggap nya sebagai tamu/guest
    Route::get('/login', [LoginUserController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/store/register', [RegisterController::class, 'store'])->name('store-register');
    Route::post('/stotre/login', [LoginUserController::class, 'login'])->name('authenticate');
});
Route::group(['middleware' => 'auth'], function () {
    //user sudah melakukan login dan sistem menganggap sebagai user yang sudah login
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user-dashboard');
    Route::get('/logout', [LoginUserController::class, 'logout'])->name('logout');

});

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');


//sama saja namun hanya untuk admin
Route::group(['middleware' => 'admin.guests'], function () {
    Route::get('/login-admin', [Login::class, 'index'])->name('login-admin');
    Route::post('/admin/login', [Login::class, 'login'])->name('admin.authenticate');
});
Route::group(['middleware' => 'admin.auth'], function () {
    Route::get('/dashboard-admin', [Dashboard::class, 'index'])->name('admin-dashboard');
    Route::get('/logout-admin', [Login::class, 'logout'])->name('admin-logout');
    
    Route::get('create/pakaian', [PakaianController::class, 'create'])->name('create-pakaian');
    Route::get('edit/pakaian/{id}', [PakaianController::class, 'edit'])->name('edit-pakaian');
    Route::post('store/pakaian', [PakaianController::class, 'save'])->name('store-pakaian');
    Route::put('store/pakaian/{id}', [PakaianController::class, 'savechanges'])->name('update-pakaian');
    Route::get('delete/pakaian/{id}', [PakaianController::class, 'delete'])->name('delete-pakaian');
    
    Route::get('table/pesanan', [TablePesanan::class, 'index'])->name('table-pesanan');
    Route::get('table/pengguna', [TablePengguna::class, 'index'])->name('table-pengguna');
    Route::get('table/produk', [TableProduk::class, 'index'])->name('table-produk');

    Route::get('detail/pesanan/{id}', [TablePesanan::class, 'detailpesanan'])->name('detail-pesanan');
    Route::put('detail/update/status{id}', [TablePesanan::class, 'updateStatus'])->name('update-status');
});

Route::get('/cart/pakaian', [CartController::class, 'index'])->name('cart');
Route::post('/cart/save', [CartController::class, 'cartsave'])->name('cart-save');
Route::get('/cart/delete/{id}', [CartController::class, 'carddelete'])->name('cart-delete');

Route::get('/chekout', [ChekoutController::class, 'index'])->name('chekout');
Route::get('/chekout/cancel', [ChekoutController::class, 'cancelchekout'])->name('chekout.cancel');
Route::post('/chekout/proses', [ChekoutController::class, 'processCheckout'])->name('chekout.proses');

Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat');
Route::post('/alamat/save', [AlamatController::class, 'procesalamat'])->name('alamat.save');
Route::get('/edit/alamat/{id}', [AlamatController::class, 'editalamat'])->name('edit.alamat');
Route::get('/delet/alamat/{id}', [AlamatController::class, 'deleteAlamat'])->name('delete.alamat');
Route::put('/edit/alamat/save/{id}', [AlamatController::class, 'editAlamatSave'])->name('edit.alamat-save');

Route::get('/pesanan', [PesananController::class, 'unpaid'])->name('pesanan');
Route::get('/pesanan/paid', [PesananController::class, 'paid'])->name('pesanan.paid');
Route::get('/pesanan/delivered', [PesananController::class, 'delivered'])->name('pesanan.delivered');
Route::get('/pesanan/finished', [PesananController::class, 'finished'])->name('pesanan.finished');

Route::post('/chekout/payment', [OrderController::class, 'chekoutPayment'])->name('chekout.payment');


Route::get('/detail/produk/{id}', [DetailProdukController::class, 'index'])->name('detail-produk');

//Route untuk ratings
Route::post('/ratings/tambah', [RatingsController::class, 'ratings'])->name('tambah.ratings');







//mengambil data daerah indonesia lewat api
//data provinsi
Route::get('/api/provinsi', function() {
    $provinsi = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    return response()->json($provinsi->json());
});

//data kab/kota
Route::get('/api/kabkot/{id}', function($province_id) {
    $kabupaten = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'.$province_id.'.json');
    return response()->json($kabupaten->json());
});

Route::get('/api/kecamatan/{id}', function($kabkot_id) {
    $kecamatan = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/'.$kabkot_id.'.json');
    return response()->json($kecamatan->json());
});

Route::get("/api/kelurahan/{id}", function($kecamatan_id) {
    $kelurahan = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/'.$kecamatan_id.'.json');
    return response()->json($kelurahan->json());
});
