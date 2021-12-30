@foreach ($data as $item)
    <tr>
        <td>{{ $item->kategori->kategori }}</td>
        <td><p><a href="{{ asset('storage/' . $item->file) }}">{{ $item->title }}</a></p></td>
        <td>{{ $item->created_at->format('d M Y') }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="3">Total data: {{ count($data) }}</td>
</tr>
