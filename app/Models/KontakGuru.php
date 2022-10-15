<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakGuru extends Model
{
    use HasFactory;
    protected $table = 'kontak_guru';
    protected $guarded = ['id'];
}
