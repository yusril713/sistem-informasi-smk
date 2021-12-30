@extends('layouts.admin')
@section('title')
    Kontak
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Kontak</u></a></div>
                    <div class="card-body">
                        @can('manage-kontak.index')
                        @can('manage-kontak.creaet')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-kontak.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="">Kontak</a>
                        @foreach ($kontak as $item)
                            <div class="embed-responsive embed-responsive-16by9">
                            {!! $item->konten !!}
                            </div>
                            <footer>
                                <div class="d-flex justify-content-end">
                                    @can('manage-kontak.edit')
                                    <a href="{{ route('manage-kontak.edit', [Crypt::encrypt($item->id)]) }}" class="badge badge-success">Edit</a>
                                    @endcan
                                    @can('manage-kontak.destroy')
                                    <form action="{{ route('manage-kontak.destroy', [Crypt::encrypt($item->id)]   ) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to remove this data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge badge-danger">Hapus</button>
                                    </form>
                                    @endcan
                                </div>
                            </footer>
                        @endforeach
                        @else
                        @include('layouts.alert')
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
