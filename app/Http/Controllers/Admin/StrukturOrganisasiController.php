<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StrukturOrganisasiController extends Controller
{
    public function index() {
        return view('administrator.struktur-organisasi.index', [
            'so' => StrukturOrganisasi::orderByRaw('FIELD(status, "Aktif", "Nonaktif")')->get()
        ]);
    }

    public function create() {
        return view('administrator.struktur-organisasi.create', [
            'ta' => TahunAjaran::orderByRaw('FIELD(status, "Aktif", "Tidak Aktif")')->orderBy('mulai', 'desc')->get()
        ]);
    }

    public function store(Request $request) {
        $so = new StrukturOrganisasi();
        $so->title = $request->title;
        $so->tahun_ajaran_id = $request->tahun_ajaran;
        $so->konten = $request->konten;
        $so->save();

        return redirect()->route('manage-struktur-organisasi.index')->with('status', 'Data successfully created...');
    }

    public function edit($id) {
        return view('administrator.struktur-organisasi.edit', [
            'so' => StrukturOrganisasi::findOrFail(Crypt::decrypt($id)),
            'ta' => TahunAjaran::orderByRaw('FIELD(status, "Aktif", "Tidak Aktif")')->orderBy('mulai', 'desc')->get()
        ]);
    }

    public function update(Request $request, $id) {
        $so = StrukturOrganisasi::findOrFail(Crypt::decrypt($id));
        $so->title = $request->title;
        $so->tahun_ajaran_id = $request->tahun_ajaran;
        $so->konten = $request->konten;
        $so->save();

        return redirect()->route('manage-struktur-organisasi.index')->with('status', 'Data successfully changed...');
    }

    public function activate($id) {
        $active = StrukturOrganisasi::where('status', 'Aktif')->first();
        if ($active) {
            $active->status = 'Nonaktif';
            $active->save();
        }
        $so = StrukturOrganisasi::findOrFail(Crypt::decrypt($id));
        $so->status = 'Aktif';
        $so->save();
        return redirect()->route('manage-struktur-organisasi.index')->with('status', 'Data successfully activated...');
    }

    public function destroy($id) {
        StrukturOrganisasi::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-struktur-organisasi.index')->with('status', 'Data successfully removed...');
    }
}
