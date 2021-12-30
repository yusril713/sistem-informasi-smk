@extends('layouts.admin')
@section('title')
    Manage Account
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    <h4 class="m-0 text-dark">Manage Account</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('manage-account.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <th>No</th>
                            <th>NIP/No Induk</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($user as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->roles[0]->name }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
