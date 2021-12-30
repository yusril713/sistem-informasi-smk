@extends('layouts.admin')
@section('title')
    Manage Roles
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    @can('manage-role.index')
                        <h4 class="m-0 text-dark">Manage Roles</h4>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-role.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Guard Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->guard_name }}</td>
                                            <td>
                                                <a href="{{ route('manage-role.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('manage-role.destroy', [Crypt::encrypt($item->id)]) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure want to remove this role?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            You dont have permission to access this page
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


