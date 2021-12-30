<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KontakController extends Controller
{
    public function index() {
        return view('administrator.kontak.index', [
            'kontak' => Kontak::all()
        ]);
    }

    public function create() {
        return view('administrator.kontak.create');
    }

    public function store(Request $request) {
        $kontak = new Kontak();
        $kontak->konten = $request->konten;
        $kontak->save();
        return redirect()->route('manage-kontak.index')->with('status', 'Data successfully created...');
    }

    public function edit($id) {
        return view('administrator.kontak.edit', [
            'kontak' => Kontak::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $kontak = Kontak::findOrFail(Crypt::decrypt($id));
        $kontak->konten = $request->konten;
        $kontak->save();
        return redirect()->route('manage-kontak.index')->with('status', 'Data successfully changed...');
    }

    public function destroy($id) {
        Kontak::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-kontak.index')->with('status', 'Data successfully changed...');
    }
}
