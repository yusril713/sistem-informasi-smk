<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VisiMisiController extends Controller
{
    public function index() {
        return view('administrator.visi-misi.index', [
            'vm' => VisiMisi::all()
        ]);
    }

    public function create() {
        return view('administrator.visi-misi.create');
    }

    public function store(Request $request) {
        $vm = new VisiMisi();
        $vm->title = $request->title;
        $vm->konten = $request->konten;
        $vm->save();
        return redirect()->route('manage-visimisi.index')->with('status', 'Data successfully created');
    }

    public function edit($id) {
        return view('administrator.visi-misi.edit', [
            'vm' => VisiMisi::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $vm = VisiMisi::findOrFail(Crypt::decrypt($id));
        $vm->title = $request->title;
        $vm->konten = $request->konten;
        $vm->save();
        return redirect()->route('manage-visimisi.index')->with('status', 'Data successfully changed');
    }

    public function destroy($id) {
        VisiMisi::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-visimisi.index')->with('status', 'Data successfully removed');
    }
}
