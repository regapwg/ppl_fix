<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KRS;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class KRSController extends Controller
{
    // public function index(){
    //     $icon = 'ni ni-dashlite';
    //     $subtitle = 'KRS';
    //     $table_id = 'krs';
    //     return view('crudkrs.crud',compact('subtitle','table_id','icon'));
    // }
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'KRS';
        $table_id = 'krs';

        $data = KRS::all();
        $krsData = $data->map(function ($item) {
            return [
                'nama_krs' => $item->nama_krs,
                'nim_mahasiswa' => $item->mahasiswa->nim,
                'nama_mahasiswa' => $item->mahasiswa->nama,
                'aksi' => "<a title='Detail KRS' href='/admin/{$item->id}/krsdetail/{$item->mahasiswa->nim}' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' data-id='{$item->id}' onclick='buttonsmdisable(this)'><i class='ti-book' ></i></a>"
            ];
        });

        return view('crudkrs.crud', compact('subtitle', 'table_id', 'icon', 'krsData'));
    }

    // public function listData(Request $request){
    //     $data = KRS::all();
    //     // $data = KRS::all()->sortDesc();
    //     $datatables = DataTables::of($data);

    //     return $datatables
    //             ->addIndexColumn()
    //             ->addColumn('aksi', function($data){
    //                 $aksi = "";
    //                 // $aksi .= "<a title='Edit Data' href='/admin/krs/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
    //                 // $aksi .= "<a title='Detail KRS' href='/admin/".$data->id."/krsdetail' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-book' ></i></a>";
    //                 // $namaMahasiswa = $data->mahasiswa->nama;
    //                 // $aksi .= "<a title='Detail KRS' href='/admin/".$data->id."/krsdetail' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)' data-nama-mahasiswa='{$namaMahasiswa}'><i class='ti-book' ></i></a>";
    //                 $aksi .= "<a title='Detail KRS' href='/admin/".$data->id."/krsdetail/".$data->mahasiswa->nim."' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' data-id='{$data->id}' onclick='buttonsmdisable(this)'><i class='ti-book' ></i></a>";
    //                 // $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama_krs}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama_krs='{$data->nama_krs}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
    //                 return $aksi;
    //             })
    //             ->addColumn('nim_mahasiswa', function($row) {
    //                 return $row->mahasiswa->nim;
    //             })
    //             ->addColumn('nama_mahasiswa', function($row) {
    //                 return $row->mahasiswa->nama;
    //             })
    //             ->rawColumns(['aksi'])
    //             ->make(true);
    // }

    public function deleteData(Request $request){
        if(KRS::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data KRS';

        return view('crudkrs.create',compact('subtitle','icon'));
    }

    public function edit(Request $request, $krs_id){
        $data = KRS::find($krs_id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data KRS';
        return view('crudkrs.edit',compact('subtitle','icon','data'));
    }

    public function save(Request $request){
        $tidakUnik = 0;

        $krs = KRS::all();
        foreach (KRS::all() as $krs) {
            if($krs->nama_krs==$request->input('nama_krs')){
                $tidakUnik = 1;
            }
        }
        if($tidakUnik == 1){
            $response = array('success'=>2,'msg'=>'Nama KRS harus Unik');
        }else{
            $krs = new KRS;
            $krs->nama_krs = $request-> input('nama_krs');
            $krs->save();

            $response = array('success'=>1,'msg'=>'Berhasil menambah data');
        }
        return $response;
    }

    public function update(Request $request, $krs_id){
        $tidakUnik = 0;

        $krss = KRS::all();
        foreach ($krss as $krs) {
            if($krs->krs_id==$krs_id){
                continue;
            }else{
                if($krs->nama_krs==$request->input('nama_krs')){
                    $tidakUnik = 1;
                }    
            }
        }
        if($tidakUnik == 1){
            $response = array('success'=>2,'msg'=>'Nama KRS harus Unik');
        }else{
            $krs = KRS::find($krs_id);
            $krs->nama_krs = $request-> input('nama_krs');
            $krs->save();

            $response = array('success'=>1,'msg'=>'Berhasil mengedit data');
        }
        return $response;
    }
}
