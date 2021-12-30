@extends('layouts.admin')
@section('title')
    Assign Role has permission
@endsection
@section('content')
<link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body">
                    @can('assign-permission.edit')
                    <h4 class="m-0 text-dark">Assign Role Has Permission</h4>
                    <hr>
                    <form action="{{ route('assign-permission.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="role_id" value="{{$role_has_pemissions->id}}">
                        <div class="form-group">
                            <label for="">Role</label>
                            <input type="text" name="role" id="" value="{{ $role_has_pemissions->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Permission</label>
                            <select id="choices-multiple-remove-button" name="permissions[]" multiple required>
                                @foreach ($permission as $item)
                                    <option value="{{ $item->name }}"
                                        @if (isset($role_has_pemissions->permissions))
                                            @foreach ($role_has_pemissions->permissions as $rhp)
                                                @if ($rhp->name == $item->name)
                                                    {{ 'selected' }}
                                                    @php
                                                        break;
                                                    @endphp
                                                @else
                                                    {{ '' }}
                                                @endif
                                            @endforeach
                                        @endif
                                        >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                    @else
                    @include('layouts.alert')
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
         $(document).ready(function(){
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
            });
        });
    </script>
@endsection
