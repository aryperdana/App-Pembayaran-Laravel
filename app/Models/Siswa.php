<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $guarded = ['id'];

    public function waliMurid()
    {
        return $this->hasMany(WaliMurid::class);
    }

    public function detailTagihanSpp()
    {
        return $this->hasMany(DetailTagihanSPP::class, "id_siswa");
    }

    public function detail_kelass()
    {
        return $this->hasOne(DetailKelas::class, "id_siswa");
    }

}
