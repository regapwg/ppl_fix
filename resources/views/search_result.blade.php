<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    @include('templates.metadata')
    <style>
        .currency{
            text-align: right;
        }
    </style>
    <title>Hasil KHS Anda</title>
</head>
<body style="background-color: #ffffff">
<div>
    <table class="table table-striped table-bordered nowrap" style="width:100%">
        <thead style="color:#000000; font-size:11px;">
            <th>No.</th>
            <th>Tahun Ajaran</th>
            <th>Nama Matakuliah</th>
            <th>NIM Mahasiswa</th>
            <th>Nama Mahasiswa</th>
            <th>Nilai Akhir</th>
        </thead>
        <tbody>
            @foreach($searchResult as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->krs->nama_krs }}</td>
                    <td>{{ $detail->matakuliah->nama_mk }}</td>
                    <td>{{ $detail->krs->mahasiswa->nim }}</td>
                    <td>{{ $detail->krs->mahasiswa->nama }}</td>
                    <td>{{ $detail->nilai_akhir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
