@extends('layouts.app')

@section('action')
@endsection

@section('content')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <h4 class="card-title text-primary"><i class='{{$icon}}' data-toggle='tooltip' data-placement='bottom' title='Data {{$subtitle}}'></i> {{strtoupper("Data ".$subtitle)}}</h4>
    </div>
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
        <a href="{{ route('user-login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
        <a href="{{ route('user-signup') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
    </div>
    <div class="nk-fmg-actions">
    </div>
</div>

<!-- <div class="nk-fmg-body-content"> -->
<div class="nk-fmg-quick-list nk-block">
    <div class="card">
        <div class="card-body">
            <div class="nk-fmg-quick-list nk-block">
                {{-- <form name="formPendaftaran" action="{{ url('/cekIPK') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">Hitung IPK Anda</label>
                            <input type="text" class="form-control" name='nim' id="nim" placeholder="Ketik NIM Anda">
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-5"><a title='Cek IPK' href='javascript:void(0)' onclick='store()' class='btn btn-primary'>Cek IPK</a></div>
                        </div>
                    </div>
                </div>
                </form> --}}
                <form action="{{ route('semuakrs.cekIPK') }}" method="GET" target="_blank">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="nim" class="col-sm-2 col-form-label">Hitung IPK Anda</label>
                                <input type="text" class="form-control" name='nim' id="nim" placeholder="Ketik NIM Anda">
                            </div>
                            {{-- <div class="mb-3 row">
                                    <div class="col-sm-5"><a title='Cek IPK' href='javascript:void(0)' onclick='store()' class='btn btn-primary'>Cek IPK</a></div>
                                </div> --}}
                            <div class="col-sm-5">
                                <button class='btn btn-primary' type="submit">Hitung</button>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>

                <br>
                <form action="{{ route('hitungKeseluruhanIPK') }}" method="GET">
                    @csrf
                    <button type="submit">Hitung Keseluruhan IPK</button>
                </form>
                <hr>
                <form action="{{ route('search.results') }}" method="GET" target="_blank">
                    @csrf
                    <div class="card-body">
                        <label for="cariNIM" class="col-sm-2 col-form-label">Cari KHS Anda</label>
                        <input type="text" class="form-control" name='cariNIM' id="cariNIM" placeholder="Ketik NIM Anda">
                    </div>
                    <div class="col-sm-5">
                        <button class='btn btn-primary' type="submit">Cari</button>
                    </div>
                </form>
            </div>

            <br>

            <div>
                {{-- <table id="{{$table_id}}" class="table table-striped table-bordered nowrap" style="width:100%"> --}}
                <table class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead style="color:#526484; font-size:11px;">
                        <th>No.</th>
                        <th>Tahun Ajaran</th>
                        <th>Nama Matakuliah</th>
                        <th>NIM Mahasiswa</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai Huruf</th>
                        <th>Nilai Akhir</th>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->krs->nama_krs }}</td>
                            <td>{{ $row->matakuliah->nama_mk }}</td>
                            <td>{{ $row->krs->mahasiswa->nim }}</td>
                            <td>{{ $row->krs->mahasiswa->nama }}</td>
                            <td>{{ $row->nilai_huruf }}</td>
                            <td>{{ $row->nilai_akhir }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
{{-- <script>
function store(){
    if (document.forms["formPendaftaran"]["nim"].value =="") {
        CustomSwal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'NIM Tidak Boleh Kosong',
        })
        document.forms["formPendaftaran"]["nim"].focus();
        return false;
    }

    CustomSwal.fire({
        icon:'question',
        text: 'Yakin Data Sudah Benar ?',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('/cekIPK')}}",
data:{
_method: "POST",
_token:"{{csrf_token()}}",
nim:$("#nim").val()
},
type:"POST",
dataType:"JSON",
success:function(data){
if(data.success == 1){
CustomSwal.fire('Sukses', data.msg, 'success').then((result) => {});
}
else
{
CustomSwal.fire('Gagal', data.msg, 'error');
}
},
error:function(error){
CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
console.log(error.XMLHttpRequest);
},
});
}
});
}
</script> --}}
@endpush