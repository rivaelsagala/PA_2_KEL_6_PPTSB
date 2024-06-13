<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\SektorController;
use App\Models\Sektor;

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

Route::get('/login-halaman', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:Admin'])->group(function () {

    //ADMIN
    Route::get('/admin-dashboard', [AdminController::class, 'admin'])->name('admin');
    Route::get('/jenis-status', [AdminController::class, 'jenis_status']);
    Route::get('/status', [AdminController::class, 'status']);
    Route::get('/pendidikan', [AdminController::class, 'pendidikan']);
    Route::get('/jabatan', [AdminController::class, 'jabatan']);
    Route::get('/pekerjaan', [AdminController::class, 'pekerjaan']);
    Route::get('/hubungan-keluarga', [AdminController::class, 'hubungan_keluarga']);
    Route::get('/bidang', [AdminController::class, 'bidang']);

    Route::get('/admin-pengumuman', [PengumumanController::class, 'pengumuman']);
    Route::get('/admin-pusat', [AdminController::class, 'pusat']);
    Route::get('/admin-regional', [AdminController::class, 'regional']);
    Route::get('/admin-cabang', [AdminController::class, 'cabang']);
    Route::get('/admin-kepala_keluarga', [AdminController::class, 'kepala_keluarga']);
    Route::get('/admin-anggota', [AdminController::class, 'anggota']);
    Route::get('/admin-pejabat', [AdminController::class, 'pejabat']);
    Route::get('/admin-sektor', [AdminController::class, 'sektor']);

    //pengumuman
    Route::post('/admin-tambah-pengumuman', [PengumumanController::class, 'tambah_pengumuman']);
    Route::get('/edit/admin-pengumuman-halaman/{id}', [PengumumanController::class, 'edit_pengumuman_halaman']);
    Route::post('/admin-edit-pengumuman/{id}', [PengumumanController::class, 'edit_pengumuman']);
    Route::post('/delete/admin-pengumuman/{id}', [PengumumanController::class, 'delete_pengumuman']);

    //jenis status
    Route::post('/tambah-jenis-status', [AdminController::class, 'tambah_jenis_status']);
    Route::get('/edit/jenis-status-halaman/{id}', [AdminController::class, 'edit_jenis_status_halaman']);
    Route::post('/edit-jenis-status/{id}', [AdminController::class, 'edit_jenis_status']);
    Route::post('/delete/jenis-status/{id}', [AdminController::class, 'delete_jenis_status']);

    //status
    Route::post('/tambah-status', [AdminController::class, 'tambah_status']);
    Route::get('/edit/status-halaman/{id}', [AdminController::class, 'edit_status_halaman']);
    Route::post('/edit-status/{id}', [AdminController::class, 'edit_status']);
    Route::post('/delete/status/{id}', [AdminController::class, 'delete_status']);

    //pendidikan
    Route::post('/tambah-pendidikan', [AdminController::class, 'tambah_pendidikan']);
    Route::get('/edit/pendidikan-halaman/{id}', [AdminController::class, 'edit_pendidikan_halaman']);
    Route::post('/edit-pendidikan/{id}', [AdminController::class, 'edit_pendidikan']);
    Route::post('/delete/pendidikan/{id}', [AdminController::class, 'delete_pendidikan']);

    //pekerjaan
    Route::post('/tambah-pekerjaan', [AdminController::class, 'tambah_pekerjaan']);
    Route::get('/edit/pekerjaan-halaman/{id}', [AdminController::class, 'edit_pekerjaan_halaman']);
    Route::post('/edit-pekerjaan/{id}', [AdminController::class, 'edit_pekerjaan']);
    Route::post('/delete/pekerjaan/{id}', [AdminController::class, 'delete_pekerjaan']);

    //bidang
    Route::post('/tambah-bidang', [AdminController::class, 'tambah_bidang']);
    Route::get('/edit/bidang-halaman/{id}', [AdminController::class, 'edit_bidang_halaman']);
    Route::post('/edit-bidang/{id}', [AdminController::class, 'edit_bidang']);
    Route::post('/delete/bidang/{id}', [AdminController::class, 'delete_bidang']);

    //jabatan
    Route::post('/tambah-jabatan', [AdminController::class, 'tambah_jabatan']);
    Route::get('/edit/jabatan-halaman/{id}', [AdminController::class, 'edit_jabatan_halaman']);
    Route::post('/edit-jabatan/{id}', [AdminController::class, 'edit_jabatan']);
    Route::post('/delete/jabatan/{id}', [AdminController::class, 'delete_jabatan']);

    //pusat
    Route::get('/edit-pusat/{id}', [AdminController::class, 'edit_pusat_show'])->name('pusat.edit');
    Route::put('/edit-pusat-proses/{id}', [AdminController::class, 'edit_pusat'])->name('pusat.update');

    //regional
    Route::get('/edit-regional/{id}', [AdminController::class, 'edit_regional_show'])->name('regional.edit');
    Route::put('/edit-regional-proses/{id}', [AdminController::class, 'edit_regional'])->name('regional.update');


    //cabang
    Route::get('/admin-edit-cabang/{id}', [AdminController::class, 'edit_cabang_show'])->name('cabang.edit');
    Route::put('/admin-edit-cabang-proses/{id}', [AdminController::class, 'edit_cabang'])->name('cabang.update');


    //sektor
    Route::post('/admin-tambah-sektor', [AdminController::class, 'tambah_sektor']);
    Route::get('/admin-edit-sektor/{id}', [AdminController::class, 'edit_sektor_show'])->name('admin_sektor.edit');
    Route::put('/admin-edit-sektor-proses/{id}', [AdminController::class, 'edit_sektor'])->name('admin_sektor.update');
    Route::get('/admin-sektor-detail/{id}', [AdminController::class, 'detail_sektor'])->name('admin_sektor.detail');
    Route::post('/admin-sektor-terima/{id}', [AdminController::class, 'terima'])->name('admin_sektor.terima');
    Route::post('/admin-sektor-tolak/{id}', [AdminController::class, 'tolak'])->name('admin_sektor.tolak');


    //anggota
    Route::post('/admin-tambah-anggota', [AdminController::class, 'tambah_anggota']);
    Route::get('/admin-edit-anggota/{id}', [AdminController::class, 'edit_anggota_show'])->name('anggota.edit');
    Route::post('/admin-edit-anggota-proses/{id}', [AdminController::class, 'edit_anggota'])->name('admin.anggota.update');
    Route::post('/admin-anggota-keaktifan/{id}', [AdminController::class, 'keaktifan'])->name('admin.keaktifan');

    //kepala kelauarga
    Route::get('/admin-edit-kepala_keluarga/{id}', [AdminController::class, 'edit_kepala_keluarga_show'])->name('admin_kepala_keluarga.edit');
    Route::post('/admin-edit-kepala_keluarga-proses/{id}', [AdminController::class, 'edit_kepala_keluarga'])->name('kepala_keluarga.update');
    Route::get('/admin-kepala_keluarga-detail/{id}', [AdminController::class, 'detail_kepala_keluarga'])->name('kepala_keluarga.detail');
    Route::post('/admin_tambah_kepala_keluarga', [AdminController::class, 'tambah_kepala_keluarga']);
    Route::post('/pindah-sektor', [AdminController::class, 'pindah_sektor']);

    //pejabat struktural

    Route::get('/admin-edit-pejabat/{id}', [AdminController::class, 'edit_pejabat_show'])->name('pejabat.edit');
    Route::post('/admin-edit-pejabat-proses/{id}', [AdminController::class, 'edit_pejabat'])->name('pejabat.update');
    Route::post('/admin_tambah-pejabat', [AdminController::class, 'tambah_pejabat']);
});

