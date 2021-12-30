@extends('layouts.global')
@section('title')
Downloads
@endsection
@section('content')
<section id="features" class="features" style="padding-top: 100px;">
    <div class="container" data-aos="fade-up">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box"  id="kategori" data-kategori_id="">
                    <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
                    <h3><a href="#" id="kategori" data-kategori_id="">Tampil Semua ({{ count($data) }})</a></h3>
                </div>
            </div>
            @foreach ($kategori as $item)
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" id="kategori" data-kategori_id="{{ $item->id }}">
                    <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
                    <h3><a href="#" id="kategori" data-kategori_id="{{ $item->id }}">{{ $item->kategori }} ({{ count($data->where('kategori_id', $item->id)) }})</a></h3>
                </div>
            </div>
            @endforeach
        </div>
        <div class="container">
            <div class="row" data-aos="zoom-in" data-aos-delay="100" style="padding-top: 20px">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Kategori</th>
                            <th>File</th>
                            <th>Tanggal</th>
                        </thead>
                        <tbody id="tabel_data">
                            @include('visitor.data-download')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(document).on('click', '#kategori', function() {
            var kategori_id = $(this).data('kategori_id');
            console.log(kategori_id);
            fetch_data(kategori_id);
        });
    });

    function fetch_data(id) {
        $.ajax({
            url:"/download/find?id="+id,
            success:function(data)
            {
                $('#tabel_data').html(data);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }
</script>
@endsection
