@extends('layouts.global')
@section('title')
{{ $informasi->title }}
@endsection
@section('content')
<section id="courses" class="courses" style="padding-top: 100px">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-8">
                <h4><a href="#">{{ $informasi->title }}</a></h4>
                <div class="row col-md-8">
                    <div class="col-md-6">
                        <i class="ri-user-2-fill" style="color: #5578ff;"></i>
                        <a href="#">{{ $informasi->publisher }}</a>
                    </div>
                    <div class="col-md-6">
                        <i class="ri-calendar-fill" style="color: #5578ff;"></i>
                        <a href="#">{{ $informasi->created_at->format('d M Y H:i:s') }}</a>
                    </div>
                </div>
                {!! $informasi->konten !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="e-mailit_toolbox circular  size24" data-emailit-url="{{ URL::to('/'.$informasi->kategori->ketegori . '/'. $informasi->slug) }}" data-emailit-title="{{ $informasi->title }}">
                            <div class="e-mailit_btn_Facebook"></div>
                            <div class="e-mailit_btn_Twitter"></div>
                            <div class="e-mailit_btn_WhatsApp"></div>
                            <div class="e-mailit_btn_Email"></div>
                            <div class="e-mailit_btn_Telegram"></div>
                            <div class="e-mailit_btn_EMAILiT"></div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Terbaru</h4>
                    </div>
                    @foreach ($all as $item)
                        <div class="card-body">
                            <a href="">{{ $item->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
