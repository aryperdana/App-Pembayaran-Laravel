<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TagihanSpp extends Model
{
    use HasFactory;
    protected $table = 'tagihan_spps';
    protected $guarded = ['id'];



    public function detail_tagihan()
    {
        return $this->hasMany(DetailTagihanSPP::class, 'id_tagihan_spp');
    }

    public function detail_tagihan_by_id()
    {
        $id_siswa = Auth::user()->id_siswa;
        return $this->hasMany(DetailTagihanSPP::class, 'id_tagihan_spp')->where('id_siswa', $id_siswa);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
