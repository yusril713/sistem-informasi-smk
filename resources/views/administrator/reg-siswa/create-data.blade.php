@if ($siswa)
    @foreach ($siswa as $item)
        <tr>
            <td>{{ $item->no_induk }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->tahun_masuk }}</td>
            <td>
                <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                <select name="kelas[]" id="kelas" class="form-control">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $i)
                        <option value="{{ $i->id }}">{{ $i->jurusan->jurusan }} - {{ $i->kelas }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    @endforeach
@endif
