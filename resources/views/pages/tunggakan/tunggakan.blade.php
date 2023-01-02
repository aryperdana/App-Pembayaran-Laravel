@extends('layout.main')

@section('judul')
    Pembayaran
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-3">
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <thead>
                <tr>
                <th scope="col" class="text-center" style="width: 30px">No.</th>
                {{-- <th scope="col" class="text-center">No. Tagihan</th> --}}
                <th scope="col" class="text-center">Kode Kelas</th>
                <th scope="col" class="text-center">Tahun Ajaran</th>
                <th scope="col" class="text-center">Bulan</th>
                <th scope="col" class="text-center">Semester</th>
                <th scope="col" class="text-center">Nama Siswa</th>
                <th scope="col" class="text-center">Jenis Tagihan</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Tenggat</th>
                <th scope="col" class="text-center">Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    {{-- <td>{{ $hasil->tagihanSpp->no_tagihan }}</td> --}}
                    <td>{{ $hasil->tagihanSpp->kelas->kode_kelas }}</td>
                    <td>{{ $hasil->tagihanSpp->kelas->tahun_ajaran }}</td>
                    <td>
                        @if ($hasil->tagihanSpp->bulan == "1")
                            Januari
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "2")
                            Februari
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "3")
                            Maret
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "4")
                            April
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "5")
                            Mei
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "6")
                            Juni
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "7")
                            Juli
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "8")
                            Agustus
                        @endif  
                        @if ($hasil->tagihanSpp->bulan == "9")
                            September
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "10")
                            Oktober
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "11")
                            November
                        @endif
                        @if ($hasil->tagihanSpp->bulan == "12")
                            Desember
                        @endif
                    </td>
                    <td>{{ $hasil->tagihanSpp->semester }}</td>
                    <td>{{ $hasil->siswa->nama_siswa }}</td>
                    <td>{{ $hasil->jenisTagihan->nama_jenis_tagihan }}</td>
                    <td>Rp. {{ number_format($hasil->harga,0, ',' , '.') }}</td>
                    <td>{{ $hasil->tenggat }}</td>
                    <td class="text-center" style="width: 100px">
                        @if ($hasil->status_pembayaran === 1)
                            <button disabled class="btn btn-sm btn-outline-success btn-block">Lunas</button>
                        @else
                            <button disabled class="btn btn-sm btn-outline-danger btn-block">Belum Lunas</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
<div class="d-flex justify-content-center mt-3">
    {{-- {{ $data->withQueryString()->links('pagination::bootstrap-4') }} --}}
</div>


    
    {{-- <ul class="pagination pagination m-0">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul> --}}
{{-- </div> --}}

@endsection
