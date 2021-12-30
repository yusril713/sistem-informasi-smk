@foreach ($data->detail_siswa as $i)
    <tr>
        <td>{{ $i->siswa->no_induk }}</td>
        <td>{{ $i->siswa->nama }}</td>
        <td>{{ $i->kelas->jurusan->jurusan }}</td>
        <td>{{ $i->kelas->kelas }}</td>
        <td>{{ $data->mulai }} - {{ $data->sampai }}</td>
        <td>
            @can('registration-siswa.edit')
            <a href="{{ route('registration-siswa.edit', [
            Crypt::encrypt($i->siswa->id),
            Crypt::encrypt($data->id)
        ]) }}" class="btn btn-primary btn-sm">Edit</a>
            @endcan
        </td>
    </tr>
@endforeach