//CABANGGGGGG

Route::middleware(['auth', 'role:Kepala Cabang'])->group(function () {

    Route::get('/cabang-dashboard', [CabangController::class, 'cabang_dashboard'])->name('cabang.dashboard');


    //pengumuman
    Route::get('/cabang-pengumuman', [CabangController::class, 'pengumuman']);

    Route::post('/cabang-tambah-pengumuman', [CabangController::class, 'tambah_pengumuman']);
    Route::get('/edit/cabang-pengumuman-halaman/{id}', [CabangController::class, 'edit_pengumuman_halaman']);
    Route::post('/cabang-edit-pengumuman/{id}', [CabangController::class, 'edit_pengumuman']);
    Route::post('/delete/cabang-pengumuman/{id}', [CabangController::class, 'delete_pengumuman']);


    //cabang
    Route::get('/cabang-cabang', [CabangController::class, 'cabang'])->name('cabang');
    Route::get('/edit-cabang/{id}', [CabangController::class, 'edit_cabang_show'])->name('cabang.edit');
    Route::put('/edit-cabang-proses/{id}', [CabangController::class, 'edit_cabang'])->name('cabang.update');


    //sektor
    Route::get('/cabang-sektor', [CabangController::class, 'sektor']);
    Route::post('/tambah-sektor', [CabangController::class, 'tambah_sektor']);
    Route::get('/cabang-edit-sektor/{id}', [CabangController::class, 'edit_sektor_show'])->name('cabang_sektor.edit');
    Route::put('/cabang-edit-sektor-proses/{id}', [CabangController::class, 'edit_sektor'])->name('sektor.update');
    Route::get('/cabang-sektor-detail/{id}', [CabangController::class, 'detail_sektor'])->name('cabang_sektor.detail');
    Route::post('/cabang-sektor-terima/{id}', [CabangController::class, 'terima'])->name('sektor.terima');
    Route::post('/cabang-sektor-tolak/{id}', [CabangController::class, 'tolak'])->name('sektor.tolak');


    //kepala kelauarga
    Route::get('/cabang-kepala_keluarga', [CabangController::class, 'kepala_keluarga']);
    Route::get('/cabang-edit-kepala_keluarga/{id}', [CabangController::class, 'edit_kepala_keluarga_show'])->name('cabang.kepala_keluarga.edit');
    Route::post('/cabang-edit-kepala_keluarga-proses/{id}', [CabangController::class, 'edit_kepala_keluarga'])->name('kepala_keluarga.update');
    Route::get('/cabang-kepala_keluarga-detail/{id}', [CabangController::class, 'detail_kepala_keluarga'])->name('cabang-kepala_keluarga.detail');
    Route::post('/cabang_tambah_kepala_keluarga', [CabangController::class, 'tambah_kepala_keluarga']);
    Route::post('/pindah-sektor', [CabangController::class, 'pindah_sektor']);



    //anggota
    Route::get('/cabang-anggota', [CabangController::class, 'anggota']);
    Route::post('/cabang-tambah-anggota', [CabangController::class, 'tambah_anggota']);
    Route::get('/cabang-edit-anggota/{id}', [CabangController::class, 'edit_anggota_show'])->name('anggota.edit');
    Route::post('/cabang-edit-anggota-proses/{id}', [CabangController::class, 'edit_anggota'])->name('anggota.update');
    Route::post('/cabang-anggota/{id_anggota}/toggle-status', [CabangController::class, 'keaktifan'])->name('anggota.keaktifan');


    //pejabat struktural
    Route::get('/cabang-pejabat', [CabangController::class, 'pejabat']);
    Route::get('/cabang-edit-pejabat/{id}', [CabangController::class, 'edit_pejabat_show'])->name('pejabat.edit');
    Route::post('/cabang-edit-pejabat-proses/{id}', [CabangController::class, 'edit_pejabat'])->name('pejabat.update');
    Route::post('/cabang-tambah-pejabat', [CabangController::class, 'tambah_pejabat']);
});



