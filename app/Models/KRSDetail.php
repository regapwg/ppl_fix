<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KRSDetail extends Model
{
    use HasFactory;
    protected $table='krs_detail';
    protected $primaryKey='id';
    protected $fillable=['krs_id', 'matakuliah_id', 'nilai_akhir'];

    public function krs(){
        return $this->belongsTo(KRS::class, 'krs_id', 'id');
    }

    public function matakuliah(){
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id', 'id');
    }
}