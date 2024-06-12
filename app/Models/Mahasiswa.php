<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table='mahasiswa';
    protected $fillable=['nim', 'nama'];

    public function krs(){
        return $this->hasMany(KRS::class, 'id', 'krs_id');
    }
}
