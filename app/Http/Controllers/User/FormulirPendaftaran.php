<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ppdbMail;
use App\Models\FormulirPendaftaran as ModelsFormulirPendaftaran;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormulirPendaftaran extends Controller
{
    public function index() {
        return view('user.formulir-pendaftaran.index', [
            'jurusan' => Jurusan::all()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email|min:5|unique:tb_formulir_pendaftaran',
            'nama' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'nama_orang_tua' => 'required|min:3',
            'asal_sekolah' => 'required|min:5',
            'no_hp' => 'required|',
            'jurusan' => 'required',
            'nama_informan' => 'required',
            'alamat'=> 'required'
        ]);

        $form = new ModelsFormulirPendaftaran();
        $form->email = $request->email;
        $form->nama = $request->nama;
        $form->jenis_kelamin = $request->jenis_kelamin;
        $form->nama_orang_tua = $request->nama_orang_tua;
        $form->alamat = $request->alamat;
        $form->asal_sekolah = $request->asal_sekolah;
        $form->no_hp = $request->no_hp;
        $form->jurusan = $request->jurusan;
        $form->nama_informan = $request->nama_informan;
        $form->tahun_ajaran_id = TahunAjaran::getId();
        $form->save();

        Mail::to($form->email)->cc(config('mail.from.address'))->queue(new ppdbMail($form));

        return redirect()->route('formulir-pendaftaran.index')->with('status', 'Data anda berhasil dikirim ke SMK PGRI 2 WONOGIRI');

    }
}
