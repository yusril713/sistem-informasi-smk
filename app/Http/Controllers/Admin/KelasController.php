<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    public function index() {
        return view('administrator.kelas.index', [
            'kelas' => Kelas::with('jurusan')->orderBy('jurusan_id')->get()
        ]);
        // return Kelas::with('jurusan')->get();
    }

    public function create() {
        return view('administrator.kelas.create', [
            'jurusan' => Jurusan::all()
        ]);
    }

    public function store(Request $request) {
        $kelas = new Kelas();
        $kelas->jurusan_id = $request->jurusan;
        $kelas->kelas = $request->kelas;
        $kelas->save();
        return redirect()->route('manage-kelas.index')->with('status', 'Data successfully created...');
    }

    public function edit($id) {
        return view('administrator.kelas.edit', [
            'kelas' => Kelas::with('jurusan')->where('id', Crypt::decrypt($id))->first(),
            'jurusan' => Jurusan::all()
        ]);
    }

    public function update(Request $request, $id) {
        $kelas = Kelas::findOrFail(Crypt::decrypt($id));
        $kelas->jurusan_id = $request->jurusan;
        $kelas->kelas = $request->kelas;
        $kelas->save();
        return redirect()->route('manage-kelas.index')->with('status', 'Data successfully changed...');
    }

    public function destroy($id) {
        Kelas::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-kelas.index')->with('status', 'Data successfully removed...');
    }
}
