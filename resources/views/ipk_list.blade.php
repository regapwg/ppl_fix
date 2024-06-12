<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    @include('templates.metadata')
    <style>
        .currency {
            text-align: right;
        }
    </style>
    <title>Daftar IPK Mahasiswa</title>
</head>

<body style="background-color: #ffffff">
    <h1>Daftar IPK Mahasiswa</h1>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>IPK</th>
        </tr>
        @foreach ($mahasiswas as $mahasiswa)
        <tr>
            <td>{{ $mahasiswa->nama }}</td>
            <td>{{ $mahasiswa->nim }}</td>
            <td>{{ $mahasiswa->ipk ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</body>

</html>