@include('layouts.html_cut')
@extends('layouts.global')
@section('title')
    Home
@endsection
@section('toast')
@include('layouts.toast')
@endsection
@section('carousel')
<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="d-flex justify-content-center col-md-2">
                <img src="{{ asset('users/assets/img/logo.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-10">
                <div class="d-flex justify-content-center">
                    <h1>SMKS PGRI 2 WONOGIRI</h1>
                </div>
                <div class="text-center">
                    <h2>Jl. Brigjen Katamso Kaliancar Selogiri Wonogiri, Telp: (0273) 322736, <br>email: smkpgri2wonogiri@gmail.com</h2>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection
@section('content')
<section id="about" class="about">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Published date: {{ $sambutan->updated_at->format('d M Y') }}</h2>
            <p>{{ $sambutan->title }}</p>
        </div>
        <div class="row">
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                {!! $sambutan->konten !!}
            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="100">
                @foreach ($vm as $item)
                    <a href="#">{{ $item->title }}:</a>
                    {!! $item->konten !!}
                @endforeach
            </div>
        </div>
    </div>
</section>


@foreach ($kategori_informasi as $item)
@if ($item->limit->count() > 0)
<section id="popular-courses" class="course">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{ $item->kategori }}</h2>
            <p>{{ $item->kategori }}</p>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            @php
                $count = 0;
            @endphp
            @foreach ($item->limit as $i)
            @php
                $count = $count + 1;
            @endphp
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <img src="{{ asset('storage/' . $i->cover) }}" class="img-fluid" alt="...">
                        <div class="course-content">
                            <h3><a href="{{ route('detail-informasi', [$item->slug, $i->slug]) }}">{{ $i->title }}</a></h3>
                            <p class="text-right" style="font-size: 10pt">Published: {{ $i->created_at->format('d M Y') }}</p>
                            <p>{{ html_cut(strip_tags($i->konten),100,'...') }}...</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($count >= 3)
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
            <a href="" class="get-started-btn">{{ $item->kategori }} Selengkapnya</a>
        </div>
        @endif
    </div>
</section>
@endif
@endforeach
@endsection
