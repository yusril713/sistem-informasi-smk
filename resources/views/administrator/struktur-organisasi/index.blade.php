@extends('layouts.admin')
@section('title')
    Struktur Organisasi
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Struktur Organisasi</u></a></div>
                    <div class="card-body">
                        @can('manage-struktur-organisasi.index')
                        @can('manage-struktur-organisasi.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-struktur-organisasi.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            @foreach ($so as $item)
                                <div class="d-flex justify-content-end">
                                    @if ($item->status == 'Aktif')
                                        <span class="mdi mdi-check badge badge-success">Aktif</span>
                                    @endif
                                </div>
                                <a href="">{{$item->title}}</a>
                                {!! $item->konten !!}
                                <footer>
                                    <div class="d-flex justify-content-end">
                                        @can('manage-struktur-organisasi.activate')
                                        <form action="{{ route('manage-struktur-organisasi.activate', [Crypt::encrypt($item->id)]) }}" method="post" onsubmit="return confirm('Are you sure want to activate this Struktur Organisasi?')" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="badge badge-primary">Activate</button>
                                        </form>
                                        @endcan
                                        @can('manage-struktur-organisasi.edit')
                                        <a href="{{ route('manage-struktur-organisasi.edit', [Crypt::encrypt($item->id)]) }}" class="badge badge-success">Edit</a>
                                        @endcan
                                        @can('manage-struktur-organisasi.destroy')
                                        <form action="{{ route('manage-struktur-organisasi.destroy', [Crypt::encrypt($item->id)]   ) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to remove this data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-danger">Hapus</button>
                                        </form>
                                        @endcan
                                    </div>
                                </footer>
                            @endforeach
                        </div>
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
