<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KRSDetail;
use App\Models\KRS;
use App\Models\Matakuliah;

class KRSDetailController extends Controller
{
    public function index($namaMahasiswa){
        $icon = 'ni ni-dashlite';
        $subtitle = 'KRS Detail';
        $table_id = 'krs_detail';
        return view('crudkrsdetail.crud',compact('subtitle','table_id','icon', 'namaMahasiswa'));
    }

    public function krsDetail($id, $nim){
        $icon = 'ni ni-dashlite';
        $subtitle = 'KRS Detail';
        $table_id = 'krs_detail';
        $krs = KRS::find($id);
        $krs_id = $id;
        return view('crudkrsdetail.crud',compact('subtitle','table_id','icon', 'krs_id', 'krs', 'nim'));
    }

    public function listData(Request $request, $krs_id){
        $data = KRSDetail::select('id', 'krs_id', 'matakuliah_id', 'nilai_akhir')->where('krs_id', $krs_id)->get();
        
        // Calculate nilai_huruf for each row
        $data->transform(function ($item, $key) {
            if ($item->nilai_akhir !== null) {
                if ($item->nilai_akhir >= 80) {
                    $item->nilai_huruf = 'A';
                } elseif ($item->nilai_akhir >= 71) {
                    $item->nilai_huruf = 'B+';
                } elseif ($item->nilai_akhir >= 66) {
                    $item->nilai_huruf = 'B';
                } elseif ($item->nilai_akhir >= 60) {
                    $item->nilai_huruf = 'C+';
                } elseif ($item->nilai_akhir >= 55) {
                    $item->nilai_huruf = 'C';
                } elseif ($item->nilai_akhir >= 50) {
                    $item->nilai_huruf = 'D+';
                } elseif ($item->nilai_akhir >= 45) {
                    $item->nilai_huruf = 'D';
                } else {
                    $item->nilai_huruf = 'E';
                }
            } else {
                $item->nilai_huruf = ''; // Handle cases where nilai_akhir is null
            }
            return $item;
        });
    
        $datatables = DataTables::of($data);
        return $datatables
            ->addIndexColumn()
            ->addColumn('nama_krs', function($row) {
                return $row->krs->nama_krs;
            })
            ->addColumn('nama_mk', function($row) {
                return $row->matakuliah->nama_mk;
            })
            ->addColumn('nilai_huruf', function($row) {
                return $row->nilai_huruf;
            })
            ->addColumn('aksi', function($data){
                $aksi = "";
                //  $aksi .= "<a title='Edit Data' href='/admin/krs/".$data->id_diklat."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function deleteData(Request $request){
        if(KRSDetail::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Detail KRS';
        $krss = KRS::all();
        $matakuliahs = Matakuliah::all();
        
        return view('crudkrsdetail.create',compact('subtitle','icon', 'krss', 'matakuliahs', 'id'));
    }

    public function edit(Request $request, $id){
        $data = KRSDetail::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data KRSDetail';
        $krss = KRS::all();
        $krs = KRSDetail::find($id);

        return view('crudkrsdetail.edit',compact('subtitle','icon','data', 'krs', 'krss'));
    }

    public function save(Request $request){
        KRSDetail::create($request->all());
        $response = array('success'=>1,'msg'=>'Berhasil menambah data');
        return $response;
    }

    public function update(Request $request, $id){
        $krss = KRSDetail::all();
        $diklatLama = KRSDetail::find($id);

        // $diklatLama->no_urut = $request-> input('no_urut');
        // $diklatLama->nama_diklat = $request-> input('nama_diklat');
        // $diklatLama->krs_id = $request-> input('krs_id');
        // $diklatLama->save();
        
        $response = array('success'=>1,'msg'=>'Berhasil mengedit data');
        return $response;
    }
}