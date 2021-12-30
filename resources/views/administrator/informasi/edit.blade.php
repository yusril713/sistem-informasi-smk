@extends('layouts.admin')
@section('title')
    Edit {{ $kategori->kategori }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{ route('manage-informasi.index', [$kategori->slug]) }}">Manage {{ $kategori->kategori }}</a> <
                        <a href="#"><u>Edit {{ $kategori->kategori }}</u></a>
                    </div>
                    <div class="card-body">
                        @can('manage-informasi.update')
                        <form action="{{ route('manage-informasi.update', [$kategori->slug, Crypt::encrypt($informasi->id)]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="" class="form-control" value="{{ $informasi->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Slug</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon3">{{ URL::to('/') }}/{{ $kategori->slug }}/</span>
                                    </div>
                                    <input type="text" name="slug" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $informasi->slug }}" placeholder="Masukkan slug...">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Cover</label>
                                <img src="{{ asset('storage/' . $informasi->cover) }}" alt="" class="img-fluid">
                                <input type="file" name="cover" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Publisher</label>
                                <input type="text" name="publisher" id="" class="form-control @error('publisher') is-invalid @enderror" value="{{ $informasi->publisher }}">
                            </div>
                            <div class="form-group">
                                <label for="">Konten</label>
                                <textarea name="konten" id="konten" cols="30" rows="10">{{ $informasi->konten }}</textarea>
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
