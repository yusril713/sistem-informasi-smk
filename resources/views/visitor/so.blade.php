@extends('layouts.global')
@section('title')
Struktur Organisasi
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="container">
      <h2>Struktur Organisasi</h2>
      <p>SMK PGRI 2 WONOGIRI</p>
    </div>
</div>
<section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
        <div class="table-responsive">
            {!! $so->konten !!}
        </div>
    </div>
</section>
@endsection
