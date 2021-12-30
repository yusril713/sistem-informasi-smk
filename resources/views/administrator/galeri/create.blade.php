@extends('layouts.admin')
@section('title')
    Tambah Galeri
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-galeri.index') }}">Manage Galeri</a> <
                        <a href="#"><u>Tambah Galeri</u></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-top: 20px">
                <div class="card card-body">
                    @can('manage-galeri.store')
                    <form action="{{ route('manage-galeri.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="form-group" id="input_galeri">

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
@section('script')
<script>
    $(document).ready(function() {
        $(document).on('change', '#jenis', function() {
            var val = $(this).val();
            var html = '';
            if (val == '') {
                $('#input_galeri').html('');
            } else if (val == 'foto') {
                $('#input_galeri').html('<label>Gambar</label><input type="file" class="form-control" name="link" required>');
            } else if (val == 'video') {
                $('#input_galeri').html('<label>Link Video</label><input type="text" class="form-control" name="link" placeholder="Masukkan link..." required>');
            }
        });
    });
</script>
@endsection
