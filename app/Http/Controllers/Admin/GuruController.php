<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index() {
        $data = Guru::paginate(Guru::PAGINATE);
        return view('administrator.guru.index', compact('data'));
    }

    public function all(Request $request) {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = Guru::where('nip', 'like', '%' . $query . '%')
                ->orWhere('nama', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(Guru::PAGINATE);
            return view('administrator.guru.data-guru', compact('data'))->render();
        }
    }

    public function show($id) {
        return view('administrator.guru.show', [
            'siswa' => Guru::with('user')->where('id', Crypt::decrypt($id))->first()
        ]);
    }

    public function create() {
        return view('administrator.guru.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nip' => 'required|unique:tb_guru|max:50',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|max:100',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'agama' => 'required|max:20',
            'no_hp' => 'required|',
            'alamat' => 'required|max:255',
            'jenis_gtk' => 'required'
        ]);
        $user = new User();
        $user->username = $request->nip;
        $user->password = Hash::make($request->tanggal . $request->bulan . $request->tahun);
        $user->name = $request->nama;
        $user->save();

        $guru = new Guru();
        $guru->user_id = $user->id;
        $guru->nip = $request->nip;
        $guru->nama = $request->nama;
        $guru->jenis_gtk = $request->jenis_gtk;
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

        $user->assignRole(User::GURU);

        return redirect()->route('manage-guru.index')->with('status', 'Data succesfully created...');
    }

    public function edit($id) {
        return view('administrator.guru.edit',  [
            'guru' => Guru::findOrFail(Crypt::decrypt($id))
        ]);
        // $guru = Siswa::findOrFail(Crypt::decrypt($id));
        // return Carbon::createFromFormat('Y-m-d', $guru->tanggal_lahir)->format('Y');
    }

    public function update(Request $request, $id) {
        $user = User::where('username', $request->old_nip)->first();
        $user->username = $request->nip;
        $user->password = Hash::make($request->tanggal . $request->bulan . $request->tahun);
        $user->name = $request->nama;
        $user->save();

        $guru = Guru::findOrFail(Crypt::decrypt($id));
        $guru->user_id = $user->id;
        $guru->nip = $request->nip;
        $guru->nama = $request->nama;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->jenis_gtk = $request->jenis_gtk;
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

        return redirect()->route('manage-guru.index')->with('status', 'Data succesfully changed...');
    }

    public function destroy($id){
        $user = User::where('username', Crypt::decrypt($id))->first();
        $user->removeRole(User::GURU);
        $user->delete();
        return redirect()->route('manage-guru.index')->with('status', 'Data succesfully removed...');
    }
}
