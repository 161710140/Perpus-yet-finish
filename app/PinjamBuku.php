<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinjamBuku extends Model
{
    protected $table = 'pinjam_bukus';
    protected $fillable = ['nomer_peminjaman','id_siswa','id_buku','id_kelas','tanggal_pinjam','tanggal_kembali','tanggal_harus_kembali','hukuman'];


    public function Siswa()
    {
        return $this->belongsTo('App\Siswa','id_siswa');
    }
    
    public function Kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas');
    }

    public function Buku()
    {
        return $this->belongsTo('App\Buku','id_buku');
    }
}
