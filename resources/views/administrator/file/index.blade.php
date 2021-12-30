@extends('layouts.admin')
@section('title')
    {{ $kategori->kategori }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage {{ $kategori->kategori }}</u></a></div>
                    <div class="card-body">
                        @can('manage-file.index')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-file.create', [$kategori->slug]) }}" class="btn btn-primary">Tambah</a>
                        </div>
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <th>Katagori</th>
                                <th>File</th>
                                @role('Super Admin|Admin')
                                <th>Publisher</th>
                                @endrole
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($file as $item)
                                        <tr>
                                            <td>{{ $kategori->kategori }}</td>
                                            <td><a href="{{ asset('storage/' . $item->file) }}">{{ $item->title }}</a></td>
                                            @role('Super Admin|Admin')
                                            <td>{{ $item->user ? $item->user->name : '-' }}</td>
                                            @endrole
                                            <td style="white-space: nowrap">
                                                @can('manage-file.edit')
                                                <a href="{{ route('manage-file.edit', [$kategori->slug, Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @endcan
                                                @can('manage-file.destroy')
                                                <form action="{{ route('manage-file.destroy', [$kategori->slug, Crypt::encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Aye you sure want to remove this data?')" method="post">
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
