
@foreach ($data as $item)
<tr>
    <td style="white-space: nowrap !important">{{ $item->no_induk }}</td>
    <td style="white-space: nowrap !important">{{ $item->nisn }}</td>
    <td style="white-space: nowrap !important">{{ $item->nama }}</td>
    <td style="white-space: nowrap !important">{{ $item->jenis_kelamin }}</td>
    <td style="white-space: nowrap !important">{{ $item->alamat }}</td>
    <td style="white-space: nowrap !important">{{ $item->no_hp }}</td>
    <td>
        @if ($item->status == 'siswa')
            <span class="badge badge-success">Siswa</span>
        @else
            <span class="badge badge-success">Alumni</span>
        @endif
    </td>
    <td style="white-space: nowrap !important">{{ $item->tahun_masuk }}</td>
    <td style="white-space: nowrap !important">
        @can('manage-siswa.edit')
        <a href="{{ route('manage-siswa.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
        @endcan
        @can('manage-siswa.show')
        <a href="{{ route('manage-siswa.show', [Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm">Lihat</a>
        @endcan
        @can('manage-siswa.destroy')
        <form action="{{ route('manage-siswa.destroy', [Crypt::encrypt($item->no_induk)]) }}" class="d-inline" onsubmit="return confirm('Are you sure want to remove this data?')" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="7" class="text-center">
        {!! $data->links() !!}
    </td>
</tr>

