<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DirektoriController extends Controller
{
    public function DirektoriGuru() {
        return view('visitor.direktori.guru', [
            'guru' => Guru::with('user')->paginate(30)
        ]);
    }

    public function DirektoriSiswa() {
        $siswa = Siswa::with('user')->where('status', Siswa::SISWA)->orderBy('tahun_masuk', 'desc')->paginate(30);
        $str = 'Siswa';
        return view('visitor.direktori.siswa', compact(['siswa', 'str']));
    }

    public function DirektoriAlumni() {
        return view('visitor.direktori.siswa', [
            'siswa' => Siswa::with('user')->where('status', Siswa::ALUMNI)->paginate(30),
            'str' => 'Alumni'
        ]);
    }
}
