@component('mail::message')
Terima kasih telah melakukan pengisian formulir PPDB<br>{{ TahunAjaran::get() }} dengan data sbb:

@component('mail::table')
|              |                            |
| ------------ |----------------------------|
|Nama Lengkap  | {{ $data->nama }}          |
|Jenis Kelamin | {{ $data->jenis_kelamin  == 'L' ? 'Laki-laki' : 'Perempuan'}} |
|Alamat        | {{ $data->nama_orang_tua }} |
|Asal Sekolah  | {{ $data->asal_sekolah }} |
|No. Hp        | {{ $data->no_hp }} |
|Jurusan yg akan dipilih | {{ $data->jurusan }} |
|Nama Informan | {{ $data->nama_informan }}
@endcomponent

Salam,<br>
{{ config('app.name') }}
@endcomponent

