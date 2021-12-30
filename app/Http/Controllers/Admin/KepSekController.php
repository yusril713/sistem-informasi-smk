<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sambutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KepSekController extends Controller
{
    public function index() {
        return view('administrator.kepsek.index', [
            'sambutan' => Sambutan::all()
        ]);
    }

    public function create() {
        return view('administrator.kepsek.create');
    }

    public function store(Request $request) {
        $sambutan = new Sambutan();
        $sambutan->title = "Sambutan Kepala Sekolah";
        $sambutan->konten = $request->konten;
        $sambutan->save();
        return redirect()->route('manage-sambutan.index')->with('status', 'Data successfully created...');
    }

    public function edit($id) {
        return view('administrator.kepsek.edit', [
            'sambutan' => Sambutan::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $sambutan = Sambutan::findOrFail(Crypt::decrypt($id));
        $sambutan->title = "Sambutan Kepala Sekolah";
        $sambutan->konten = $request->konten;
        $sambutan->save();
        return redirect()->route('manage-sambutan.index')->with('status', 'Data successfully changed...');
    }

    public function destroy($id) {
        Sambutan::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-sambutan.index')->with('status', 'Data successfully removed...');
    }
}
