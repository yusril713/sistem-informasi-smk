@extends('layouts.admin')
@section('title')
    TaEditmbah Kontak
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="card-header">
                        <a href="{{route('manage-kontak.index')}}">Manage Kontak</a> <
                        <a href="#"><u>Edit Kontak</u></a>
                    </div>
                    <hr>
                    @can('manage-kontak.update')
                    <form action="{{ route('manage-kontak.update', [Crypt::encrypt($kontak->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Konten</label>
                            <textarea id="konten" class="" name="konten" rows="10" cols="50">{{ $kontak->konten }}</textarea>
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
