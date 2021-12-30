<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GaleriController extends Controller
{
    public function index(Request $request) {
        if ($request->user()->hasRole('Super Admin') or $request->user()->hasRole('Admin')) {
            $galeri = Galeri::with('user')->get();
        } else {
           $galeri = Galeri::where('user_id', Auth::user()->id);
        }
        return view('administrator.galeri.index', [
            'galeri' => $galeri
        ]);
    }

    public function create() {
        return view('administrator.galeri.create');
    }

    public function store(Request $request) {
        $galeri = new Galeri();
        $galeri->title = $request->title;
        $galeri->user_id = Auth::user()->id;
        $galeri->jenis = $request->jenis;
        if ($request->jenis == 'foto') {
            if($request->hasfile('link')) {
                $file = $request->file('link')->store('galeri/foto', 'public');
                $galeri->link = $file;
            }
        } else {
            $galeri->link = 'https://www.youtube.com/embed/' . $request->link;
        }
        $galeri->save();

        return redirect()->route('manage-galeri.index')->with('status', 'Galery successfully created...');
    }

    public function edit($id) {
        return view('administrator.galeri.edit', [
            'galeri' => Galeri::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $galeri = Galeri::findOrFail(Crypt::decrypt($id));
        $galeri->title = $request->title;
        $galeri->jenis = $request->jenis;
        if ($request->jenis == 'foto') {
            if($request->hasfile('link')) {
                unlink(storage_path('app/public/' . $galeri->link));
                $file = $request->file('link')->store('galeri/foto', 'public');
                $galeri->link = $file;
            }
        } else {
            $galeri->link = 'https://www.youtube.com/embed/' . $request->link;
        }
        $galeri->save();

        return redirect()->route('manage-galeri.index')->with('status', 'Galery successfully changed...');
    }

    public function destroy($id) {
        $galeri = Galeri::findOrFail(Crypt::decrypt($id));
        if($galeri->jenis == 'foto')
            unlink(storage_path('app/public/' . $galeri->link));
        $galeri->delete();
        return redirect()->route('manage-galeri.index')->with('status', 'Galery successfully removed...');
    }
}
