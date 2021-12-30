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
                        @can('manage-informasi.index')
                        @can('manage-informasi.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-informasi.create', [$kategori->slug]) }}" class="btn btn-primary">Tambah</a>
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
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Publisher</th>
                                @role('Super Admin|Admin')
                                <th>User</th>
                                @endrole
                                <th>Tgl Post</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($info as $item)
                                        <tr>
                                            <td><img src="{{ asset('storage/'. $item->cover) }}" width="100" class="img-fluid"></td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->publisher }}</td>
                                            @role('Super Admin|Admin')
                                            <th>{{ $item->user ? $item->user->name : '-'}}</th>
                                            @endrole
                                            <td>{{ $item->updated_at->format('d M Y H:i:s') }}</td>
                                            <td style="white-space: nowrap">
                                                @can('manage-informasi.show')
                                                <a href="{{ route('manage-informasi.show', [$kategori->slug, Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm">Lihat</a>
                                                @endcan
                                                @can('manage-informasi.edit')
                                                <a href="{{ route('manage-informasi.edit', [$kategori->slug, Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @endcan
                                                @can('manage-informasi.destroy')
                                                <form action="{{ route('manage-informasi.destroy', [$kategori->slug, Crypt::encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Aye you sure want to remove this data?')" method="post">
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
