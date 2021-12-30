@extends('layouts.admin')
@section('title')
    Guru
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage-guru.index') }}">Manage Guru</a> <
                        <a href="#"><u>Tambah Guru</u></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    @can('manage-guru.store')
                    <form action="{{ route('manage-guru.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*NIP</label>
                                    <input type="text" name="nip" id="" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="Masukkan no induk guru...">
                                    @error('nip')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Nama</label>
                                    <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama guru...">
                                    @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jenis GTK</label>
                                    <input type="text" name="jenis_gtk" id="" class="form-control @error('jenis_gtk') is-invalid @enderror" value="{{ old('jenis_gtk') }}" placeholder="Masukkan jenis GTK...">
                                    @error('jenis_gtk')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        <option value="L" {{ (old('jenis_kelamin') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ (old('jenis_kelamin') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir">
                                    @error('tempat_lahir')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Tanggal Lahir</label>
                                    <div class="row">
                                        @php
                                            $now = getDate();
                                            $year = $now['year'];
                                            $year_start = $year - 70;
                                            $date_start = 1;
                                            $date_end = 31;
                                            $month = [
                                                'Januari', 'Februari', 'Maret',
                                                'April', 'Mei', 'Juni',
                                                'Juli', 'Agustus', 'September',
                                                'Oktober', 'November', 'Desember',
                                            ];
                                        @endphp
                                        <div class="col-md-4">
                                            <select name="tanggal" id="" class="form-control @error('tanggal') is-invalid @enderror">
                                                <option value="">Tanggal</option>
                                                @for ($i = $date_start; $i <= $date_end; $i++)
                                                    <option value="{{ $i }}" {{ (old('tanggal') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="bulan" id="" class="form-control @error('bulan') is-invalid @enderror">
                                                <option value="">Bulan</option>
                                                @for ($i = 0; $i < sizeof($month); $i++)
                                                    <option value="{{ ($i+1) }}" {{ (old('bulan') == ($i+1)) ? 'selected' : ''}}>{{ $month[$i] }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="tahun" id="" class="form-control @error('tahun') is-invalid @enderror">
                                                <option value="">Tahun</option>
                                                @for ($i = $year; $i >= $year_start; $i--)
                                                    <option value="{{ $i }}" {{ (old('tahun') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Agama</label>
                                    <input type="text" name="agama" id="" class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama') }}" placeholder="Masukkan agama guru...">
                                    @error('agama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*No Hp</label>
                                    <input type="text" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" name="no_hp" placeholder="Masukkan no hp aktif....">
                                    @error('no_hp')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">*Alamat</label>
                                    <textarea name="alamat" rows="1" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">RT/RW</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" id="rt" class="form-control" name="rt" placeholder="RT" value="{{ old('rt') }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="rw" class="form-control" name="rw" placeholder="RW" value="{{ old('rw') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <input type="text" name="kelurahan" id="" class="form-control" placeholder="Masukkan kelurahan..." value="{{ old('kelurahan') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="" class="form-control" placeholder="Masukkan kecamatan..." value="{{ old('kecamatan') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <input type="text" name="kabupaten" id="" class="form-control" placeholder="Masukkan kabupaten..." value="{{ old('kabupaten') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" id="" class="form-control" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Guru" selected>Guru</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
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
    // Restricts input for the given textbox to the given inputFilter function.
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
            });
        });
    }

    setInputFilter(document.getElementById("no_hp"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
    setInputFilter(document.getElementById("rt"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
    setInputFilter(document.getElementById("rw"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
</script>
@endsection
