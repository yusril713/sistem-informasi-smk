@extends('layouts.admin')
@section('title')
    Profil SMKS PGRI 2
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-profil.index') }}">Manage Profil</a> <
                        <a href="#"><u>Tambah Profil</u></a>
                    </div>
                    <div class="card-body">
                        @can('manage-profil.store')
                        <form action="{{ route('manage-profil.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Konten</label>
                                <textarea name="konten" id="konten" cols="30" rows="10"></textarea>
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
