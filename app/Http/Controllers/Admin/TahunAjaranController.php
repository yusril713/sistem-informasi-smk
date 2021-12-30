<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TahunAjaranController extends Controller
{
    public function index() {
        return view('administrator.tahun-ajaran.index', [
            'ta' => TahunAjaran::all()
        ]);
    }

    public function create(){
        return view('administrator.tahun-ajaran.create');
    }

    public function store(Request $request){
        $ta = new TahunAjaran();
        $ta->mulai = $request->mulai;
        $ta->sampai = $request->sampai;
        $ta->status = TahunAjaran::TIDAK_AKTIF;
        $ta->save();
        return redirect()->route('manage-tahun-ajaran.index')->with('status', 'Data successfully created...');
    }

    public function edit($id) {
        return view('administrator.tahun-ajaran.edit', [
            'ta' => TahunAjaran::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $ta = TahunAjaran::findOrFail(Crypt::decrypt($id));
        $ta->mulai = $request->mulai;
        $ta->sampai = $request->sampai;
        $ta->status = TahunAjaran::TIDAK_AKTIF;
        $ta->save();
        return redirect()->route('manage-tahun-ajaran.index')->with('status', 'Data successfully changed...');
    }

    public function activate($id) {
        $ta_aktif = TahunAjaran::where('status', TahunAjaran::AKTIF)->first();
        if($ta_aktif){
            $ta_aktif->status = TahunAjaran::TIDAK_AKTIF;
            $ta_aktif->save();
        }

        $ta = TahunAjaran::findOrFail(Crypt::decrypt($id));
        $ta->status = TahunAjaran::AKTIF;
        $ta->save();
        return redirect()->route('manage-tahun-ajaran.index')->with('status', 'New "Tahun Ajaran ' . $ta->mulai . ' - ' . $ta->sampai . '" successfully activated...');
    }

    public function destroy($id) {
        TahunAjaran::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-tahun-ajaran.index')->with('status', 'Data successfully removed...');
    }
}
