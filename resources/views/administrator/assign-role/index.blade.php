@extends('layouts.admin')
@section('title')
    Assign Role
@endsection
@section('content')
<div class="main-panel">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    @can('assign-role.index')
                    <h4 class="m-0 text-dark">Assign Role</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <th>No</th>
                            <th>No Induk</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <select name="role" id="role" data-user_id="{{ $item->id }}" class="form-control">
                                                @foreach ($role as $item_role)
                                                    <option  value="{{ $item_role->name }}" {{ ($item_role->name == $item->roles[0]->name) ? 'selected' : ''}}>{{ $item_role->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
@section('script')
<script>
    $(document).on('change', '#role', function() {
        console.log($(this).val());
        var url = "{{ route('assign-role.store') }}";
        console.log(url);
        var id = $(this).data('user_id');
        $.ajax({
            url: url,
            method:"POST",
            data:{
                id: id,
                role: $(this).val(),
                _token: "{{ csrf_token() }}"
            },
            success:function(data)
            {
                alert(data);
            }, error: function(xhr) {
                console.log(xhr);
            }
        });
    })
</script>
@endsection
