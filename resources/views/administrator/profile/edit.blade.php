@extends('layouts.admin')
@section('title')
    Edit SMKS PGRI 2
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-profil.index') }}">Manage Profil</a> <
                        <a href="#"><u>Edit Profil</u></a>
                    </div>
                    <div class="card-body">
                        @can('manage-profil.update')
                        <form action="{{ route('manage-profil.update', [Crypt::encrypt($profil->id)]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="" class="form-control" value="{{ $profil->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Konten</label>
                                <textarea name="konten" id="konten" cols="30" rows="10">{{ $profil->konten }}</textarea>
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
