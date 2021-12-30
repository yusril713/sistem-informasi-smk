@extends('layouts.admin')
@section('title')
    Tambah {{ $kategori->kategori }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{ route('manage-file.index', [$kategori->slug]) }}">Manage {{ $kategori->kategori }}</a> <
                        <a href="#"><u>Tambah {{ $kategori->kategori }}</u></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-file.store')
                    <form action="{{ route('manage-file.store', [$kategori->slug]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                        <div class="form-group">
                            <label for="">Nama File</label>
                            <input type="text" name="title" id="" class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan nama file..." value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3">{{ URL::to('/') }}/{{ $kategori->slug }}/</span>
                                </div>
                                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('slug') }}" placeholder="Masukkan slug...">
                            </div>
                            @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">File</label>
                            <input type="file" name="file" id="" class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}">
                            @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
