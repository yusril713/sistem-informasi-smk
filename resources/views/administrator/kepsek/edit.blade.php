@extends('layouts.admin')
@section('title')
    Edit Sambutan
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="card-header">
                        <a href="{{route('manage-sambutan.index')}}">Manage Sambutan</a> <
                        <a href="#"><u>Edit Sambutan</u></a>
                    </div>
                    <hr>
                    @can('manage-sambutan.update')
                    <form action="{{ route('manage-sambutan.update', [Crypt::encrypt($sambutan->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control" value="{{ $sambutan->title }}">
                        </div>
                        <div class="form-group">
                            <label for="">Sambutan</label>
                            <textarea id="konten" class="form-control" name="konten" rows="10" cols="50">{{ $sambutan->konten }}</textarea>
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
