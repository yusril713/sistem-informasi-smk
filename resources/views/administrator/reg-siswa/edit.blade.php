@extends('layouts.admin')
@section('title')
    Edit Kelas Siswa
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('registration-siswa.index') }}">Data Siswa</a> <
                        <a href="#"><u>Edit Kelas Siswa</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('registration-siswa.update')
                    <form action="{{ route('registration-siswa.update', [
                        Crypt::encrypt($siswa->id),
                        Crypt::encrypt($tahun_ajaran->id)
                    ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">No Induk Siswa</label>
                            <input type="text" name="no_induk" id="" class="form-control" value="{{ $siswa->no_induk }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Siswa</label>
                            <input type="text" name="nama" id="" class="form-control" value="{{ $siswa->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jurusan, Kelas</label>
                            <select name="kelas" id="" class="form-control">
                                @foreach ($all_kelas as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $kelas->id ? 'selected' : '' }}>{{ $item->jurusan->jurusan }}, {{ $item->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Ajaran</label>
                            <select name="tahun_ajaran" id="" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($all_ta as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $tahun_ajaran->id ? 'selected' : '' }}>{{ $item->mulai }} - {{ $item->sampai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    @else
                    @include('layouts.alert')
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
