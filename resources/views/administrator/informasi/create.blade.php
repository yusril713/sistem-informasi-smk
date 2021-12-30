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
                    <div class="card-header"><a href="{{ route('manage-informasi.index', [$kategori->slug]) }}">Manage {{ $kategori->kategori }}</a> <
                        <a href="#"><u>Tambah {{ $kategori->kategori }}</u></a>
                    </div>
                    <div class="card-body">
                        @can('manage-informasi.store')
                        <form action="{{ route('manage-informasi.store', [$kategori->slug]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                <label for="">Cover</label>
                                <input type="file" name="cover" id="" class="form-control @error('cover') is-invalid @enderror" value="{{ old('cover') }}">
                                @error('cover')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Publisher</label>
                                <input type="text" name="publisher" id="" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}">
                                @error('publisher')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Konten</label>
                                <textarea name="konten" class="@error('konten') is-invalid @enderror" id="konten" cols="30" rows="10">{{ old('konten') }}</textarea>
                                @error('konten')
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
</div>
@endsection
