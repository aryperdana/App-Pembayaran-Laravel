@extends('layout.main')

@section('judul')
    Laporan Arus Kas
@endsection

@section('isi')
{{-- <form action="" method="GET">
    <div class="d-flex justify-content-between"> 
        <div class="form-group col-4">
            <label for="">Tanggal Awal</label>
            <input type="date" placeholder="Tanggal Awal" id="start_date" name="start_date" value="{{ $start_date }}" class="form-control float-right">
        </div>
        <div class="form-group col-4">
            <label for="">Tanggal Akhir</label>
            <input type="date" placeholder="Tanggal Akhir" id="end_date" name="end_date" value="{{ $end_date }}" class="form-control float-right">
        </div>
    </div>
    <div class="d-flex justify-content-between mb-3"> 
        <div class="col-4">
            <div class="d-flex">
                <div class="input-group input-group">
                    <input type="text" name="key" class="form-control float-right"  placeholder="Cari..." value="{{ $key }}">
                </div>
                <button class="btn btn-primary ml-3">Cari</button>
            </div>
        </div>
        <div>
            <a id="export-button" class="btn btn-success">Export Excel</a>
        </div>
    </form>
    </div> --}}
<div class="d-flex justify-content-end">
    <form method="GET">
        <div class="d-flex">
            <div class="form-group">
                <select class="form-control" id="month" name="month" style="width: 300px">
                    <option value="none">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <select style="cursor:pointer;" class="form-control ml-2" id="tag_select" name="year" >
                <option value="0" selected disabled> Pilih Tahun</option>
                    <?php 
                    $year = date('Y');
                    $min = $year - 60;
                    $max = $year;
                    for( $i = $max; $i >= $min; $i-- ) {
                    echo '<option value='.$i.'>'.$i.'</option>';
                    } ?> </select>
        <button class="btn btn-primary ml-2" style="height: 37px">Cari</button>
        </div>
    </form>
</div>
<div class="card">
    <div class="card-body">
        <div class="text-center mb-4">
            <h3><b>Laporan Arus Kas</b></h3>
            <p>{{ $bulan }}</p>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row" style="width: 1000px" id="laporanData">
                <div class="col-12"><b>Arus Kas dari Pembayaran Tunggakan</b></div>
                <div class="col-9">Kas yang diterima dari pembayaran piutang tunggakan tunai</div>
                <div class="col-2" id="tunai"></div>
                <div class="col-9">Kas yang diterima dari pembayaran piutang tunggakan bank BCA</div>
                <div class="col-2" id="bca"></div>
                <div class="col-10"><b>Arus Kas dari Pembayaran Tunggakan</b></div>
                <div class="col-2"><b id="total"></b></div>
                <div class="col-10"></div>
                <div class="col-2"><b id="total2"></b></div>
            </div>
        </div>
    </div>  
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
    const data = <?php echo json_encode($data); ?>;
    const dataBCA = data.filter((val) => val.bank_transfer === "bca").reduce((prev, curr)=> (prev + parseInt(curr.harga)), 0)
    const dataTunai = data.filter((val) => val.bank_transfer === null).reduce((prev, curr)=> (prev + parseInt(curr.harga)), 0)
    const total = data.reduce((prev, curr)=> (prev + parseInt(curr.harga)), 0)

    $("#bca").append(new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(dataBCA));

    $("#tunai").append(new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(dataTunai));

    $("#total").append(new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(total));

    $("#total2").append(new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(total));
</script>
@endsection
