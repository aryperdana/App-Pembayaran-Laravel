<?php

namespace App\Exports;

use App\Models\DetailTagihanSPP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TunggakanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // use Exportable;

    // a place to store the data dependency
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($member): array
    {
        $bulan = "";
        $semester = "";

        if ($member->tagihanSpp->bulan == "1") {
            $bulan = "Januari";
        }
        if ($member->tagihanSpp->bulan == "2") {
            $bulan = "Februari";
        }
        if ($member->tagihanSpp->bulan == "3") {
            $bulan = "Maret";
        }
        if ($member->tagihanSpp->bulan == "4") {
            $bulan = "April";
        }
        if ($member->tagihanSpp->bulan == "5") {
            $bulan = "Mei";
        }
        if ($member->tagihanSpp->bulan == "6") {
            $bulan = "Juni";
        }
        if ($member->tagihanSpp->bulan == "7") {
            $bulan = "Juli";
        }
        if ($member->tagihanSpp->bulan == "8") {
            $bulan = "Agustus";
        }
        if ($member->tagihanSpp->bulan == "9") {
            $bulan = "September";
        }
        if ($member->tagihanSpp->bulan == "10") {
            $bulan = "Oktober";
        }
        if ($member->tagihanSpp->bulan == "11") {
            $bulan = "November";
        }
        if ($member->tagihanSpp->bulan == "12") {
            $bulan = "Desember";
        }
 
        return[
            $member->tagihanSpp->kelas->kode_kelas,
            $member->tagihanSpp->kelas->tahun_ajaran,
            $bulan,
            $member->tagihanSpp->semester == "ganjil" ? "Ganjil" : "Genap",
            $member->siswa->nama_siswa,
            $member->jenisTagihan->nama_jenis_tagihan,
            $member->harga,
            $member->status_pembayaran == 1 ? "Lunas" : "Belum Lunas"
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Kelas',
            'Tahun Ajaran',
            'Bulan',
            'Semester',
            'Nama Siswa',
            'Jenis Tagihan',
            'Harga',
            'Status Pembayaran'
        ];
    }
}
