@extends('layouts.admin')
@section('title')
    Pengumuman
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Pengumuman</u></a></div>
                    <div class="card-body">
                        @can('manage-pengumuman.index')
                        @can('manage-pengumuman.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-pengumuman.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Pengumuman</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pengumuman as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->pengumuman }}</td>
                                            <td>
                                                @if ($item->status == 'aktif')
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap">
                                                @can('manage-pengumuman.activate')
                                                @if ($item->status == 'aktif')
                                                    <form action="{{ route('manage-pengumuman.activate', [Crypt::encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Are you sure want to deactivate this announcement?')" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="nonaktif">
                                                        <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('manage-pengumuman.activate', [Crypt::encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Are you sure want to activate this announcement?')" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="aktif">
                                                        <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                                    </form>
                                                @endif
                                                @endcan
                                                @can('manage-pengumuman.edit')
                                                <a href="{{ route('manage-pengumuman.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @endcan
                                                @can('manage-pengumuman.destroy')
                                                <form action="{{ route('manage-pengumuman.destroy', [Crypt::encrypt($item->id)]) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to remove this announcement?')">
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
