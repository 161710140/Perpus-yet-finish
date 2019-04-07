<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table='siswas';
    protected $fillable=['no_absen','nama','id_kelas'];

    public function PinjamBuku()
    {
        return $this->hasMany('App\PinjamBuku','id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas');
    }
}
