@extends('layouts.admin')
@section('title')
    Tahun Ajaran
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Tahun Ajaran</u></a></div>
                    <div class="card-body">
                        @can('manage-tahun-ajaran.index')
                        @can('manage-tahun-ajaran.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-tahun-ajaran.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($ta as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->mulai }} - {{ $item->sampai }}</td>
                                        <td>
                                            @if ($item->status == 'Tidak Aktif')
                                                <span class="badge badge-danger">{{ $item->status }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('manage-tahun-ajaran.activate')
                                            <form action="{{ route('manage-tahun-ajaran.activate', [Crypt::encrypt($item->id)]) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure want to activate to {{ $item->mulai }} - {{ $item->sampai }}?')">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Aktivasi</button>
                                            </form>
                                            @endcan
                                            @can('manage-tahun-ajaran.edit')
                                            <a href="{{ route('manage-tahun-ajaran.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            @can('manage-tahun-ajaran.destroy')
                                            <form action="{{ route('manage-tahun-ajaran.destroy', [Crypt::encrypt($item->id)]) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure want to remove this data?')">
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
