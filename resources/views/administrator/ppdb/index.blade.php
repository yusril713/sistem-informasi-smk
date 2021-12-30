@extends('layouts.admin')
@section('title')
    PPDB {{ TahunAjaran::get() }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>PPDB {{ TahunAjaran::get() }}</u></a></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                    @foreach ($ta as $item)
                                        <option value="{{ $item->id }}" {{ ($item->id == TahunAjaran::getId()) ? 'selected' : '' }}>{{ $item->mulai }} - {{ $item->sampai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" placeholder="Search.." id="search">
                                    <span class="input-group-append">
                                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('manage-ppdb.marked-print') }}" method="get">
                            @csrf
                            <div class="row" style="padding-top: 20px">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Marked Print</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">
                                                        <input type="checkbox" id="marked_all" name="marked_all" id="" class="form-control align-bottom" value="Select all">
                                                    </th>
                                                    <th class="align-middle">Nama</th>
                                                    <th class="align-middle">Email</th>
                                                    <th class="align-middle">Jenis Kelamin</th>
                                                    <th class="align-middle">Alamat</th>
                                                    <th class="align-middle">Org Tua</th>
                                                    <th class="align-middle">Asal Sekolah</th>
                                                    <th class="align-middle">No Hp</th>
                                                    <th class="align-middle">Jurusan</th>
                                                    <th class="align-middle">Informan</th>
                                                    <th class="align-middle">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabel_data">
                                                @include('administrator.ppdb.data')
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
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
            fetch_data($(this).val(), $('#search').val());
    });

    $(document).on('keyup', '#search', function() {
        fetch_data($('#tahun_ajaran').val(), $(this).val());
    });
    function fetch_data(id, key) {
        $.ajax({
            url:"/manage-ppdb/find?id="+id+"&key="+key,
            success:function(data)
            {
                $('#tabel_data').html(data);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    $('#marked_all').change(function() {
        $('input:checkbox').prop('checked', this.checked);
    });
});


</script>
@endsection
