<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable= ['kelas'];

    public function Siswa()
    {
        return $this->hasMany('App\Siswa','id_kelas');
    }

    public function Kelas()
    {
        return $this->hasOne('App\PinjamBuku','id_kelas');
    }
}
