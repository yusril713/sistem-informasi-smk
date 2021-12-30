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
                    <div class="card-header"><a href="#"><u>Data Siswa</u></a></div>
                    <div class="card-body">
                        @can('registration-siswa.index')
                        @can('registration-siswa.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('registration-siswa.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                        @foreach ($ta as $item)
                                            <option value="{{ $item->id }}">Tahun Ajaran {{ $item->mulai }} - {{ $item->sampai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tabel_paginate">
                                        <thead>
                                            <tr>
                                                <th>No. Induk</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tabel_data">
                                            @include('administrator.reg-siswa.data')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('layouts.alert')
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#tahun_ajaran').on('change', function() {
            console.log($(this).val());
            fetch_data($(this).val());
        });

        $('#tabel_paginate').DataTable(
            {
                "lengthMenu": [50, 100, 150, 200],
                "pageLength": [50]
            }
        );

        function fetch_data(id) {
            $.ajax({
                url:"/registration-siswa/find?id="+id,
                success:function(data)
                {
                    $('#tabel_data').html(data);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
    });
</script>
@endsection
