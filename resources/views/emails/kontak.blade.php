@component('mail::message')
Terima kasih telah menghubungi kami, <br>mohon maaf atas kendala yang anda alami.

@component('mail::table')
|              |                                                |
| ------------ |------------------------------------------------|
|Nama Lengkap  | {{ $data['nama'] }}                            |
|Email         | {{ $data['email'] }}                           |
|Pesan         | {{ $data['pesan'] }}                           |
@endcomponent

Salam,<br>
{{ config('app.name') }}
@endcomponent

