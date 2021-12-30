<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    public function index() {
        $role = User::find(Auth::user()->id)->roles[0]->name;
        if ($role == 'Admin' or $role == 'Guru')
            return view('user.profile.account', [
                'data' => Guru::where('user_id', Auth::user()->id)->firstOrFail(),
                'role' => $role
            ]);
        elseif ($role == 'Siswa') {
            return view('user.profile.account', [
                'data' => Siswa::where('user_id', Auth::user()->id)->firstOrFail(),
                'role' => $role
            ]);
        }
    }

    public function update(Request $request, $id) {
        if ($request->role == 'Admin' or $request->role == 'Guru') {
            $guru = Guru::findOrFail(Crypt::decrypt($id));
            $guru->nama = $request->nama;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->tempat_lahir = $request->tempat_lahir;
            $guru->tanggal_lahir = $request->tahun . '-' . $request->bulan . '-' . $request->tanggal;
            $guru->agama = $request->agama;
            $guru->no_hp = $request->no_hp;
            $guru->alamat = $request->alamat;
            $guru->rt = $request->rt;
            $guru->rw = $request->rw;
            $guru->kelurahan = $request->kelurahan;
            $guru->kecamatan = $request->kecamatan;
            $guru->kabupaten = $request->kabupaten;
            $guru->save();
        } else {
            $siswa = Siswa::findOrFail(Crypt::decrypt($id));
            $siswa->nama = $request->nama;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->tempat_lahir = $request->tempat_lahir;
            $siswa->tanggal_lahir = $request->tahun . '-' . $request->bulan . '-' . $request->tanggal;
            $siswa->agama = $request->agama;
            $siswa->no_hp = $request->no_hp;
            $siswa->alamat = $request->alamat;
            $siswa->rt = $request->rt;
            $siswa->rw = $request->rw;
            $siswa->kelurahan = $request->kelurahan;
            $siswa->kecamatan = $request->kecamatan;
            $siswa->kabupaten = $request->kabupaten;
            $siswa->tahun_masuk = $request->tahun_masuk;
            $siswa->save();
        }
        return redirect()->route('account.index')->with('status', 'Account successfully changed...');
    }

    public function EditPhoto() {
        return view('user.profile.edit-photo');
    }

    public function UpdatePhoto(Request $request, $id){
        $user = User::findOrFail(Crypt::decrypt($id));
        if($request->hasfile('foto')) {
            if($user->profile_photo_path && file_exists(storage_path('app/public/'. $user->profile_photo_path))){
                unlink(storage_path('app/public/' . $user->profile_photo_path));
            }
            $file = $request->file('foto')->store('account/' . Auth::user()->name, 'public');
            $user->profile_photo_path = $file;
        }
        $user->save();
        return redirect()->route('account.index');
    }
}
