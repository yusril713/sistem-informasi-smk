@php
    $no = 1;
@endphp
@foreach ($data as $item)
<tr>
    <td style="white-space: nowrap">
        <input type="checkbox" name="ppdb_id[]"  class="form-control ppdb_id" value="{{ $item->id }}">
    </td>
    <td style="white-space: nowrap">{{ $item->nama }}</td>
    <td style="white-space: nowrap">{{ $item->email }}</td>
    <td style="white-space: nowrap">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki'  : 'Perempuan' }}</td>
    <td style="white-space: nowrap">{{ $item->alamat }}</td>
    <td style="white-space: nowrap">{{ $item->nama_orang_tua }}</td>
    <td style="white-space: nowrap">{{ $item->asal_sekolah }}</td>
    <td style="white-space: nowrap">{{ $item->no_hp }}</td>
    <td style="white-space: nowrap">{{ $item->jurusan }}</td>
    <td style="white-space: nowrap">{{ $item->nama_informan }}</td>
    <td style="white-space: nowrap">
        <a href="" class="btn btn-primary btn-sm">Print</a>
    </td>
</tr>

@endforeach
<tr>
    <td colspan="10" class="text-left">Total data: {{ count($data) }}</td>
</tr>
