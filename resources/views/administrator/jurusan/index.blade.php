@extends('layouts.admin')
@section('title')
    Jurusan
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Jurusan</u></a></div>
                    <div class="card-body">
                        @can('manage-jurusan.index')
                        @can('manage-jurusan.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-jurusan.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Jurusan</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($jurusan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->jurusan }}</td>
                                        <td>
                                            @can('manage-jurusan.edit')
                                            <a href="{{ route('manage-jurusan.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            @can('manage-jurusan.destroy')
                                            <form action="{{ route('manage-jurusan.destroy', [Crypt::encrypt($item->id)]) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure want to remove this data?')">
                                                @method('DELETE')
                                                @csrf
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