Route::middleware(['auth', 'role:Kepala Sektor'])->group(function () {

    Route::get('/sektor-dashboard', [SektorController::class, 'sektor_dashboard'])->name('sektor.dashboard');

    //pengumuman
    Route::get('/sektor-pengumuman', [SektorController::class, 'pengumuman']);

    Route::post('/sektor-tambah-pengumuman', [SektorController::class, 'tambah_pengumuman']);
    Route::get('/edit/sektor-pengumuman-halaman/{id}', [SektorController::class, 'edit_pengumuman_halaman']);
    Route::post('/sektor-edit-pengumuman/{id}', [SektorController::class, 'edit_pengumuman']);
    Route::post('/delete/sektor-pengumuman/{id}', [SektorController::class, 'delete_pengumuman']);


    Route::get('/sektor-edit-sektor/{id}', [SektorController::class, 'edit_sektor_show'])->name('sektor.sektor.edit');
    Route::put('/sektor-edit-sektor-proses/{id}', [SektorController::class, 'edit_sektor'])->name('sektor.update');
    Route::post('/sektor-terima/{id}', [SektorController::class, 'terima'])->name('sektor.terima');
    Route::post('/sektor-tolak/{id}', [SektorController::class, 'tolak'])->name('sektor.tolak');
    Route::get('/sektor-detail/{id}', [SektorController::class, 'detail_sektor'])->name('sektor_sektor.detail');


    //kepala kelauarga
    // Route::get('/sektor-kepala_keluarga', [SektorController::class, 'kepala_keluarga']);
    Route::get('/sektor-edit-kepala_keluarga/{id}', [SektorController::class, 'edit_kepala_keluarga_show'])->name('sektor.kepala_keluarga.edit');
    Route::post('/sektor-edit-kepala_keluarga-proses/{id}', [SektorController::class, 'edit_kepala_keluarga'])->name('sektor.kepala_keluarga.update');
    Route::get('/sektor-kepala_keluarga-detail/{id}', [SektorController::class, 'detail_kepala_keluarga'])->name('sektor.kepala_keluarga.detail');
    Route::post('/sektor-tambah_kepala_keluarga', [SektorController::class, 'tambah_kepala_keluarga']);
    Route::post('/sektor-pindah-sektor', [SektorController::class, 'pindah_sektor']);



    //anggota
    Route::get('/sektor-anggota', [SektorController::class, 'anggota']);
    Route::post('/tambah-anggota', [SektorController::class, 'tambah_anggota']);
    Route::get('/edit-anggota/{id}', [SektorController::class, 'edit_anggota_show'])->name('sektor.anggota.edit');
    Route::post('/edit-anggota-proses/{id}', [SektorController::class, 'edit_anggota'])->name('sektor.anggota.update');
    Route::post('/anggota/{id_anggota}/toggle-status', [SektorController::class, 'keaktifan'])->name('sektor.anggota.keaktifan');


    //pejabat struktural
    Route::get('/sektor-pejabat', [SektorController::class, 'pejabat']);
    Route::get('/edit-pejabat/{id}', [SektorController::class, 'edit_pejabat_show'])->name('pejabat.edit');
    Route::post('/edit-pejabat-proses/{id}', [SektorController::class, 'edit_pejabat'])->name('pejabat.update');
    Route::post('/tambah-pejabat', [SektorController::class, 'tambah_pejabat']);
});





