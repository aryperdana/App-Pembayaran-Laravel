@extends('layout.main')

@section('judul')
    Kelas
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
                <th scope="col" class="text-center">No. Tagihan</th>
                <th scope="col" class="text-center">Kode Kelas</th>
                <th scope="col" class="text-center">Tahun Ajaran</th>
                <th scope="col" class="text-center">Bulan</th>
                <th scope="col" class="text-center">Semester</th>
                <th scope="col" class="text-center">Nama Siswa</th>
                <th scope="col" class="text-center">Jenis Tagihan</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $hasil->tagihanSpp->no_tagihan }}</td>
                    <td>{{ $hasil->tagihanSpp->kelas->kode_kelas }}</td>
                    <td>{{ $hasil->tagihanSpp->kelas->tahun_ajaran }}</td>
                    <td>{{ $hasil->tagihanSpp->bulan }}</td>
                    <td>{{ $hasil->tagihanSpp->semester }}</td>
                    <td>{{ $hasil->siswa->nama_siswa }}</td>
                    <td>{{ $hasil->jenisTagihan->nama_jenis_tagihan }}</td>
                    <td>Rp. {{ number_format($hasil->harga,0, ',' , '.') }}</td>
                    <td class="text-center">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1"></label>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
<div class="d-flex justify-content-end">
    <button  class="btn btn-primary" id="pay-button">Bayar</button>
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

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $snap_token }}');
      // customer will be redirected after completing payment pop-up
    });
</script>
@endsection
