<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTagihan extends Model
{
    use HasFactory;
    protected $table = 'jenis_tagihans';
    protected $guarded = ['id'];


    public function detailTagihanSpp()
    {
        return $this->hasOne(DetailTagihanSPP::class);
    }
}
