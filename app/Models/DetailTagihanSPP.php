<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTagihanSPP extends Model
{
    use HasFactory;
    protected $table = 'detail_tagihan_spps';
    protected $guarded = ['id'];

    public function tagihanSpp()
    {
        return $this->belongsTo(TagihanSpp::class, 'id_tagihan_spp');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function jenisTagihan()
    {
        return $this->belongsTo(JenisTagihan::class, 'id_jenis_tagihan');
    }
}
