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
                    <div class="card-header"><a href="{{ route('manage-kategori-file.index') }}">Manage Kategori</a> <
                        <a href="#"><u>Tambah Kategori</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-kategori-file.update')
                    <form action="{{ route('manage-kategori-file.update', [Crypt::encrypt($kategori->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Slug</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3">{{ URL::to('/') }}/</span>
                                </div>
                                <input type="text" name="slug" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $kategori->slug }}" placeholder="Masukkan slug...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Informasi</label>
                            <input type="text" name="kategori" id="" class="form-control" value="{{ $kategori->kategori }}" placeholder="Masukkan kategori informasi...">
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
