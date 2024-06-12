@extends('layouts.app')
@section('action')

@endsection

@section('content')
<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        {{-- <em class="icon ni ni-search"></em>
        <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> --}}
        <h4 class="card-title text-primary"><i class='{{ $icon }}' data-toggle='tooltip' data-placement='bottom'
                title='{{ $subtitle }}'></i> {{ strtoupper($subtitle) }}</h4>
    </div>
    <div class="nk-fmg-actions">
        <div class="btn-group">
            {{-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button>
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> --}}
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em
                    class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
        </div>
    </div>
</div>

<div class="nk-fmg-quick-list nk-block">
    <form name="formPendaftaran" action="{{ url('/admin/krsdetail/save') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                {{-- <div class="mb-3 row">
                    <label for="krs_id" class="col-sm-2 col-form-label">KRS</label>
                    <select type="text" class="form-control" name='krs_id' id="krs_id">
                        <option value="{{ old('id') }}">Pilih KRS</option>
                        @foreach ($krss as $krs)
                            <option value= {{ $krs->id }} >{{ $krs->nama_krs }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="mb-3 row">
                    <label for="matakuliah_id" class="col-sm-2 col-form-label">Pilih Matakuliah</label>
                    <select type="text" class="form-control" name='matakuliah_id' id="matakuliah_id">
                        <option value="{{ old('id') }}">Pilih Matakuliah</option>
                        @foreach ($matakuliahs as $matakuliah)
                            <option value= {{ $matakuliah->id }} >{{ $matakuliah->kode_mk }} - {{ $matakuliah->nama_mk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 row">
                    <label for="nilai_akhir" class="col-sm-2 col-form-label">Nilai Akhir</label>
                    <input type="text" class="form-control" name='nilai_akhir' value="{{ old('nilai_akhir') }}" id="nilai_akhir" >
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-5"><a title='Tambah Data' href='javascript:void(0)' onclick='store()' class='btn btn-primary'>Simpan</a></div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('script')
<script>
function store(){
    if (document.forms["formPendaftaran"]["matakuliah_id"].value =="") {
            CustomSwal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Matakuliah Tidak Boleh Kosong',
            })
            document.forms["formPendaftaran"]["matakuliah_id"].focus();
            return false;
    }  
        if (document.forms["formPendaftaran"]["nilai_akhir"].value == "") {
            CustomSwal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nilai Akhir Tidak Boleh Kosong',
            })
            document.forms["formPendaftaran"]["nilai_akhir"].focus();
            return false;
        }

    // buttonsmdisable(elm);
    CustomSwal.fire({
        icon:'question',
        text: 'Yakin Data Sudah Benar ?',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('/admin/krsdetail/save')}}",
                data:{
                    _method: "POST",
                    _token:"{{csrf_token()}}",
                    krs_id:{{ $id }},
                    matakuliah_id:$("#matakuliah_id").val(),
                    nilai_akhir:$("#nilai_akhir").val()
                },
                type:"POST",
                dataType:"JSON",
                success:function(data){
                    if(data.success == 1){
                        CustomSwal.fire('Sukses', data.msg, 'success').then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace("{{ url()->previous() }}");
                            }
                        });
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
</script>
@endpush