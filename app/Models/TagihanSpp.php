<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanSpp extends Model
{
    use HasFactory;
    protected $table = 'tagihan_spps';
    protected $guarded = ['id'];

    public function detail_tagihan()
    {
        return $this->hasMany(DetailTagihanSPP::class);
    }
}
