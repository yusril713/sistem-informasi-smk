<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\KategoriFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FileController extends Controller
{
    public function index($slug, Request $request) {
        if ($request->user()->hasRole('Super Admin') or $request->user()->hasRole('Admin')) {
            $kategori = KategoriFile::where('slug', $slug)->firstOrFail();
            $file = $kategori->file()->with('user')->get();
        } else {
            $kategori = KategoriFile::where('slug', $slug)->firstOrFail();
            $file = $kategori->file()->where('user_id', Auth::user()->id)->get();
        }
        return view('administrator.file.index', [
            'kategori' => $kategori,
            'file' => $file
        ]);
    }

    public function create($slug) {
        return view('administrator.file.create', [
            'kategori' => KategoriFile::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function store(Request $request, $slug) {
        $request->validate([
            'slug' => 'required|unique:tb_file',
            'title' => 'required',
            'file' => 'required'
        ]);
        $f = new File();
        $f->title = $request->title;
        $f->kategori_id = $request->kategori_id;
        $f->slug = $request->slug;
        $f->user_id = Auth::user()->id;
        if($request->hasfile('file')) {
            $file = $request->file('file')->store($slug, 'public');
            $f->file = $file;
        }
        $f->save();
        return redirect()->route('manage-file.index', [$slug])->with('status', 'Data successfully added...');
    }

    public function edit($slug, $id) {
        return view('administrator.file.edit',[
            'kategori' => KategoriFile::where('slug', $slug)->firstOrFail(),
            'file' => File::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $slug, $id) {
        $f = File::findOrFail(Crypt::decrypt($id));
        $f->title = $request->title;
        $f->kategori_id = $request->kategori_id;
        $f->slug = $request->slug;
        if($request->hasfile('file')) {
            unlink(storage_path('app/public/' . $f->file));
            $file = $request->file('file')->store($slug, 'public');
            $f->file = $file;
        }
        $f->save();
        return redirect()->route('manage-file.index', [$slug])->with('status', 'Data successfully changed...');
    }

    public function destroy($slug, $id) {
        $f = File::findOrFail(Crypt::decrypt($id));
        if(file_exists(storage_path('app/public/'. $f->file)))
            unlink(storage_path('app/public/' . $f->file));
        $f->delete();
        return redirect()->route('manage-file.index', [$slug])->with('status', 'Data successfully removed...');
    }
}
