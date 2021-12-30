@extends('layouts.global')
@section('title')
Photos
@endsection
@section('content')
<section id="portfolio" class="portfolio section-bg" style="padding-top: 100px">
    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h3 class="section-title">Gallery - Photos</h3>
      </header>
      <hr>
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        @php
            $counter = 0;
        @endphp
        @foreach ($photo as $item)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app" data-wow-delay="0.2s">
                <div class="portfolio-wrap">
                    <img src="{{ asset('storage/' . $item->link) }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <p>{{ $item->title }}</p>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
    </div>
</section>
@endsection
