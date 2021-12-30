<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InformasiController extends Controller
{
    public function index($slug, Request $request) {
        if ($request->user()->hasRole('Super Admin') or $request->user()->hasRole('Admin')) {
            $kategori = KategoriInformasi::where('slug', $slug)->firstOrFail();
            $info = $kategori->informasi()->with('user')->get();
        } else {
            $kategori = KategoriInformasi::where('slug', $slug)->firstOrFail();
            $info = $kategori->informasi()->where('user_id', Auth::user()->id)->get();
        }
        return view('administrator.informasi.index', [
            'kategori' => $kategori,
            'info' => $info
        ]);
    }

    public function create($slug) {
        return view('administrator.informasi.create', [
            'kategori' => KategoriInformasi::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function store(Request $request, $slug) {
        $request->validate([
            'title' => 'required|max:255|min:5',
            'slug' => 'required|min:5|max:255|unique:tb_informasi|regex:/^\S*$/u',
            'cover' => 'required',
            'konten' => 'required|min:30|max:4294967295',
            'publisher'
        ]);

        $info = new Informasi();
        $info->kategori_id = $request->kategori_id;
        $info->user_id = Auth::user()->id;
        $info->title = $request->title;
        $info->slug = $request->slug;
        $info->publisher = $request->publisher;
        $info->konten = $request->konten;

        if($request->hasfile('cover')) {
            $file = $request->file('cover')->store($slug, 'public');
            $info->cover = $file;
        }
        $info->save();
        return redirect()->route('manage-informasi.index', [$slug])->with('status', 'Data successfully created');
    }

    public function show($slug, $id) {
        return view('administrator.informasi.show', [
            'kategori' => KategoriInformasi::where('slug', $slug)->firstOrFail(),
            'informasi' => Informasi::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function edit($slug, $id) {
        return view('administrator.informasi.edit', [
            'kategori' => KategoriInformasi::where('slug', $slug)->firstOrFail(),
            'informasi' => Informasi::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $slug, $id) {
        $info = Informasi::findOrFail(Crypt::decrypt($id));
        $info->kategori_id = $request->kategori_id;
        $info->title = $request->title;
        $info->slug = $request->slug;
        $info->publisher = $request->publisher;
        $info->konten = $request->konten;

        if($request->hasfile('cover')) {
            unlink(storage_path('app/public/' . $info->cover));
            $file = $request->file('cover')->store($slug, 'public');
            $info->cover = $file;
        }
        $info->save();
        return redirect()->route('manage-informasi.index', [$slug])->with('status', 'Data successfully changed');
    }

    public function destroy($slug, $id) {
        $info = Informasi::findOrFail(Crypt::decrypt($id));
        unlink(storage_path('app/public/' . $info->cover));
        $info->delete();
        return redirect()->route('manage-informasi.index', [$slug])->with('status', 'Data successfully removed...');
    }
}
