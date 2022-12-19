@extends('layout.main')

@section('judul')
    Tagihan SPP
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('tagihan-spp.create') }}" class="btn btn-primary px-4">Tambah</a>
    <form action="" method="GET" class="input-group input-group col-4">
        <input type="text" name="key" class="form-control float-right"  placeholder="Cari...">
        <div class="input-group-append">
            <button class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <thead>
                <tr>
                    <th scope="col" class="text-center" style="width: 30px">No.</th>
                    <th scope="col" class="text-center" style="width: 100px">Aksi</th>
                    <th scope="col" class="text-center">Kelas</th>
                    <th scope="col" class="text-center">Semester</th>
                    <th scope="col" class="text-center">Bulan</th>
                    {{-- <th scope="col" class="text-center">Keterangan</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td class="text-center">
                        <form action="{{ route('tagihan-spp.destroy', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('tagihan-spp.show', $hasil->id) }}" class="btn btn-outline-info"><i class="fas fa-file"></i></a>
                                <a href="{{ route('tagihan-spp.edit', $hasil->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </form>
                    </td>
                    <td>{{ $hasil->kelas->kode_kelas  }}</td>
                    <td>{{ $hasil->semester }}</td>
                    <td> 
                        @if ($hasil->bulan == "1")
                            Januari
                        @endif
                        @if ($hasil->bulan == "2")
                            Februari
                        @endif
                        @if ($hasil->bulan == "3")
                            Maret
                        @endif
                        @if ($hasil->bulan == "4")
                            April
                        @endif
                        @if ($hasil->bulan == "5")
                            Mei
                        @endif
                        @if ($hasil->bulan == "6")
                            Juni
                        @endif
                        @if ($hasil->bulan == "7")
                            Juli
                        @endif
                        @if ($hasil->bulan == "8")
                            Agustus
                        @endif  
                        @if ($hasil->bulan == "9")
                            September
                        @endif
                        @if ($hasil->bulan == "10")
                            Oktober
                        @endif
                        @if ($hasil->bulan == "11")
                            November
                        @endif
                        @if ($hasil->bulan == "12")
                            Desember
                        @endif
                    </td>
                    {{-- <td>{{ $hasil->keterangan }}</td> --}}
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
