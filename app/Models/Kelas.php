<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $guarded = ['id'];

    public function detail_kelas()
    {
        return $this->hasMany(DetailKelas::class, 'id');
    }

    public function tagihanSpp()
    {
        return $this->hasOne(TagihanSpp::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
