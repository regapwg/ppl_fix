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
    <title>Hasil IPK Anda</title>
</head>
<body style="background-color: #ffffff">
<div>
    <center><p style="font-size: 26px">IPK Anda: <b style="text-decoration: underline"><l>{{ $roundedIPK }}</l></b></p></center>
</div>
</body>
</html>
