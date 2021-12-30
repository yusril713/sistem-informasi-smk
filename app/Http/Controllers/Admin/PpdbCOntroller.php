<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use PDF;

class PpdbCOntroller extends Controller
{
    public function index() {
        $ta = TahunAjaran::all();
        $data = FormulirPendaftaran::where('tahun_ajaran_id', TahunAjaran::getId())->get();
        return view('administrator.ppdb.index', compact(['data', 'ta']));
    }

    public function find(Request $request) {
        if($request->ajax()) {
            $data = FormulirPendaftaran::where(function($q) use($request) {
                    $q->where('nama', 'like', '%' . $request->key . '%')
                        ->orWhere('email', 'like', '%' . $request->key . '%')
                        ->orWhere('alamat', 'like', '%' . $request->key . '%')
                        ->orWhere('nama_orang_tua', 'like', '%' . $request->key . '%')
                        ->orWhere('jurusan', 'like', '%' . $request->key . '%')
                        ->orWhere('asal_sekolah', 'like', '%' . $request->key . '%');

                })
                ->where('tahun_ajaran_id', $request->id)
                ->get();
            $count = count($data);
            return view('administrator.ppdb.data', compact(['data', 'count']))->render();
        }
    }

    public function print($id) {

    }

    public function MarkedPrint(Request $request) {
        $data = FormulirPendaftaran::whereIn('id', $request->ppdb_id)->get();
        $pdf = PDF::loadView('administrator.ppdb.multiple-print', compact('data'));
        return $pdf->setPaper('a4', 'landscape')->download('Formulir Pendaftaran.pdf');
    }
}
