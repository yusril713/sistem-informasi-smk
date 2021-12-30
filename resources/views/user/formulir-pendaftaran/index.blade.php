@extends('layouts.global')
@section('title')
FORMULIR PPDB ONLINE
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="container">
      <h2>FORMULIR PPDB ONLINE</h2>
      <p>SMK PGRI 2 WONOGIRI</p>
    </div>
</div>
<section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('formulir-pendaftaran.store') }}" method="post">
                    @csrf
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan alamat email anda...">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap anda...">
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" id="" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin' == 'L' ? 'selecter' : '') }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin' == 'L' ? 'selecter' : '') }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Alamat<span class="text-danger">*</span></label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Masukkan nama orang tua anda...">
                            @error('alamat')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Nama Orang Tua <span class="text-danger">*</span></label>
                            <input type="text" name="nama_orang_tua" class="form-control @error('nama_orang_tua') is-invalid @enderror" value="{{ old('nama_orang_tua') }}" placeholder="Masukkan nama orang tua anda...">
                            @error('nama_orang_tua')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Asal Sekolah <span class="text-danger">*</span></label>
                            <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}" placeholder="Masukkan asal sekolah anda...">
                            @error('asal_sekolah')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">No Hp <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Masukkan nama telp anda...">
                            @error('no_hp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Jurusan yang Dipilih <span class="text-danger">*</span></label>
                            <select name="jurusan" id="" class="form-control @error('jurusan') is-invalid @enderror">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->jurusan }}" {{ old('jurusan' == $item->jurusan ? 'selecter' : '') }}>{{ $item->jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="form-group">
                            <label for="">Nama yang memberikan informasi kepada anda  <span class="text-danger">*</span></label>
                            <input type="text" name="nama_informan" class="form-control @error('nama_informan') is-invalid @enderror" value="{{ old('nama_informan') }}" placeholder="Masukkan nama informan anda...">
                            @error('nama_informan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="get-started-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
