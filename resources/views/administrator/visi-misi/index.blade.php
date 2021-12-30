@extends('layouts.admin')
@section('title')
    Visi Misi
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Visi Misi</u></a></div>
                    <div class="card-body">
                        @can('manage-visimisi.index')
                        @can('manage-visimisi.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-visimisi.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach ($vm as $item)
                            <a href="">{{$item->title}}</a>
                            {!! $item->konten !!}
                            <footer>
                                <div class="d-flex justify-content-end">
                                    @can('manage-visimisi.edit')
                                    <a href="{{ route('manage-visimisi.edit', [Crypt::encrypt($item->id)]) }}" class="badge badge-success">Edit</a>
                                    @endcan
                                    @can('manage-visimisi.destroy')
                                    <form action="{{ route('manage-visimisi.destroy', [Crypt::encrypt($item->id)]   ) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to remove this data?')">
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
