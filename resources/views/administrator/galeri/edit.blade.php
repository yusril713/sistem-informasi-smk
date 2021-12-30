@extends('layouts.admin')
@section('title')
    Tambah Galeri
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-galeri.index') }}">Manage Galeri</a> <
                        <a href="#"><u>Tambah Galeri</u></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-top: 20px">
                <div class="card card-body">
                    @can('manage-galeri.update')
                    <form action="{{ route('manage-galeri.update', [Crypt::encrypt($galeri->id)]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control" value="{{ $galeri->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis</label>
                            <input type="text" name="jenis" class="form-control" value="{{ $galeri->jenis }}" readonly>
                        </div>
                        <div class="form-group">
                            @if ($galeri->jenis == 'foto')
                                <label for="">Gambar</label>
                                <img src="{{ asset('storage/' . $galeri->link) }}" class="img-fluid">
                                <input type="file" name="link" id="" class="form-control" >
                            @else
                                <label for="">Link Video</label>
                                <div class='embed-responsive embed-responsive-16by9'>
                                    <iframe class="embed-responsive-item" src='{{ $galeri->link }}' frameborder='0' allowfullscreen></iframe>
                                </div>
                                <input type="text" name="link" id="" class="form-control" value="{{ str_replace("https://www.youtube.com/embed/", "", $galeri->link) }}">
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    @else
                    @include('alert')
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
