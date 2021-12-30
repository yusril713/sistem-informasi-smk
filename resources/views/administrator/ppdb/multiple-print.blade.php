<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ base_path().'/public/users/assets/css/style.css' }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <table class="table table-striped" style="border: 1">
                <thead>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>Email</td>
                        <td>Jns Kelamin</td>
                        <td>Alamat</td>
                        <td>Orang Tua</td>
                        <td>Asal Sekolah</td>
                        <td>No Telp</td>
                        <td>Jurusan</td>
                        <td>Informan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $item['alamat'] }}</td>
                            <td>{{ $item['nama_orang_tua'] }}</td>
                            <td>{{ $item['asal_sekolah'] }}</td>
                            <td>{{ $item['no_hp'] }}</td>
                            <td>{{ $item['jurusan'] }}</td>
                            <td>{{ $item['nama_informan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