Route::middleware(['auth', 'role:Kepala Keluarga'])->group(function () {
    Route::get('/keluarga-dashboard', [KeluargaController::class, 'keluarga_dashboard'])->name('keluarga.dashboard');
    Route::get('/kepala_keluarga-detail/{id}', [KeluargaController::class, 'detail_kepala_keluarga'])->name('keluarga_kepala_keluarga.detail');
    Route::post('/anggota-aktif/{id}', [KeluargaController::class, 'keaktifan']);
    Route::get('/keluarga-edit-anggota/{id}', [KeluargaController::class, 'edit_anggota_show']);
    Route::post('/keluarga-edit-anggota-proses/{id}', [KeluargaController::class, 'edit_anggota']);
    Route::post('/keluarga-tambah-anggota', [KeluargaController::class, 'tambah_anggota']);
    Route::post('/keluarga-pindah-sektor', [KeluargaController::class, 'pindah_sektor']);
});

//USER
Route::get('/', [UserController::class, 'user'])->name('home');
Route::get('/pengumuman', [UserController::class, 'pengumuman']);
Route::get('/sejarah', [UserController::class, 'sejarah'])->name('sejarah');
Route::get('/detpengumuman/{id}', [KegiatanController::class, 'showById'])->name('detpengumuman');
Route::get('/pengumuman/{id}', [KegiatanController::class, 'showById'])->name('detpengumumanid');

