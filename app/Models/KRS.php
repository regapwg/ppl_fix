<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KRS extends Model
{
    use HasFactory;
    protected $table='krs';
    protected $primaryKey='id';
    protected $fillable=['nama_krs'];

    public function krsDetail(){
        return $this->hasMany(KRSDetail::class, 'id', 'krs_id');
    }

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
}
