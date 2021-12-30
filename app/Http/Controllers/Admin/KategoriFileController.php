<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KategoriFileController extends Controller
{
    public function index() {
        return view('administrator.kategori-file.index', [
            'kategori' => KategoriFile::all()
        ]);
    }

    public function create() {
        return view('administrator.kategori-file.create');
    }

    public function store(Request $request) {
        $request->validate([
            'slug' => 'required|unique:tb_kategori_file',
            'kategori' => 'required'
        ]);
        $kategori = new KategoriFile();
        $kategori->slug = $request->slug;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return redirect()->route('manage-kategori-file.index')->with('status', 'Kategori successfully added...');
    }

    public function edit($id) {
        $kategori = KategoriFile::findOrFail(Crypt::decrypt($id));
        return view('administrator.kategori-file.edit', ['kategori' => $kategori]);
    }

    public function update(Request $request, $id) {
        $kategori = KategoriFile::findOrFail(Crypt::decrypt($id));
        $kategori->slug = $request->slug;
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return redirect()->route('manage-kategori-file.index')->with('status', 'Kategori successfully changed...');
    }

    public function destroy($id) {
        $kategori = KategoriFile::findOrFail(Crypt::decrypt($id));
        $kategori->delete();
        return redirect()->route('manage-kategori-file.index')->with('status', 'Kategori successfully removed...');
    }
}
