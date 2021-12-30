@extends('layouts.admin')
@section('title')
    Permission
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    <h1 class="m-0 text-dark">Permission</h1>
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
                                <th>Route Name</th>
                                <th>Method</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @for ($i = 34; $i < sizeof($routes); $i++)
                                    @php
                                        $cek = false;
                                        foreach ($permission as $item) {
                                            if(isset($routes[$i]->action['as'])) {
                                                if($item->name == $routes[$i]->action['as']) {
                                                    $cek = true;
                                                    break;
                                                } else {
                                                    $cek = false;
                                                }
                                            } else {
                                                break;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ isset($routes[$i]->action['as']) ? $routes[$i]->action['as'] : '-' }}</td>
                                        <td>{{ isset($routes[$i]->methods) ? implode(', ', $routes[$i]->methods) : '-' }}</td>
                                        <td>
                                            @if ($cek)
                                                <form action="{{ route('manage-permission.destroy', [isset($routes[$i]->action['as']) ? $routes[$i]->action['as'] : '-']) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            @else
                                                <form action="{{ route('manage-permission.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="name" value="{{ $routes[$i]->action['as'] }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
