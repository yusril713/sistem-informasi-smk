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
                    <div class="card-header"><a href="#"><u>Manage Profil</u></a></div>
                    <div class="card-body">
                        @can('manage-profil.index')
                        @can('manage-profil.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-profil.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach ($profil as $item)
                            <a href="">{{$item->title}}</a>
                            {!! $item->konten !!}
                            <footer>
                                <div class="d-flex justify-content-end">
                                    @can('manage-profil.edit')
                                    <a href="{{ route('manage-profil.edit', [Crypt::encrypt($item->id)]) }}" class="badge badge-success">Edit</a>
                                    @endcan
                                    @can('manage-profil.destroy')
                                    <form action="{{ route('manage-profil.destroy', [Crypt::encrypt($item->id)]   ) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to remove this data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge badge-danger">Hapus</button>
                                    </form>
                                    @endcan
                                </div>
                            </footer>
                        @endforeach
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
