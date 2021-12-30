@extends('layouts.global')
@section('title')
Videos
@endsection
@section('content')
<section id="portfolio" class="portfolio section-bg" style="padding-top: 130px">
    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h3 class="section-title">Gallery - Videos</h3>
      </header>
      <hr>
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        @php
            $counter = 0;
        @endphp
        @foreach ($video as $item)
            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-wrap">
                <img src="assets/img/portfolio/card2.jpg" class="img-fluid" alt="">
                <div class='embed-responsive embed-responsive-16by9'>
                    <iframe class="embed-responsive-item" src='{{ $item->link }}' frameborder='0' allowfullscreen></iframe></div>
                </div>
            </div>
        @endforeach
      </div>
    </div>
</section>
@endsection
