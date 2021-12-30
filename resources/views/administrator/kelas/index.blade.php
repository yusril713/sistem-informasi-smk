@extends('layouts.admin')
@section('title')
    Kelas
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Kelas</u></a></div>
                    <div class="card-body">
                        @can('manage-kelas.index')
                        @can('manage-kelas.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-kelas.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Kelas</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($kelas as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->jurusan->jurusan }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>
                                            @can('manage-kelas.edit')
                                            <a href="{{ route('manage-kelas.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            @can('manage-kelas.destroy')
                                            <form action="{{ route('manage-kelas.destroy', [Crypt::encrypt($item->id)]) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure want to remove this data?')">
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
