@extends('layouts.admin')
@section('title')
    Add Roles
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body">
                    <h4 class="m-0 text-dark">Add Roles</h4>
                    <hr>
                    <form action="{{ route('manage-role.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="insert role name...">
                        </div>
                        <div class="form-group">
                            <label for="">Guard Name</label>
                            <input type="text" name="guard_name" id="" class="form-control" value="web" readonly>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
