@extends('layouts.global')
@section('title')
Direktori Guru
@endsection
@section('content')
<section id="courses" class="courses" style="padding-top: 100px">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @foreach ($guru as $item)
                <div class="col-md-6">
                    <div class="shadow-sm p-3 mb-5 bg-white rounded">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $item->user->profile_photo_path ? asset('storage/' . $item->user->profile_photo_path) : $item->user->profile_photo_url }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="font-weight-bold">Nama</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $item->nama }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font-weight-bold">NIK</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $item->nip }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font-weight-bold">Jenis Kelamin</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki'  : 'Perempuan'}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font-weight-bold">Tempat Lahir</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $item->tempat_lahir }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font-weight-bold">Tgl Lahir</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $item->tanggal_lahir }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font-weight-bold">Jenis GTK</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $item->jenis_gtk }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center" style="padding-top: 20px">
            {{ $guru->links() }}
        </div>
    </div>
</section>
@endsection
