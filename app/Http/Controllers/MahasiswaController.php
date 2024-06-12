<?php


namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\KRS;
use App\Models\KRSDetail;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function hitungKeseluruhanIPK()
    {
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mahasiswa) {
            $krsList = KRS::where('mahasiswa_id', $mahasiswa->id)->get();

            if ($krsList->isEmpty()) {
                $mahasiswa->ipk = null;
                continue;
            }

            $krsIds = $krsList->pluck('id')->toArray();
            $krsDetails = KRSDetail::with('matakuliah')->whereIn('krs_id', $krsIds)->get();

            $totalSks = 0;
            $weightedSum = 0;

            foreach ($krsDetails as $krsDetail) {
                $nilaiAkhir = $krsDetail->nilai_akhir;

                if ($nilaiAkhir !== null) {
                    $grade = match (true) {
                        $nilaiAkhir >= 80 => 4.0,
                        $nilaiAkhir >= 71 => 3.6,
                        $nilaiAkhir >= 66 => 3.2,
                        $nilaiAkhir >= 60 => 2.8,
                        $nilaiAkhir >= 55 => 2.4,
                        $nilaiAkhir >= 50 => 2.0,
                        $nilaiAkhir >= 45 => 1.6,
                        default => 1.2,
                    };
                } else {
                    continue;
                }

                $sks = $krsDetail->matakuliah->sks;

                $totalSks += $sks;
                $weightedSum += ($sks * $grade);
            }

            $ipk = ($totalSks > 0) ? ($weightedSum / $totalSks) : null;
            $roundedIPK = number_format($ipk, 1);

            if (substr($roundedIPK, -1) === '.') {
                $roundedIPK .= '0';
            }

            $mahasiswa->ipk = $roundedIPK;
        }

        return view('ipk_list', compact('mahasiswas'));
    }
}
