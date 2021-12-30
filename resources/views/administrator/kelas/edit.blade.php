@extends('layouts.admin')
@section('title')
    Kelas
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-kelas.index') }}">Manage Kelas</a> <
                        <a href="#"><u>Edit Kelas</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-kelas.update')
                    <form action="{{ route('manage-kelas.update', [Crypt::encrypt($kelas->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Jurusan</label>
                            <select name="jurusan" id="" class="form-control" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->id }}" {{ ($kelas->jurusan->id == $item->id) ? 'selected' : '' }}>{{ $item->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <input type="text" name="kelas" id="" class="form-control" value="{{ $kelas->kelas }}" placeholder="Masukkan kelas..." required>
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

