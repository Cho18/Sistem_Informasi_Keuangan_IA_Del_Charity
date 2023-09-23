<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AjuanBeasiswaController;
use App\Http\Controllers\AlbumDokumentasiController;
use App\Http\Controllers\BPHController;
use App\Http\Controllers\BuktiDonasiController;
use App\Http\Controllers\CatatanBeasiswaController;
use App\Http\Controllers\CatatanDonasiController;
use App\Http\Controllers\DaftarAjuanBeasiswaController;
use App\Http\Controllers\DaftarBuktiDonasiController;
use App\Http\Controllers\DaftarFileBeasiswaController;
use App\Http\Controllers\DaftarPeranAwardeeController;
use App\Http\Controllers\DaftarPeranBPHController;
use App\Http\Controllers\DaftarPeranDonator;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DokumenAwardeeController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FileBeasiswaController;
use App\Http\Controllers\InformasiBeasiswaController;
use App\Http\Controllers\InformasiDonasiController;
use App\Http\Controllers\JenisPemasukanController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\LaporanPemasukanController;
use App\Http\Controllers\LaporanPengeluaranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PemasukanKeuanganController;
use App\Http\Controllers\PenerimaBeasiswaController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PengeluaranKeuanganController;
use App\Http\Controllers\ProfilAwardeeController;
use App\Http\Controllers\ProfilBPHController;
use App\Http\Controllers\ProfilDonatorController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\RekapitulasiPemasukanController;
use App\Http\Controllers\RekapitulasiPengeluaranController;
use App\Http\Controllers\TambahPenggunaController;
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

Route::get('/', function () {
    return view('publik.home.index');
});

