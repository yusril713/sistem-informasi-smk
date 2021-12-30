<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaDetail;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RegistrasiSiswaController extends Controller
{
    public function index() {
        $ta = TahunAjaran::orderByRaw('FIELD(status, "Aktif", "Tidak Aktif")')->orderBy('mulai', 'desc')->get();
        $data = TahunAjaran::with(['detail_siswa.siswa', 'detail_siswa.kelas.jurusan'])->where('status', TahunAjaran::AKTIF)->first();
        return view('administrator.reg-siswa.index', compact(['ta', 'data']));
        // return compact('data');
    }

    public function find(Request $request) {
        if($request->ajax()) {
            $data = TahunAjaran::with(['detail_siswa.siswa', 'detail_siswa.kelas.jurusan'])->where('id', $request->id)->first();
            return view('administrator.reg-siswa.data', compact('data'))->render();
        }
    }

    public function create() {
        $ta = TahunAjaran::orderByRaw('FIELD(status, "Aktif", "Tidak Aktif")')->orderBy('mulai', 'desc')->get();
        $kelas = Kelas::with('jurusan')->orderBy('jurusan_id', 'asc')->get();
        if ($ta) {
            $siswa = Siswa::whereNotIn('id',
                SiswaDetail::join('tb_tahun_ajaran', 'tb_detail_siswa.tahun_ajaran_id', 'tb_tahun_ajaran.id')
                    ->where('tb_tahun_ajaran.status', TahunAjaran::AKTIF)
                    ->pluck('siswa_id'))
                ->orderBy('tahun_masuk', 'desc')
                ->get();
        }
        //return $siswa;
        return view('administrator.reg-siswa.create', compact(['ta', 'siswa', 'kelas']));
    }

    public function DataToCreate(Request $request) {
        if($request->ajax()) {
            $kelas = Kelas::with('jurusan')->orderBy('jurusan_id', 'asc')->get();
            $siswa = Siswa::whereNotIn('id',
                SiswaDetail::join('tb_tahun_ajaran', 'tb_detail_siswa.tahun_ajaran_id', 'tb_tahun_ajaran.id')
                    ->where('tb_tahun_ajaran.id', $request->get('id'))
                    ->pluck('siswa_id'))
                ->orderBy('tahun_masuk', 'desc')
                ->get();
            return view('administrator.reg-siswa.create-data', compact(['siswa', 'kelas']))->render();
        }
    }

    public function store(Request $request) {
        // if ($request->kelas[0])
        //     return 'true';
        // return 'false';
        for($i = 0; $i < sizeof($request->kelas); $i++) {
            if($request->kelas[$i]) {
                $detail = new SiswaDetail();
                $detail->siswa_id = $request->siswa_id[$i];
                $detail->kelas_id = $request->kelas[$i];
                $detail->tahun_ajaran_id = $request->tahun_ajaran_id;
                $detail->save();
            }
        }

        return redirect()->route('registration-siswa.index')->with('status', 'Data successfully created...');
    }

    public function edit($siswa, $tahun_ajaran) {
        $detail = SiswaDetail::where('siswa_id', Crypt::decrypt($siswa))
            ->where('tahun_ajaran_id', Crypt::decrypt($tahun_ajaran))
            ->first();
        $siswa = Siswa::findOrFail($detail->siswa_id);
        $tahun_ajaran = TahunAjaran::findOrFail($detail->tahun_ajaran_id);
        $kelas = Kelas::with('jurusan')->find($detail->kelas_id);
        $all_kelas = Kelas::with('jurusan')->get();
        $all_ta = TahunAjaran::orderBy('mulai', 'desc')->get();
        return view('administrator.reg-siswa.edit', compact([
            'siswa', 'kelas', 'tahun_ajaran',
            'all_kelas', 'all_ta'
        ]));
    }

    public function update(Request $request, $siswa, $tahun_ajaran) {
        $detail = SiswaDetail::where('siswa_id', Crypt::decrypt($siswa))
            ->where('tahun_ajaran_id', Crypt::decrypt($tahun_ajaran))
            ->first();
        $detail->siswa_id = Crypt::decrypt($siswa);
        $detail->kelas_id = $request->kelas;
        $detail->tahun_ajaran_id = $request->tahun_ajaran;
        $detail->save();

        return redirect()->route('registration-siswa.index')->with('status', 'Data successfully changed...');
    }
}
