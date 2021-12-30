@extends('layouts.global')
@section('title')
PROFILE
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="container">
      <h2>PROFILE</h2>
      <p>SMK PGRI 2 WONOGIRI</p>
    </div>
</div>
<section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
        <div class="table-responsive">
            {!! $profil->konten !!}
        </div>
    </div>
</section>
@endsection
