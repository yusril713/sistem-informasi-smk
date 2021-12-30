<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AssignPermission;
use App\Http\Controllers\Admin\AssignRole;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KategoriFileController;
use App\Http\Controllers\Admin\KategoriInformasiController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KepSekController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PpdbCOntroller;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\RegistrasiSiswaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\User\AccountController as UserAccountController;
use App\Http\Controllers\User\DirektoriController;
use App\Http\Controllers\User\FormulirPendaftaran;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PasswordController;
use App\Mail\ppdbMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home user');

Route::get('/cache', function() {
    if(Artisan::call('config:cache')) {
        echo 'cache cleared';
    }
});

Route::get('/restart-queue', function() {
    \Artisan::call('config:cache');
    \Artisan::call('queue:restart');
});

Route::get('/cleareverything', function () {

    $clearcache = \Artisan::call('cache:clear');
    echo $clearcache . 'asdasd';

    $clearview = \Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearroute = \Artisan::call('route:cache');
    echo "Route cleared<br>";

    $clearconfig = \Artisan::call('config:cache');
    echo "Config cleared<br>";

});
Route::group(['middleware' => ['auth', 'role:Super Admin|Admin|Guru|Osis|Siswa']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::put('manage-tahun-ajaran/{id}/aktivasi', [TahunAjaranController::class, 'activate'])->name('manage-tahun-ajaran.activate');
    Route::get('manage-siswa/all', [SiswaController::class, 'all'])->name('manage-siswa.all');
    Route::get('manage-guru/all', [GuruController::class, 'all'])->name('manage-guru.all');
    Route::get('registration-siswa/find', [RegistrasiSiswaController::class, 'find'])->name('registration-siswa.find');
    Route::get('registration-siswa/data-to-create', [RegistrasiSiswaController::class, 'DataToCreate'])->name('registration-siswa.data-create');
    Route::get('registration-siswa/{siswa}/{tahun_ajaran}/edit', [RegistrasiSiswaController::class, 'edit'])->name('registration-siswa.edit');
    Route::put('registration-siswa/{siswa}/{tahun_ajaran}/update', [RegistrasiSiswaController::class, 'update'])->name('registration-siswa.update');
    Route::put('manage-struktur-organisasi/{id}/activate', [StrukturOrganisasiController::class, 'activate'])->name('manage-struktur-organisasi.activate');
    Route::put('manage-pengumuman/{id}/activate', [PengumumanController::class, 'activate'])->name('manage-pengumuman.activate');

    Route::resource('manage-password', PasswordController::class)->only('index', 'update');
    Route::resource('manage-account', AccountController::class)->only(['index', 'update']);
    Route::resource('manage-sambutan', KepSekController::class)->except(['show']);
    Route::resource('manage-visimisi', VisiMisiController::class)->except(['show']);
    Route::resource('manage-tahun-ajaran', TahunAjaranController::class)->except(['show']);
    Route::resource('manage-jurusan', JurusanController::class)->except(['show']);
    Route::resource('manage-kelas', KelasController::class)->except(['show']);
    Route::resource('registration-siswa', RegistrasiSiswaController::class)->except(['show','edit', 'update', 'destroy']);
    Route::resource('manage-pengumuman', PengumumanController::class)->except(['show']);
    Route::resource('manage-struktur-organisasi', StrukturOrganisasiController::class)->except(['show']);
    Route::resource('manage-pengumuman', PengumumanController::class)->except(['show']);
    Route::resource('manage-profil', ProfilController::class)->except(['show']);
    Route::resources([
        'manage-siswa' => SiswaController::class,
        'manage-guru' => GuruController::class,
    ]);

    Route::resource('manage-kategori', KategoriInformasiController::class)->except(['show']);
    Route::get('manage-informasi/{slug}', [InformasiController::class, 'index'])->name('manage-informasi.index');
    Route::get('manage-informasi/{slug}/create', [InformasiController::class, 'create'])->name('manage-informasi.create');
    Route::get('manage-informasi/{slug}/edit/{id}', [InformasiController::class, 'edit'])->name('manage-informasi.edit');
    Route::get('manage-informasi/{slug}/show/{id}', [InformasiController::class, 'show'])->name('manage-informasi.show');
    Route::post('manage-informasi/{slug}/store', [InformasiController::class, 'store'])->name('manage-informasi.store');
    Route::put('manage-informasi/{slug}/update/{id}', [InformasiController::class, 'update'])->name('manage-informasi.update');
    Route::delete('manage-informasi/{slug}/destroy/{id}', [InformasiController::class, 'destroy'])->name('manage-informasi.destroy');

    Route::resource('manage-kategori-file', KategoriFileController::class)->except(['show']);
    Route::get('manage-file/{slug}', [FileController::class, 'index'])->name('manage-file.index');
    Route::get('manage-file/{slug}/create', [FileController::class, 'create'])->name('manage-file.create');
    Route::get('manage-file/{slug}/edit/{id}', [FileController::class, 'edit'])->name('manage-file.edit');
    Route::post('manage-file/{slug}/store', [FileController::class, 'store'])->name('manage-file.store');
    Route::put('manage-file/{slug}/update/{id}', [FileController::class, 'update'])->name('manage-file.update');
    Route::delete('manage-file/{slug}/destroy/{id}', [FileController::class, 'destroy'])->name('manage-file.destroy');

    Route::resource('manage-ppdb', PpdbCOntroller::class)->only('index');
    Route::get('manage-ppdb/find', [PpdbCOntroller::class, 'find'])->name('manage-ppdb.find');
    Route::get('manage-ppdb/marked-print', [PpdbCOntroller::class, 'MarkedPrint'])->name('manage-ppdb.marked-print');

    Route::resource('manage-galeri', GaleriController::class)->except(['show']);
    Route::resource('manage-kontak', KontakController::class)->except(['show']);
    Route::resource('account', UserAccountController::class)->only(['index', 'update']);

    Route::get('account/edit-photo', [UserAccountController::class, 'EditPhoto'])->name('account.edit-photo');
    Route::put('account/{id}/update-photo', [UserAccountController::class, 'UpdatePhoto'])->name('account.update-photo');
});

