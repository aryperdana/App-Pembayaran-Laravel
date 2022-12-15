<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'gurus';
    protected $guarded = ['id'];

    public function detail_kelas()
    {
        return $this->hasOne(Kelas::class);
    }
}
