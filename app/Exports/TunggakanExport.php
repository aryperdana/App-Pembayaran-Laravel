<?php

namespace App\Exports;

use App\Models\DetailTagihanSPP;
use Maatwebsite\Excel\Concerns\FromCollection;

class TunggakanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetailTagihanSPP::all();
    }
}
