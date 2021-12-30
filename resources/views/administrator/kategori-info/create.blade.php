@extends('layouts.admin')
@section('title')
    Kategori
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{ route('manage-kategori.index') }}">Manage Kategori</a> <
                        <a href="#"><u>Tambah Kategori</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-kategori.store')
                    <form action="{{ route('manage-kategori.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Slug</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3">{{ URL::to('/') }}/</span>
                                </div>
                                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('slug') }}" placeholder="Masukkan slug...">
                            </div>
                            @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Informasi</label>
                            <input type="text" name="kategori" id="" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}" placeholder="Masukkan kategori informasi...">
                            @error('kategori')
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
