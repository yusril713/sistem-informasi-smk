@extends('layouts.admin')
@section('title')
    {{ $siswa->nama }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-siswa.index') }}">Manage Siswa</a> <
                        <a href="#"><u>Data Siswa: {{ $siswa->nama }}</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">

                    @can('manage-guru.show')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">
                                <img src="{{ $siswa->user->profile_photo_url }}" width="150" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td>NIP</td>
                                    <td> : {{ $siswa->nip }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td> : {{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td> : {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat Tanggal Lahir</td>
                                    <td> : {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td> : {{ $siswa->agama }}</td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td> : {{ $siswa->no_hp }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Alamat</td>
                                    <td> : {{ $siswa->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>RT</td>
                                    <td> : {{ $siswa->rt }}</td>
                                </tr>
                                <tr>
                                    <td>RW</td>
                                    <td> : {{ $siswa->rw }}</td>
                                </tr>
                                <tr>
                                    <td>Kelurahan</td>
                                    <td> : {{ $siswa->kelurahan }}</td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td> : {{ $siswa->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten</td>
                                    <td> : {{ $siswa->kabupaten }}</td>
                                </tr>
                            </table>
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
@endsection
