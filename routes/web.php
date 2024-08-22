<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller\LoginController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\SPGRController;
use App\Http\Controllers\Admin\SuratHibahController;
use App\Http\Controllers\Admin\SKPTController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VerifikasiPenggunaController;
use App\Http\Controllers\Kasipem\KasipemHomeController;
use App\Http\Controllers\Kasipem\KasipemSPGRController;
use App\Http\Controllers\Kasipem\KasipemSuratHibahController;
use App\Http\Controllers\Kasipem\KasipemSKPTController;
use App\Http\Controllers\Kasipem\KasipemPengajuanController;
use App\Http\Controllers\User\PengajuanControllerUser;
use App\Http\Controllers\User\CariController;
use Illuminate\Routing\Route as RoutingRoute;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // ROUTE UNTUK HALAMAN ADMIN
    Route::prefix('admin')->middleware(['role:Admin'])->group(function () {
        Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');
        Route::resource('spgr', SPGRController::class);
        Route::resource('surathibah', SuratHibahController::class);
        Route::resource('skpt', SKPTController::class);
        Route::resource('pengajuan', PengajuanController::class);
        Route::put('/pengajuan/updateStatus/{id}', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
        Route::post('pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
        Route::post('pengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
        Route::get('pengajuan/{id}/print', [PengajuanController::class, 'print'])->name('pengajuan.print');
        Route::get('/laporan', [LaporanController::class, 'showReportPage'])->name('laporan');
        Route::get('/laporan/cetak/spgr', [LaporanController::class, 'generateReportSPGR'])->name('laporan.cetak.spgr');
        Route::get('/laporan/cetak/surathibah', [LaporanController::class, 'generateReportSuratHibah'])->name('laporan.cetak.surathibah');
        Route::get('/laporan/cetak/skpt', [LaporanController::class, 'generateReportSKPT'])->name('laporan.cetak.skpt');
        Route::resource('/pengguna', UserController::class);
        Route::post('/pengguna/{id}/approve', [UserController::class, 'approve'])->name('pengguna.approve');
    });

    // ROUTE UNTUK HALAMAN KASIPEM
    Route::prefix('kasipem')->middleware(['role:Kasipem'])->group(function () {
        Route::get('/home', [KasipemHomeController::class, 'index'])->name('kasipem.home');
        Route::resource('kasipemspgr', KasipemSPGRController::class);
        Route::resource('kasipemsurathibah', KasipemSuratHibahController::class);
        Route::resource('kasipemskpt', KasipemSKPTController::class);
        Route::get('pengajuankasipem', [KasipemPengajuanController::class, 'index'])->name('kasipem.pengajuan.index');
        Route::post('pengajuan/{id}/approve', [KasipemPengajuanController::class, 'approve'])->name('kasipem.pengajuan.approve');
        Route::post('pengajuan/{id}/reject', [KasipemPengajuanController::class, 'reject'])->name('kasipem.pengajuan.reject');
    });
    // ROUTE UNTUK HALAMAN USER
    Route::group(['middleware' => ['auth', 'is_approved']], function () {
        Route::get('/home', function () {
            return view('user.home');
        })->name('user.home');
        Route::get('/tentang', function () {
            return view('user.tentang');
        })->name('tentang');
        Route::get('/faq', function () {
            return view('user.faq');
        })->name('faq');
        Route::get('/kontak', function () {
            return view('user.kontak');
        })->name('kontak');
        Route::resource('/pengajuanuser', PengajuanControllerUser::class);
        Route::get('/riwayat-pengajuan', [PengajuanControllerUser::class, 'riwayat'])->name('riwayat.pengajuan');
        Route::get('/user/print/{id}', [PengajuanControllerUser::class, 'printResi'])->name('user.print.resi');
    });
});
