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
                        <a href="#"><u>Tambah Kelas</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-kelas.store')
                    <form action="{{ route('manage-kelas.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Jurusan</label>
                            <select name="jurusan" id="" class="form-control" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <input type="text" name="kelas" id="" class="form-control" placeholder="Masukkan kelas..." required>
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

