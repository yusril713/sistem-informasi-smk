@extends('layouts.admin')
@section('title')
    Struktur Organisasi
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-struktur-organisasi.index') }}">Tambah Struktur Organisasi</a> <
                        <a href="#"><u>Tambah Struktur Organisasi</u></a>
                    </div>
                    <div class="card-body">
                        @can('manage-struktur-organisasi.update')
                        <form action="{{ route('manage-struktur-organisasi.update', [Crypt::encrypt($so->id)]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="" class="form-control" value="{{ $so->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Ajaran</label>
                                <select name="tahun_ajaran" id="" class="form-control">
                                    @foreach ($ta as $item)
                                        <option value="{{ $item->i }}" {{ $so->tahun_ajaran_id == $item->id ? 'selected' : '' }}>{{ $item->mulai }} - {{ $item->sampai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Konten</label>
                                <textarea name="konten" id="konten" cols="30" rows="10" class="form-control">{{ $so->konten }}</textarea>
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
</div>
@endsection