Route::get('/dashboard', function() {
    return view('dashboard.index');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::middleware(['auth', 'ad_bph_dn'])->group(function () {
    Route::get('/anggota_awardee', [PenerimaBeasiswaController::class, 'index']);
    Route::get('/export_penerima_beasiswa', [PenerimaBeasiswaController::class, 'export']);
    Route::get('/penerima_beasiswa/{id}/detail_pribadi', [PenerimaBeasiswaController::class, 'show']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/add_awarde', [PenerimaBeasiswaController::class, 'create']);
    Route::post('/add_awarde', [PenerimaBeasiswaController::class, 'store']);
    Route::get('/edit_pb/{id}', [PenerimaBeasiswaController::class, 'edit']);
    Route::put('/edit_pb/{id}', [PenerimaBeasiswaController::class, 'update']);
    Route::delete('/delete_pb/{id}', [PenerimaBeasiswaController::class, 'destroy']);
    Route::post('/import_penerima_beasiswa', [PenerimaBeasiswaController::class, 'import']);
});

Route::group(['middleware' => ['auth', 'ad_bph']], function () {
    Route::get('/anggota_bph', [BPHController::class, 'index']);
    Route::get('/add_bph', [BPHController::class, 'create']);
    Route::post('/add_bph', [BPHController::class, 'store']);
    Route::get('/edit_bph/{id}', [BPHController::class, 'edit']);
    Route::put('/edit_bph/{id}', [BPHController::class, 'update']);
    Route::delete('/delete_bph/{id}', [BPHController::class, 'destroy']);
    // Route::get('/show_bph/{id}', [BPHController::class, 'show']);
    Route::get('/export_bph', [BPHController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/anggota_donator', [DonatorController::class, 'index']);
    Route::get('/donator/{id}/detail_pribadi', [DonatorController::class, 'show']);
    Route::get('/add_donator', [DonatorController::class, 'create']);
    Route::post('/add_donator', [DonatorController::class, 'store']);
    Route::get('/edit_donator/{id}', [DonatorController::class, 'edit']);
    Route::put('/edit_donator/{id}', [DonatorController::class, 'update']);
    Route::delete('/delete_dn/{id}', [DonatorController::class, 'destroy']);
    Route::get('/export_donator', [DonatorController::class, 'export']);
});

Route::get('/daftar_pemasukan', [PemasukanController::class, 'index'])->middleware('auth', 'ad_bph_dn');
Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/add_dd', [PemasukanController::class, 'create']);
    Route::post('/add_dd', [PemasukanController::class, 'store']);
    Route::get('/print_dd', [PemasukanController::class, 'print']);
    Route::get('/edit_dd/{id}', [PemasukanController::class, 'edit'])->name('donator_donasi.edit');
    Route::put('/edit_dd/{id}', [PemasukanController::class, 'update'])->name('donator_donasi.update');
    Route::delete('/delete_dd/{id}', [PemasukanController::class, 'destroy']);
    Route::get('/export_pemasukan', [PemasukanController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph_dn'])->group(function () {
    Route::get('/daftar_pengeluaran', [PengeluaranController::class, 'index']);
    Route::get('/export_pengeluaran', [PengeluaranController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/add_pengeluaran', [PengeluaranController::class, 'create']);
    Route::post('/add_pengeluaran', [PengeluaranController::class, 'store']);
    Route::get('/print_pg', [PengeluaranController::class, 'print']);
    Route::get('/edit_pg/{id}', [PengeluaranController::class, 'edit']);
    Route::put('/edit_pg/{id}', [PengeluaranController::class, 'update']);
    Route::delete('/delete_pg/{id}', [PengeluaranController::class, 'destroy']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/jenis_pengeluaran', [JenisPengeluaranController::class, 'index']);
    Route::get('/add_jp', [JenisPengeluaranController::class, 'create']);
    Route::post('/add_jp', [JenisPengeluaranController::class, 'store']);
    Route::get('/edit_jp/{id}', [JenisPengeluaranController::class, 'edit']);
    Route::put('/edit_jp/{id}', [JenisPengeluaranController::class, 'update']);
    Route::delete('/delete_jp/{id}', [JenisPengeluaranController::class, 'destroy']);
    Route::get('/export_jenis_pengeluaran', [JenisPengeluaranController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/jenis_pemasukan', [JenisPemasukanController::class, 'index']);
    Route::get('/add_jenis_pemasukan', [JenisPemasukanController::class, 'create']);
    Route::post('/add_jenis_pemasukan', [JenisPemasukanController::class, 'store']);
    Route::get('/edit_jenis_pemasukan/{id}', [JenisPemasukanController::class, 'edit']);
    Route::put('/edit_jenis_pemasukan/{id}', [JenisPemasukanController::class, 'update']);
    Route::delete('/delete_jenis_pemasukan/{id}', [JenisPemasukanController::class, 'destroy']);
    Route::get('/export_jenis_pemasukan', [JenisPemasukanController::class, 'export']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/tambah_pengguna', [TambahPenggunaController::class, 'index']);
    Route::post('/tambah_pengguna', [TambahPenggunaController::class, 'process']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/daftar_peran_bph', [DaftarPeranBPHController::class, 'index']);
    Route::delete('/delete_peran_bph/{id}', [DaftarPeranBPHController::class, 'destroy']);
    Route::get('/export_jenis_pengeluaran', [JenisPengeluaranController::class, 'export']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/daftar_peran_awardee', [DaftarPeranAwardeeController::class, 'index']);
    Route::delete('/delete_peran_awardee/{id}', [DaftarPeranAwardeeController::class, 'destroy']);
    Route::get('/export_jenis_pengeluaran', [JenisPengeluaranController::class, 'export']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/daftar_peran_donator', [DaftarPeranDonator::class, 'index']);
    Route::delete('/delete_peran_donator/{id}', [DaftarPeranDonator::class, 'destroy']);
    Route::get('/export_jenis_pengeluaran', [JenisPengeluaranController::class, 'export']);
});

Route::middleware(['auth', 'donors'])->group(function () {
    Route::get('/catatan_donasi', [CatatanDonasiController::class, 'index']);
    Route::get('/export_catatan_donasi', [CatatanDonasiController::class, 'export']);
});

Route::middleware(['auth', 'awardee'])->group(function () {
    Route::get('/catatan_beasiswa', [CatatanBeasiswaController::class, 'index']);
    Route::get('/export_catatan_beasiswa', [CatatanBeasiswaController::class, 'export']);
});

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index']);
    Route::get('/account/{id}/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::post('/account/verify-otp', [AccountController::class, 'verifyOtp'])->name('account.verify-otp');
});

Route::get('/home', [PublikController::class, 'index']);

Route::middleware(['auth', 'donors'])->group(function () {
    Route::get('/profil_donator', [ProfilDonatorController::class, 'index']);
    Route::get('/edit_pd/{id}', [ProfilDonatorController::class, 'edit']);
    Route::put('/edit_pd/{id}', [ProfilDonatorController::class, 'update']);
});

Route::middleware(['auth', 'awardee'])->group(function () {
    Route::get('/profil_awardee', [ProfilAwardeeController::class, 'index']);
    Route::get('/edit_pa/{id}', [ProfilAwardeeController::class, 'edit']);
    Route::put('/edit_pa/{id}', [ProfilAwardeeController::class, 'update']);
});

Route::middleware(['auth', 'bph'])->group(function () {
    Route::get('/profil_bph', [ProfilBPHController::class, 'index']);
    Route::get('/edit_bph2/{id}', [ProfilBPHController::class, 'edit']);
    Route::put('/edit_bph2/{id}', [ProfilBPHController::class, 'update']);
});

Route::middleware(['auth', 'awardee'])->group(function () {
    Route::get('/file_beasiswa', [FileBeasiswaController::class, 'index']);
    Route::post('/add_file_beasiswa', [FileBeasiswaController::class, 'store']);
    Route::get('/export_file_beasiswa', [FileBeasiswaController::class, 'export']);
});

Route::middleware(['auth', 'awardee'])->group(function () {
    Route::get('/ajuan_beasiswa', [AjuanBeasiswaController::class, 'index']);
    Route::get('/add_ajuan_beasiswa', [AjuanBeasiswaController::class, 'create']);
    Route::post('/add_ajuan_beasiswa', [AjuanBeasiswaController::class, 'store']);
    Route::get('/export_ajuan_beasiswa', [AjuanBeasiswaController::class, 'export']);
});

Route::middleware(['auth', 'donors'])->group(function () {
    Route::get('/bukti_donasi', [BuktiDonasiController::class, 'index']);
    Route::get('/add_donasi', [BuktiDonasiController::class, 'create']);
    Route::post('/add_donasi', [BuktiDonasiController::class, 'store']);
    Route::get('/export_ajuan_bukti_donasi', [BuktiDonasiController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph_aw'])->group(function () {
    Route::get('/dokumen_awardee', [DokumenAwardeeController::class, 'index']);
    Route::delete('/delete_dokumen_awardee/{id}', [DokumenAwardeeController::class, 'destroy']);
    Route::get('/export_dokumen_awardee', [DokumenAwardeeController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/edit_dokumen_awardee/{id}', [DokumenAwardeeController::class, 'edit']);
    Route::post('/add_dokumen_awardee', [DokumenAwardeeController::class, 'store']);
    Route::put('/edit_dokumen_awardee/{id}', [DokumenAwardeeController::class, 'update']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/daftar_file_beasiswa', [DaftarFileBeasiswaController::class, 'index']);
    Route::get('/daftar_file_beasiswa/{id}', [DaftarFileBeasiswaController::class, 'edit']);
    Route::put('/daftar_file_beasiswa/{id}', [DaftarFileBeasiswaController::class, 'update']);
    Route::get('/export_daftar_file_beasiswa', [DaftarFileBeasiswaController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/daftar_ajuan_beasiswa', [DaftarAjuanBeasiswaController::class, 'index']);
    Route::get('/edit_ajuan_beasiswa/{id}', [DaftarAjuanBeasiswaController::class, 'edit']);
    Route::put('/edit_ajuan_beasiswa/{id}', [DaftarAjuanBeasiswaController::class, 'update']);
    Route::get('/export_daftar_ajuan_beasiswa', [DaftarAjuanBeasiswaController::class, 'export']);
});

Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/daftar_bukti_donasi', [DaftarBuktiDonasiController::class, 'index']);
    Route::get('/edit_bukti_donasi/{id}', [DaftarBuktiDonasiController::class, 'edit']);
    Route::put('/edit_bukti_donasi/{id}', [DaftarBuktiDonasiController::class, 'update']);
    Route::get('/export_daftar_bukti_donasi', [DaftarBuktiDonasiController::class, 'export']);
});

Route::get('/album', [AlbumDokumentasiController::class, 'index']);
Route::middleware(['auth', 'ad_bph'])->group(function () {
    Route::get('/album_dokumentasi', [AlbumDokumentasiController::class, 'index2']);
    Route::get('/add_dokumentasi', [AlbumDokumentasiController::class, 'create']);
    Route::post('/add_dokumentasi', [AlbumDokumentasiController::class, 'store']);
    Route::get('/edit_dokumentasi/{id}', [AlbumDokumentasiController::class, 'edit']);
    Route::put('/edit_dokumentasi/{id}', [AlbumDokumentasiController::class, 'update']);
    Route::delete('/delete_dokumentasi/{id}', [AlbumDokumentasiController::class, 'destroy'])->middleware('auth');
    Route::get('/export_dokumentasi', [AlbumDokumentasiController::class, 'export']);
});

Route::get('/rekapitulasi_pengeluaran', [RekapitulasiPengeluaranController::class, 'index'])->middleware('auth');

Route::get('/rekapitulasi_pemasukan', [RekapitulasiPemasukanController::class, 'index'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/informasi_donasi', [InformasiDonasiController::class, 'index']);
    Route::get('/filter_informasi_donasi', [InformasiDonasiController::class, 'filter']);
});

Route::middleware('auth')->group(function () {
    Route::get('/laporan_pemasukan', [LaporanPemasukanController::class, 'index']);
    Route::get('/filter_pemasukan', [LaporanPemasukanController::class, 'filter']);
});

Route::middleware('auth')->group(function () {
    Route::get('/laporan_pengeluaran', [LaporanPengeluaranController::class, 'index']);
    Route::get('/filter_pengeluaran', [LaporanPengeluaranController::class, 'filter']);
});

Route::middleware('auth', 'ad_bph_dn')->group(function () {
    Route::get('/informasi_beasiswa', [InformasiBeasiswaController::class, 'index']);
    Route::get('/filter_informasi_beasiswa', [InformasiBeasiswaController::class, 'filter']);
});

Route::get('/pemasukan_keuangan', [PemasukanKeuanganController::class, 'index']);
Route::get('/filter_pemasukan_keuangan', [PemasukanKeuanganController::class, 'filter']);

Route::get('/pengeluaran_keuangan', [PengeluaranKeuanganController::class, 'index']);
Route::get('/filter_pengeluaran_keuangan', [PengeluaranKeuanganController::class, 'filter']);

Route::fallback([ErrorController::class, 'show404']);

Route::get('/logout', [LogoutController::class, 'index'])->middleware('auth');
?>