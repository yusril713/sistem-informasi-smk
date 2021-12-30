<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index() {
        $data = Siswa::orderBy('tahun_masuk', 'asc')->paginate(Siswa::PAGINATE);
        return view('administrator.siswa.index', compact('data'));
    }

    public function all(Request $request) {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = Siswa::where('no_induk', 'like', '%' . $query . '%')
                ->orWhere('nisn', 'like', '%' . $query . '%')
                ->orWhere('nama', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(Siswa::PAGINATE);
            return view('administrator.siswa.data-siswa', compact('data'))->render();
        }
    }

    public function create() {
        return view('administrator.siswa.create');
    }

    public function show($id) {
        return view('administrator.siswa.show', [
            'siswa' => Siswa::with('user')->where('id', Crypt::decrypt($id))->first()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'no_induk' => 'required|unique:tb_siswa|max:50',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|max:100',
            'tanggal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'agama' => 'required|max:20',
            'alamat' => 'required|max:255',
            'tahun_masuk' => 'required',
        ]);
        $user = new User();
        $user->username = $request->no_induk;
        $user->password = Hash::make($request->tanggal . $request->bulan . $request->tahun);
        $user->name = $request->nama;
        $user->save();

        $siswa = new Siswa();
        $siswa->user_id = $user->id;
        $siswa->no_induk = $request->no_induk;
        $siswa->nisn = $request->nisn;
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

        $user->assignRole(User::SISWA);

        return redirect()->route('manage-siswa.index')->with('status', 'Data succesfully created...');
    }

    public function edit($id) {
        return view('administrator.siswa.edit',  [
            'siswa' => Siswa::findOrFail(Crypt::decrypt($id))
        ]);
        // $siswa = Siswa::findOrFail(Crypt::decrypt($id));
        // return Carbon::createFromFormat('Y-m-d', $siswa->tanggal_lahir)->format('Y');
    }

    public function update(Request $request, $id) {
        $user = User::where('username', $request->old_no_induk)->first();
        $user->username = $request->no_induk;
        $user->password = Hash::make($request->tanggal . $request->bulan . $request->tahun);
        $user->name = $request->nama;
        $user->save();

        $siswa = Siswa::findOrFail(Crypt::decrypt($id));
        $siswa->user_id = $user->id;
        $siswa->no_induk = $request->no_induk;
        $siswa->nisn = $request->nisn;
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

        return redirect()->route('manage-siswa.index')->with('status', 'Data succesfully changed...');
    }

    public function destroy($id){
        $user = User::where('username', Crypt::decrypt($id))->first();
        $user->removeRole(User::SISWA);
        $user->delete();
        return redirect()->route('manage-siswa.index')->with('status', 'Data succesfully removed...');
    }
}
