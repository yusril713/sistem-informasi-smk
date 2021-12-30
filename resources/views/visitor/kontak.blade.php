@extends('layouts.global')
@section('title')
Kontak
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="container">
      <h2>Hubungi Kami</h2>
      <p>SMK PGRI 2 WONOGIRI</p>
    </div>
</div>
<section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-9">
                <div class="embed-responsive embed-responsive-16by9">
                    {!! $kontak->konten !!}
                </div>
                <div class="row" style="padding-top: 20px">
                    <div class="col-md-12">
                        <div class="shadow-sm p-3 mb-5 bg-white rounded">
                            <h4>Hubungi Kami</h4>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{ route('kontak.post') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama" id="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Pesan</label>
                                    <textarea name="pesan" class="form-control" id="" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
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
