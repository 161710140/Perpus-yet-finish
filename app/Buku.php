<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $fillable = ['judul','pengarang','tahun_terbit','penerbit','tersedia'];

    public function Pinjambuku()
    {
        return $this->hasMany('App\PinjamBuku','id_buku');
    }
}
