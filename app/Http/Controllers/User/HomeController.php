<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\KontakMail;
use App\Models\File;
use App\Models\Galeri;
use App\Models\Informasi;
use App\Models\KategoriFile;
use App\Models\KategoriInformasi;
use App\Models\Kontak;
use App\Models\Profil;
use App\Models\Sambutan;
use App\Models\StrukturOrganisasi;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index() {
        return view('welcome', [
            'sambutan' => Sambutan::first(),
            'vm' => VisiMisi::all(),
            'kategori_informasi' => KategoriInformasi::with('limit')->get()
        ]);
    }

    public function profil() {
        return view('visitor.profil', [
            'profil' => Profil::first()
        ]);
    }

    public function struktur_organisasi() {
        return view('visitor.so', [
            'so' => StrukturOrganisasi::where('status', 'Aktif')->first()
        ]);
    }

    public function informasi($slug) {
        $kategori = KategoriInformasi::where('slug', $slug)->firstOrFail();
        $kategori->setRelation('informasi', $kategori->informasi()->orderBy('created_at', 'desc')->paginate(10));
        return view('visitor.informasi', [
            'kategori' => $kategori,
            'all' => Informasi::with('kategori')->orderBy('created_at', 'desc')->limit(10)->get()
        ]);

        // return $kategori;
    }

    public function detail($kategori, $slug) {
        return view('visitor.detail-informasi', [
            'informasi' => Informasi::with('kategori')->where('slug', $slug)->firstOrFail(),
            'all' => Informasi::with('kategori')->orderBy('created_at', 'desc')->limit(10)->get()
        ]);
    }

    public function download() {
        $kategori = KategoriFile::all();
        $data = File::with('kategori')->orderBy('created_at', 'desc')->get();
        return view('visitor.download', compact(['kategori', 'data']));
    }

    public function findDownload(Request $request) {
        if($request->ajax()) {

            $data = $request->id ? File::with('kategori')->where('kategori_id', $request->id)->orderBy('created_at', 'desc')->get() : File::with('kategori')->orderBy('created_at', 'desc')->get();;
            return view('visitor.data-download', compact('data'))->render();
        }
    }

    public function photos() {
        return view('visitor.galeri.foto', [
            'photo' => Galeri::where('jenis', 'foto')->get()
        ]);
    }

    public function videos() {
        return view('visitor.galeri.video', [
            'video' => Galeri::where('jenis', 'video')->get()
        ]);
    }

    public function kontak() {
        return view('visitor.kontak', [
            'kontak'=> Kontak::first(),
            'all' => Informasi::with('kategori')->orderBy('created_at', 'desc')->limit(10)->get()
        ]);
    }

    public function kontakPost(Request $request) {
        $data = [
            'nama' => $request->nama,
            'pesan' => $request->pesan,
            'email' => $request->email,
        ];
        Mail::to($request->email)->cc(config('mail.from.address'))->queue(new KontakMail($data));
        return redirect()->route('kontak.index')->with('status', 'Data berhasil disubmit');
        // return $data['nama'];
    }
}
