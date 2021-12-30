@include('layouts.html_cut')
@extends('layouts.global')
@section('title')
{{ $kategori->kategori }}
@endsection
@section('content')
<section id="courses" class="courses" style="padding-top: 100px">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($kategori->informasi as $item)
                    <div class="col-lg-5">
                        <img src="{{ asset('storage/' . $item->cover) }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-7">
                        <h4><a href="{{ route('detail-informasi', [$kategori->slug, $item->slug]) }}">{{ $item->title }}</a></h4>
                        <p class="text-right" style="font-size: 10pt">Published: {{ $item->created_at->format('d M Y') }}</p>
                        <p>{{ html_cut(strip_tags($item->konten),240,'') }}. . . <a href="{{ route('detail-informasi', [$kategori->slug, $item->slug]) }}">Baca selengkapnya</a></p>
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Terbaru</h4>
                    </div>
                    @foreach ($all as $item)
                        <div class="card-body">
                            <a href="">{{ $item->title }}</a>
                            <p class="text-right" style="font-size: 10pt">Published: {{ $item->created_at->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="col-lg-8">
                <div class="d-flex justify-content-center">
                    {{ $kategori->informasi->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
