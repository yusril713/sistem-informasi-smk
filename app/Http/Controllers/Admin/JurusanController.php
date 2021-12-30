<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class JurusanController extends Controller
{
    public function index() {
        return view('administrator.jurusan.index', [
            'jurusan' => Jurusan::all()
        ]);
    }

    public function create() {
        return view('administrator.jurusan.create');
    }

    public function store(Request $request) {
        $jurusan = new Jurusan();
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();
        return redirect()->route('manage-jurusan.index')->with('status', 'Data successfully created...');
    }

    public function edit($id) {
        return view('administrator.jurusan.edit', [
            'jurusan' => Jurusan::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $jurusan = Jurusan::findOrFail(Crypt::decrypt($id));
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();
        return redirect()->route('manage-jurusan.index')->with('status', 'Data successfully changed...');
    }

    public function destroy($id) {
        Jurusan::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-jurusan.index')->with('status', 'Data successfully removed...');
    }
}
