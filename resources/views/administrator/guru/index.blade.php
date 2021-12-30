@extends('layouts.admin')
@section('title')
    Guru
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="#"><u>Manage Guru</u></a></div>
                    <div class="card-body">
                        @can('manage-guru.index')
                        @can('manage-guru.create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manage-guru.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                        @endcan
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" placeholder="Search.." id="search_guru">
                                    <span class="input-group-append">
                                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="sorting" data-sorting_type="asc" data-column_name="nip" style="cursor: pointer">NIP <span id="nip_icon"></span></th>
                                                <th class="sorting" data-sorting_type="asc" data-column_name="nama" style="cursor: pointer">Nama <span id="nama_icon"></span></th>
                                                <th class="sorting" data-sorting_type="asc" data-column_name="jenis_gtk" style="cursor: pointer">Jenis GTK <span id="jenis_gtk_icon"></span></th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tabel_guru">
                                            @include('administrator.guru.data-guru')
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                                </div>
                            </div>
                        </div>
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
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                console.log('page: ' + page);
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();

                var query = $('#search_guru').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, sort_type, column_name, query);
            });

            function clear_icon()
            {
                $('#no_induk_icon').html('');
            }

            function fetch_data(page, sort_type, sort_by, query)
            {
                $.ajax({
                    url:"/manage-guru/all?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
                    success:function(data)
                    {
                        $('#tabel_guru').html(data);
                    }
                });
            }

            $(document).on('click', '.sorting', function(){
                var column_name = $(this).data('column_name');
                var order_type = $(this).data('sorting_type');
                var reverse_order = '';
                if(order_type == 'asc') {
                    $(this).data('sorting_type', 'desc');
                    reverse_order = 'desc';
                    clear_icon();
                    $('#'+column_name+'_icon').html('<span class="fa fa-angle-down"></span>');
                }
                if(order_type == 'desc'){
                    $(this).data('sorting_type', 'asc');
                    reverse_order = 'asc';
                    clear_icon
                    $('#'+column_name+'_icon').html('<span class="fa fa-angle-up"></span>');
                }
                $('#hidden_column_name').val(column_name);
                $('#hidden_sort_type').val(reverse_order);
                var page = $('#hidden_page').val();
                var query = $('#search_guru').val();
                fetch_data(page, reverse_order, column_name, query);
            });

            $(document).on('keyup', '#search_guru', function(){
                var query = $('#search_guru').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                fetch_data(page, sort_type, column_name, query);
            });

        });

    </script>
@endsection
