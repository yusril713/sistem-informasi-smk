<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfilController extends Controller
{
    public function index() {
        return view('administrator.profile.index', [
            'profil' => Profil::all()
        ]);
    }

    public function create() {
        return view('administrator.profile.create');
    }

    public function store(Request $request) {
        $p = new Profil();
        $p->title = $request->title;
        $p->konten = $request->konten;
        $p->save();
        return redirect()->route('manage-profil.index')->with('status', 'Data successfully added...');
    }

    public function edit($id) {
        return view('administrator.profile.edit', [
            'profil' => Profil::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $p = Profil::findOrFail(Crypt::decrypt($id));
        $p->title = $request->title;
        $p->konten = $request->konten;
        $p->save();
        return redirect()->route('manage-profil.index')->with('status', 'Data successfully changed...');
    }

    public function destroy($id) {
        Profil::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-profil.index')->with('status', 'Data successfully removed...');
    }
}
