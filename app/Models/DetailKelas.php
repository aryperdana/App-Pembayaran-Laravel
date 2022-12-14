<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKelas extends Model
{
    use HasFactory;
    protected $table = 'detail_kelas';
    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
