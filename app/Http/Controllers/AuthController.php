<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sektor;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (auth()->attempt(['username' => $request->username, 'password' => $request->password])) {
            $authenticatedUser = auth()->user();
            // $sektor = Sektor::where('kode_sektor', $user->kode)->first();
            if ($authenticatedUser->role == "Kepala Sektor") {
                // if ($sektor) {
                // Redirect to sektor dashboard
                return redirect()->route('sektor.dashboard');
                // }
            } else if ($authenticatedUser->role == "Kepala Keluarga") {
                // $kepala_keluarga = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
                //     ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
                //     ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
                //     ->where('hubungan_keluarga.keterangan', 'Kepala Keluarga')
                //     ->where('registrasi_anggota.no_registrasi', $user->kode)
                //     ->first();
                return redirect()->route('keluarga.dashboard');

                // if ($kepala_keluarga) {
                //     return redirect()->route('kepala_keluarga.detail', ['id' => $kepala_keluarga->id_anggota]);
                // } else {
                //     return redirect()->route('login.form')->withErrors('Kepala Keluarga tidak ditemukan.');
                // }
            } else if ($authenticatedUser->role == "Kepala Cabang") {
                return redirect()->route('cabang.dashboard');
            } else if ($authenticatedUser->role == "Admin") {
                return redirect()->route('admin');
            }
        }

        return redirect()->route('login.form')->withErrors('Username atau password salah.');
    }


    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Successfully logged out.');
    }
}
