<?php

namespace App\Exports;

use App\Models\DetailTagihanSPP;
use Maatwebsite\Excel\Concerns\FromCollection;

class TunggakanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    // a place to store the team dependency
    private $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function collection()
    {
        $siswa = DetailTagihanSPP::get();
        dd($siswa);
        // return DetailTagihanSPP::all();
    }
}