Route::group(['middleware' => ['auth', 'role:Super Admin']], function () {
    Route::resource('manage-role', RoleController::class)->except(['show']);
    Route::resource('manage-permission', PermissionController::class)->only(['index', 'store', 'destroy']);
    Route::resource('assign-role', AssignRole::class)->only(['index', 'store']);
    Route::resource('assign-permission', AssignPermission::class)->except(['show']);
});


Route::get('download', [HomeController::class, 'download'])->name('download');
Route::get('download/find', [HomeController::class, 'findDownload'])->name('download.find');

Route::get('/{kategori}/{slug}', [HomeController::class, 'detail'])->name('detail-informasi');

Route::get('profil', [HomeController::class, 'profil'])->name('profil');
Route::get('struktur-organisasi', [HomeController::class, 'struktur_organisasi'])->name('struktur-organisasi');
Route::get('photos', [HomeController::class, 'photos'])->name('photos.index');
Route::get('videos', [HomeController::class, 'videos'])->name('videos.index');


Route::get('direktori-guru', [DirektoriController::class, 'DirektoriGuru'])->name('direktori-guru');
Route::get('direktori-siswa', [DirektoriController::class, 'DirektoriSiswa'])->name('direktori-siswa');
Route::get('direktori-alumni', [DirektoriController::class, 'DirektoriAlumni'])->name('direktori-alumni');
Route::get('kontak', [HomeController::class, 'kontak'])->name('kontak.index');
Route::post('kontak/post', [HomeController::class, 'kontakPost'])->name('kontak.post');

Route::resource('formulir-pendaftaran', FormulirPendaftaran::class)->only('index', 'store');

Route::get('/{slug}', [HomeController::class, 'informasi'])->name('informasi');
