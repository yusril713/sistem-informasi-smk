@extends('layouts.admin')
@section('title')
    Jurusan
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-jurusan.index') }}">Manage Jurusan</a> <
                        <a href="#"><u>Edit Jurusan</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-jurusan.index')
                    <form action="{{ route('manage-jurusan.update', [Crypt::encrypt($jurusan->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Tahun Ajaran</label>
                            <input type="text" name="jurusan" id="" class="form-control" placeholder="Masukkan jurusan" value="{{ $jurusan->jurusan }}" required>
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

