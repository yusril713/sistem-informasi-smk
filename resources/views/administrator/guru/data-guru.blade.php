
@foreach ($data as $item)
<tr>
    <td style="white-space: nowrap !important">{{ $item->nip }}</td>
    <td style="white-space: nowrap !important">{{ $item->nama }}</td>
    <td style="white-space: nowrap !important">{{ $item->jenis_gtk }}</td>
    <td style="white-space: nowrap !important">{{ $item->alamat }}</td>
    <td style="white-space: nowrap !important">{{ $item->no_hp }}</td>
    <td style="white-space: nowrap !important">
        @can('manage-guru.edit')
        <a href="{{ route('manage-guru.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
        @endcan
        @can('manage-guru.show')
        <a href="{{ route('manage-guru.show', [Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm">Lihat</a>
        @endcan
        @can('manage-guru.destroy')
        <form action="{{ route('manage-guru.destroy', [Crypt::encrypt($item->nip)]) }}" class="d-inline" onsubmit="return confirm('Are you sure want to remove this data?')" method="post">
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

