<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\KategoriStyleController;
use App\Http\Controllers\Admin\MisiController;
use App\Http\Controllers\Admin\OrmawaController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StrukturController as AdminStrukturController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// ========================
// PUBLIC ROUTES (dilindungi site.locked middleware)
// ========================
Route::middleware('site.locked')->group(function () {
    Route::get('/', [PublicController::class, 'beranda'])->name('beranda');
    Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
    Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('kegiatan');
    Route::get('/kegiatan/{slug}', [PublicController::class, 'kegiatanDetail'])->name('kegiatan.show');
    Route::get('/struktur', [PublicController::class, 'struktur'])->name('struktur');
    Route::get('/ormawa', [PublicController::class, 'ormawa'])->name('ormawa');
    Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
});

// Sitemap & robots selalu bisa diakses (tidak terkena lock)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// ========================
// ADMIN ROUTES (HIDDEN URL)
// ========================
Route::prefix('bem-admin')->name('admin.')->group(function () {

    // Auth (tidak perlu login)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected routes (perlu login - semua role)
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Kegiatan CRUD
        Route::delete('/kegiatan/{kegiatan}/foto', [AdminKegiatanController::class, 'hapusFoto'])->name('kegiatan.hapus-foto');
        Route::resource('/kegiatan', AdminKegiatanController::class)->except(['show']);

        // Struktur CRUD
        Route::delete('/struktur/{struktur}/foto', [AdminStrukturController::class, 'hapusFoto'])->name('struktur.hapus-foto');
        Route::resource('/struktur', AdminStrukturController::class)->except(['show']);

        // Profil BEM
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::post('/profil', [ProfilController::class, 'update'])->name('profil.update');
        Route::delete('/profil/foto/{key}', [ProfilController::class, 'hapusFoto'])->name('profil.hapus-foto');

        // Misi Dinamis
        Route::post('/misi', [MisiController::class, 'store'])->name('misi.store');
        Route::delete('/misi/{bemMisi}', [MisiController::class, 'destroy'])->name('misi.destroy');
        Route::post('/misi/reorder', [MisiController::class, 'reorder'])->name('misi.reorder');

        // Ormawa / HIMA
        Route::get('/ormawa', [OrmawaController::class, 'index'])->name('ormawa.index');
        Route::get('/ormawa/create', [OrmawaController::class, 'create'])->name('ormawa.create');
        Route::post('/ormawa', [OrmawaController::class, 'store'])->name('ormawa.store');
        Route::delete('/ormawa/{ormawa}', [OrmawaController::class, 'destroy'])->name('ormawa.destroy');

        // Ganti Password (semua role)
        Route::get('/account/password', [AccountController::class, 'changePassword'])->name('account.change-password');
        Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.update-password');

        // Gaya Kategori (semua admin)
        Route::get('/kategori-style', [KategoriStyleController::class, 'index'])->name('kategori-style.index');
        Route::post('/kategori-style', [KategoriStyleController::class, 'update'])->name('kategori-style.update');

        // Super Admin only routes
        Route::middleware('superadmin')->group(function () {
            // Kelola akun admin
            Route::get('/users/{user}/password', [UserController::class, 'showPassword'])->name('users.password');
            Route::resource('/users', UserController::class)->except(['show']);

            // Pengaturan website (lock/unlock)
            Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
            Route::post('/site-settings/lock', [SiteSettingController::class, 'lock'])->name('site-settings.lock');
            Route::post('/site-settings/unlock', [SiteSettingController::class, 'unlock'])->name('site-settings.unlock');
        });
    });
});
