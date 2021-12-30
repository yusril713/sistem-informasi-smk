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
                    <div class="card-header">
                        <a href="{{ route('manage-pengumuman.index') }}">Manage Pengumuman</a> <
                        <a href="#"><u>Edit Pengumuman</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body">
                    @can('manage-pengumuman.update')
                    <form action="{{ route('manage-pengumuman.update', [Crypt::encrypt($pengumuman->id)]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Pengumuman</label>
                            <textarea name="pengumuman" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan pengumuman..." required>{!! $pengumuman->pengumuman !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control" required>
                                <option value="aktif" {{ $pengumuman->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $pengumuman->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
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
