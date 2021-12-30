@extends('layouts.admin')
@section('title')
    {{ $informasi->title }}
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{ route('manage-informasi.index', [$kategori->slug]) }}">Manage {{ $kategori->kategori }}</a> <
                        <a href="#"><u>{{ $informasi->title }}</u></a>
                    </div>
                    @can('manage-informasi.show')
                    <div class="card-body">
                        <h4>{{ $informasi->title }}</h4>
                        <div class="row col-md-6">
                            <div class="col-md-6">
                                <span class="mdi mdi-account" title="Publisher">{{ $informasi->publisher }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="mdi mdi-calendar" title="Post date">{{ $informasi->updated_at->format('d M Y H:i:s') }}</span>
                            </div>
                        </div>
                        {!! $informasi->konten !!}
                    </div>
                    @else
                    @include('layouts.alert')
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
