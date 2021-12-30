@extends('layouts.admin')
@section('title')
    Assign Role has permission
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    @can('assign-permission.index')
                    <h4 class="m-0 text-dark">Assign Role Has Permission</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" style="white-space: normal !important">
                            <th style="width: 20%">Role</th>
                            <th style="width: 60%">Permissions</th>
                            <th style="width: 29%">Action</th>
                            <tbody>
                                @foreach ($role as $item)
                                    <tr>
                                        <td style="width: 20%">{{ $item->name }}</td>
                                        <td style="width: 60%">
                                            @if (isset($item->permissions))
                                                @foreach ($item->permissions as $p)
                                                    <span href="#" class="badge badge-success" style="margin-top: 3px">{{ $p->name }}</span>
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </td style="width: 20%">
                                        <td>
                                            <a href="{{ route('assign-permission.edit', [$item->id]) }}" class="btn btn-primary btn-sm">Edit</a>
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
@endsection