Route::get('user/pusat', [RouteController::class, 'pusat']);
Route::get('user/regional', [RouteController::class, 'regional']);
Route::get('user/cabang', [RouteController::class, 'cabang']);
Route::get('user/sektor', [RouteController::class, 'sektor']);
Route::get('user/detsektor', [UserController::class, 'detsSektor']); // Tambahkan rute ini
Route::get('/detpengumuman', [UserController::class, 'detpengumuman'])->name('detpengumuman');
Route::get('/index', [UserController::class, 'user'])->name('user');


Route::get('/youtube', function () {
    return redirect('https://www.youtube.com/live/PIu5zjaNOtI?si=2V1keFfKHHqeJr0d');
})->name('youtube');

Route::get('/twitter', function () {
    return redirect('https://twitter.com/your_profile');
})->name('twitter');

Route::get('/instagram', function () {
    return redirect('https://www.instagram.com/explore/tags/pptsbtaput/');
})->name('instagram');

Route::get('/facebook', function () {
    return redirect('https://www.facebook.com/groups/1217184321811623/media?locale=id_ID');
})->name('facebook');


// Route::group(['middleware' => ['isKepalaSektor']], function () {
// Route::get('/sektor-detail/{id}', [SektorController::class, 'detail_sektor'])->name('sektor.detail');
//     Route::get('/kepala_keluarga-detail/{id}', [SektorController::class, 'detail_kepala_keluarga'])->name('kepala_keluarga.detail');
//     Route::post('/tambah_kepala_keluarga_sektor', [SektorController::class, 'tambah_kepala_keluarga_bySektor']);
//     Route::post('/logout', function () {
//         Auth::logout();
//         return redirect()->route('login.form');
//     })->name('logout');
// });
// Route::group(['middleware' => ['isKepalaCabang']], function () {
//     Route::get('/admin-cabang', [CabangController::class, 'cabang']);

//     Route::get('/edit-cabang/{id}', [CabangController::class, 'edit_cabang_show'])->name('cabang.edit');
//     Route::put('/edit-cabang-proses/{id}', [CabangController::class, 'edit_cabang'])->name('cabang.update');
//     Route::post('/tambah-sektor', [CabangController::class, 'tambah_sektor']);
//     Route::get('/edit-sektor/{id}', [CabangController::class, 'edit_sektor_show'])->name('sektor.edit');
//     Route::put('/edit-sektor-proses/{id}', [CabangController::class, 'edit_sektor'])->name('sektor.update');
//     Route::get('/sektor-detail/{id}', [CabangController::class, 'detail_sektor'])->name('sektor.detail');
//     Route::post('/sektor/{id_reg_pindah}/toggle-terima', [CabangController::class, 'terima'])->name('sektor.terima');
//     Route::post('/sektor/{id_reg_pindah}/toggle-tolak', [CabangController::class, 'tolak'])->name('sektor.tolak');
//     Route::get('/edit-kepala_keluarga/{id}', [CabangController::class, 'edit_kepala_keluarga_show'])->name('kepala_keluarga.edit');
//     Route::post('/edit-kepala_keluarga-proses/{id}', [CabangController::class, 'edit_kepala_keluarga'])->name('kepala_keluarga.update');
//     Route::get('/kepala_keluarga-detail/{id}', [CabangController::class, 'detail_kepala_keluarga'])->name('kepala_keluarga.detail');
//     Route::post('/tambah_kepala_keluarga', [CabangController::class, 'tambah_kepala_keluarga']);
//     Route::post('/pindah-sektor', [CabangController::class, 'pindah_sektor']);
//     Route::get('/kepala_keluarga-detail/{id}', [CabangController::class, 'detail_kepala_keluarga'])->name('kepala_keluarga.detail');

//     Route::post('/logout', function () {
//         Auth::logout();
//         return redirect()->route('login.form');
//     })->name('logout');
// });

// Route::group(['middleware' => ['isKepalaKeluarga']], function () {
//     Route::get('/kepala_keluarga-detail/{id}', [KeluargaController::class, 'detail_kepala_keluarga'])->name('kepala_keluarga.detail');
// Route::post('/tambah-anggota', [KeluargaController::class, 'tambah_anggota']);
// Route::post('/pindah-sektor', [KeluargaController::class, 'pindah_sektor']);
//     Route::post('/logout', function () {
//         Auth::logout();
//         return redirect()->route('login.form');
//     })->name('logout');
// });
