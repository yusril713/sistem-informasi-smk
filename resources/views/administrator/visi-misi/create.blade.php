@extends('layouts.admin')
@section('title')
    Tambah Visi Misi
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="card-header">
                        <a href="{{route('manage-visimisi.index')}}">Manage Visi Misi</a> <
                        <a href="#"><u>Tambah Visi Misi</u></a>
                    </div>
                    <hr>
                    @can('manage-visimisi.store')
                    <form action="{{ route('manage-visimisi.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Sambutan</label>
                            <textarea id="konten" class="" name="konten" rows="10" cols="50"></textarea>
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
