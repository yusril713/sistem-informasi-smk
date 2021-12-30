<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KategoriInformasiController extends Controller
{
    public function index() {
        return view('administrator.kategori-info.index', [
            'kategori' => KategoriInformasi::all()
        ]);
    }

    public function create() {
        return view('administrator.kategori-info.create');
    }

    public function store(Request $request) {
        $request->validate([
            'slug' => 'required|unique:tb_kategori_info',
            'kategori' => 'required'
        ]);
        $kategori = new KategoriInformasi();
        $kategori->slug = $request->slug;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return redirect()->route('manage-kategori.index')->with('status', 'Kategori successfully added...');
    }

    public function edit($id) {
        $kategori = KategoriInformasi::findOrFail(Crypt::decrypt($id));
        return view('administrator.kategori-info.edit', ['kategori' => $kategori]);
    }

    public function update(Request $request, $id) {
        $kategori = KategoriInformasi::findOrFail(Crypt::decrypt($id));
        $kategori->slug = $request->slug;
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return redirect()->route('manage-kategori.index')->with('status', 'Kategori successfully changed...');
    }

    public function destroy($id) {
        $kategori = KategoriInformasi::findOrFail(Crypt::decrypt($id));
        $kategori->delete();
        return redirect()->route('manage-kategori.index')->with('status', 'Kategori successfully removed...');
    }
}

