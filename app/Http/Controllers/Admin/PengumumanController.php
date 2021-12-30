<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PengumumanController extends Controller
{
    public function index() {
        return view('administrator.pengumuman.index', [
            'pengumuman' => Pengumuman::orderByRaw('FIELD(status, "aktif", "nonaktif")')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create() {
        return view('administrator.pengumuman.create');
    }

    public function store(Request $request) {
        $pengumuman = new Pengumuman();
        $pengumuman->pengumuman = $request->pengumuman;
        $pengumuman->status = $request->status;
        $pengumuman->save();
        return redirect()->route('manage-pengumuman.index')->with('status', 'Announcement successfully created and will be display on main page...');
    }

    public function edit($id) {
        return view('administrator.pengumuman.edit', [
            'pengumuman' => Pengumuman::findOrFail(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id) {
        $pengumuman = Pengumuman::findOrFail(Crypt::decrypt($id));
        $pengumuman->pengumuman = $request->pengumuman;
        $pengumuman->status = $request->status;
        $pengumuman->save();
        return redirect()->route('manage-pengumuman.index')->with('status', 'Announcement successfully changed...');
    }

    public function activate(Request $request, $id) {
        $pengumuman = Pengumuman::findOrFail(Crypt::decrypt($id));
        $pengumuman->status = $request->status;
        $pengumuman->save();
        return redirect()->route('manage-pengumuman.index')->with('status', 'Announcement successfully changed...');
    }

    public function destroy($id) {
        Pengumuman::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-pengumuman.index')->with('status', 'Announcement successfully removed...');
    }
}
