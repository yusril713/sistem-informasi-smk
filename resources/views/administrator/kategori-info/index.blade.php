@extends('layouts.admin')
@section('title')
    Kategori
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Kategori</u></a></div>
                    <div class="card-body">
                        @can('manage-kategori.index')
                        @can('manage-kategori.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-kategori.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Slug</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($kategori as $item)
                                        @if ($item->slug != 'ppdb')
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>
                                                @can('manage-kategori.edit')
                                                <a href="{{ route('manage-kategori.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @endcan
                                                @can('manage-kategori.destroy')
                                                <form action="{{ route('manage-kategori.destroy', [Crypt::encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Aye you sure want to remove this data?')" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endif
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
