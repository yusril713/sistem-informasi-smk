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
                    <div class="card-header">
                        <a href="{{ route('manage-tahun-ajaran.index') }}">Manage Tahun Ajaran</a> <
                        <a href="#"><u>Edit Tahun Ajaran</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body">
                    @can('manage-tahun-ajaran.update')
                    <form action="{{ route('manage-tahun-ajaran.update', [Crypt::encrypt($ta->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Tahun Ajaran</label>
                            @php
                                $now = getDate();
                                $year = $now['year'];
                                $year = $year + 1;
                                $start = 2000;
                            @endphp
                            <div class="row">
                                <div class="col-6">
                                    <select name="mulai" id="" class="form-control">
                                        @for ($i = $year-1; $i >= $start; $i--)
                                            <option value="{{ $i }}" {{ ($ta->mulai == $i) ? 'selected' : ''}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="sampai" id="" class="form-control">
                                        @for ($i = $year; $i >= $start; $i--)
                                            <option value="{{ $i }}" {{ ($ta->sampai == $i) ? 'selected' : ''}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

