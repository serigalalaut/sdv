<?php

use Illuminate\Support\Facades\Route;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\KeuanganController;

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

$controller_path = 'App\Http\Controllers';
//Route::group(['middleware' => ['guest']], function() use($controller_path){
    // authentication
    Route::get('/auth/login', $controller_path . '\authentications\LoginBasic@index')->name('form-login');
    Route::get('/payment-confirmation', $controller_path . '\uploads\Uploads@index')->name('form-uploads');
    Route::post('/uploads', $controller_path . '\uploads\Uploads@uploadImage')->name('uploads');
    //Route::get('/auth/register', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
    //Route::post('/register', $controller_path . '\authentications\RegisterBasic@register')->name('register');
    Route::post('/login', $controller_path . '\authentications\LoginBasic@login')->name('login');
    Route::get('/auth/logout', $controller_path . '\authentications\LoginBasic@logout')->name('logout');
    //Route::get('/auth/forgot-password', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');
//});

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');
Route::group(['middleware' => ['auth']], function() use($controller_path) {
    // Main Page Route
    Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('home');

    Route::get('/ipl', $controller_path . '\ipl\Ipl@index')->name('ipl');
    Route::get('/ipl/confirm/{id}', $controller_path . '\ipl\Ipl@details')->name('ipl-details');
    Route::get('/ipl/lunas/{id}', $controller_path . '\ipl\Ipl@updateStatus')->name('ipl-lunas');

    Route::get('/kas-warga', $controller_path . '\keuangan\keuangan@KasWarga')->name('kas-warga');
    Route::get('/kas-warga/add', $controller_path . '\keuangan\keuangan@KasWargaAdd')->name('kas-warga-add');
    Route::post('/kas-warga/add', $controller_path . '\keuangan\keuangan@KasWargaAddPost')->name('kas-warga-add-post');
    Route::get('/laporan-pengeluaran', $controller_path . '\keuangan\keuangan@Pengeluaran')->name('pengeluaran');
    Route::get('/laporan-pengeluaran/details/{id}', $controller_path . '\keuangan\keuangan@PengeluaranDetails')->name('pengeluaran-details');
    Route::get('/laporan-pengeluaran/add', $controller_path . '\keuangan\keuangan@PengeluaranAdd')->name('pengeluaran-add');
    Route::post('/laporan-pengeluaran/add', $controller_path . '\keuangan\keuangan@PengeluaranAddPost')->name('pengeluaran-add-post');
    Route::get('/laporan-pemasukan', $controller_path . '\keuangan\keuangan@Pemasukan')->name('pemasukan');
    Route::get('/laporan-pemasukan/add', $controller_path . '\keuangan\keuangan@PemasukanAdd')->name('pemasukan-add');
    Route::post('/laporan-pemasukan/add', $controller_path . '\keuangan\keuangan@PemasukanAddPost')->name('pemasukan-add-post');
    Route::get('/laporan-pemasukan/details/{id}', $controller_path . '\keuangan\keuangan@PemasukanDetails')->name('pemasukan-details');
    Route::get('/laporan-keuangan', $controller_path . '\keuangan\keuangan@Laporan')->name('laporan');
    // User
    Route::get('/user', $controller_path . '\user\User@index')->name('user');
    Route::get('/user/delete/{id}', $controller_path . '\user\User@deleteUser')->name('user-delete');
    Route::get('/form-user', $controller_path . '\user\User@formAddUser')->name('add-user');
    Route::post('/add-user', $controller_path . '\user\User@addUser')->name('add-user');
    Route::post('/update-user', $controller_path . '\user\User@UpdateUser')->name('update-user');
    Route::get('/user/edit/{id}', $controller_path . '\user\User@formEditUser')->name('edit-user');

    // slider
    Route::get('/slider', $controller_path . '\slider\Slider@index')->name('slider');
    Route::get('/slider/form-slider', $controller_path . '\slider\Slider@formAddSlider')->name('add-slider');
    Route::get('/slider/edit/{id}', $controller_path . '\slider\Slider@formEditSlider')->name('edit-slider');
    Route::post('/slider/add-slider', $controller_path . '\slider\Slider@addSlider')->name('add-slider');
    Route::post('/slider/update-slider', $controller_path . '\slider\Slider@editSlider')->name('update-slider');
    Route::get('/slider/delete/{id}', $controller_path . '\slider\Slider@deleteSlider')->name('slider-delete');

    Route::get('/keuangan/laporan-kas-warga', $controller_path . '\keuangan\keuangan@laporanKasWarga')->name('keuangan.laporanKasWarga');

    Route::get('/warga', $controller_path . '\warga\warga@index')->name('warga');
    Route::get('/warga/details/{id}', $controller_path . '\warga\warga@details')->name('warga-details');
    Route::get('/warga/edit/{id}', $controller_path . '\warga\warga@edit')->name('warga-edit');
    Route::post('/warga/update', $controller_path . '\warga\warga@update')->name('warga-update');

});