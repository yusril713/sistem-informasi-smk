@extends('layouts.admin')
@section('title')
    Siswa
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('registration-siswa.create') }}">Data Siswa</a> <
                        <a href="#"><u>Tambah Data</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card card-body">
                    <div class="form-group">
                        <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                            @foreach ($ta as $item)
                                <option value="{{ $item->id }}">Tahun Ajaran {{ $item->mulai }} - {{ $item->sampai }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body">
                    @can('registration-siswa.store')
                    <form action="{{ route('registration-siswa.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="tahun_ajaran_id" id="tahun_ajaran_id" value="{{ TahunAjaran::getId() }}">
                        <table class="table table-bordered table-striped" id="tabel_paginate">
                            <thead>
                                <tr>
                                    <th>No Induk</th>
                                    <th>Nama</th>
                                    <th>Tahun Masuk</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody id="tabel_siswa">
                                @include('administrator.reg-siswa.create-data')
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end" style="padding-top: 20px">
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
    $(document).ready(function () {
        $('#tahun_ajaran').on('change', function () {
            $('#tahun_ajaran_id').val($(this).val())
            fetch_data($(this).val());
        });
        function fetch_data(id) {
            $.ajax({
                url:"/registration-siswa/data-to-create?id="+id,
                success:function(data)
                {
                    $('#tabel_siswa').html(data);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }

        $('#tabel_paginate').DataTable({
            "lengthMenu": [50, 100, 150, 200],
            "pageLength": [50]
        });
    });
</script>
@endsection
