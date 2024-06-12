<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\KRSDetailController;
use App\Http\Controllers\MahasiswaController;

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

Route::get('/', [CrudController::class, 'index'])->name('index')->middleware('guest');
Route::get('/search-results', [CrudController::class, 'search'])->name('search.results');
// Route::post('/semualistdata',[CrudController::class,'semualistData'])->name('semuakrs.listData');
// Route::post('/cekIPK',[CrudController::class,'cekIPK'])->name('semuakrs.cekIPK');
Route::get('/cekIPK', [CrudController::class, 'cekIPK'])->name('semuakrs.cekIPK');
Route::get('/mahasiswa/ipk', [MahasiswaController::class, 'hitungKeseluruhanIPK'])->name('hitungKeseluruhanIPK');

Route::get('/login', [LogInController::class, 'index'])->name('user-login')->middleware('guest');
Route::post('/authlogin', [LogInController::class, 'authenticate'])->name('user-auth-login');
Route::get('/signup', [SignUpController::class, 'index'])->name('user-signup')->middleware('guest');
Route::post('/savesignup', [SignUpController::class, 'savesignup'])->name('user-simpan-tamu')->middleware('guest');
Route::get('/logout', [LogInController::class, 'logout'])->name('user-logout')->middleware('auth');

Route::group(['middleware' => ['admin', 'auth']], function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/krs', [KRSController::class, 'index'])->name('krs.list');
        Route::post('/krs/listdata', [KRSController::class, 'listData'])->name('krs.listData');

        Route::get('/{id}/krsdetail/{nim}', [KRSDetailController::class, 'krsdetail'])->name('krsdetail.list');
        Route::post('/{id}/krsdetail/listdata', [KRSDetailController::class, 'listData'])->name('krsdetail.listData');
        Route::get('/{id}/create/krsdetail', [KRSDetailController::class, 'create'])->name('krsdetail.create');
        Route::delete('/krsdetail/{id}', [KRSDetailController::class, 'deleteData'])->name('krsdetail.delete');
        Route::post('/krsdetail/save', [KRSDetailController::class, 'save'])->name('krsdetail.save');
    });
});
