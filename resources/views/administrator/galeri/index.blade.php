@extends('layouts.admin')
@section('title')
    Galeri
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Galeri</u></a></div>
                    <div class="card-body">
                        @can('manage-galeri.index')
                        @can('manage-galeri.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-galeri.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Title</th>
                                @role('Super Admin|Admin')
                                <th>Publisher</th>
                                @endrole
                                <th>Konten</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($galeri as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>{{ $item->title }}</td>
                                            @role('Super Admin|Admin')
                                            <td>{{ $item->user ? $item->user->name : '-' }}</td>
                                            @endrole
                                            <td>
                                                @if ($item->jenis == 'foto')
                                                    <img src="{{ asset('storage/' . $item->link) }}" class="img-fluid" width="200">
                                                @else
                                                    <div class='embed-responsive embed-responsive-16by9'>
                                                    <iframe class="embed-responsive-item" src='{{ $item->link }}' frameborder='0' allowfullscreen></iframe></div>
                                                @endif
                                            </td>
                                            <td>
                                                @can('manage-galeri.edit')
                                                <a href="{{ route('manage-galeri.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @endcan
                                                @can('manage-galeri.destroy')
                                                <form action="{{ route('manage-galeri.destroy', [Crypt::encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Aye you sure want to remove this data?')" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
