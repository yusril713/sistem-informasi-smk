@extends('layouts.admin')
@section('title')
    {{ Auth::user()->name }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}" alt="" class="img-fluid" width="150">
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('account.edit-photo') }}">Ganti</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('account.update', [Crypt::encrypt($data->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="role" value="{{ $role }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ ($role == 'Admin' or $role == 'siswa') ? '*NIP' :  '*No Induk'}}</label>
                                    <input type="text" name="no_induk" id="" class="form-control @error('no_induk') is-invalid @enderror" value="{{ ($role=='Admin' or $role == 'Guru') ? $data->nip : $data->no_induk }}" placeholder="Masukkan no induk data..." readonly>
                                    @error('no_induk')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Nama</label>
                                    <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" value="{{ $data->nama }}" placeholder="Masukkan nama data...">
                                    @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        <option value="L" {{ ($data->jenis_kelamin == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ ($data->jenis_kelamin == 'P') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ $data->tempat_lahir }}" placeholder="Masukkan tempat lahir">
                                    @error('tempat_lahir')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Tanggal Lahir</label>
                                    <div class="row">
                                        @php
                                            $now = getDate();
                                            $year = $now['year'];
                                            $year_start = $year - 80;
                                            $date_start = 1;
                                            $date_end = 31;
                                            $month = [
                                                'Januari', 'Februari', 'Maret',
                                                'April', 'Mei', 'Juni',
                                                'Juli', 'Agustus', 'September',
                                                'Oktober', 'November', 'Desember',
                                            ];
                                        @endphp
                                        <div class="col-md-4">
                                            <select name="tanggal" id="" class="form-control @error('tanggal') is-invalid @enderror">
                                                <option value="">Tanggal</option>
                                                @for ($i = $date_start; $i <= $date_end; $i++)
                                                    <option value="{{ $i }}" {{ (Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal_lahir)->format('d') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="bulan" id="" class="form-control @error('bulan') is-invalid @enderror">
                                                <option value="">Bulan</option>
                                                @for ($i = 0; $i < sizeof($month); $i++)
                                                    <option value="{{ ($i+1) }}" {{ (Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal_lahir)->format('m') == ($i+1)) ? 'selected' : ''}}>{{ $month[$i] }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="tahun" id="" class="form-control @error('tahun') is-invalid @enderror">
                                                <option value="">Tahun</option>
                                                @for ($i = $year; $i >= $year_start; $i--)
                                                    <option value="{{ $i }}" {{ (Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal_lahir)->format('Y') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Agama</label>
                                    <input type="text" name="agama" id="" class="form-control @error('agama') is-invalid @enderror" value="{{ $data->agama }}" placeholder="Masukkan agama data...">
                                    @error('agama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*No Hp</label>
                                    <input type="text" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $data->no_hp }}" name="no_hp" placeholder="Masukkan no hp aktif....">
                                    @error('no_hp')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Alamat</label>
                                    <textarea name="alamat" rows="1" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap">{{ $data->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">RT/RW</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" id="rt" class="form-control" name="rt" placeholder="RT" value="{{ $data->rt }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="rw" class="form-control" name="rw" placeholder="RW" value="{{ $data->rw }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <input type="text" name="kelurahan" id="" class="form-control" placeholder="Masukkan kelurahan..." value="{{ $data->kelurahan }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="" class="form-control" placeholder="Masukkan kecamatan..." value="{{ $data->kecamatan }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <input type="text" name="kabupaten" id="" class="form-control" placeholder="Masukkan kabupaten..." value="{{ $data->kabupaten }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
