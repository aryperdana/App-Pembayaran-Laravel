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
                        {{-- <div class="custom-control custom-checkbox"> --}}
                            <input type="checkbox" class="check_box" name="check_box[]" value={{ $hasil->id }}>
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
    const arr = []
    const dataSiswa = <?php echo json_encode($data); ?>

    $('.check_box').change(function check(){

        $('.check_box').each(function(idx, el){

            if($(el).is(':checked'))
            { 
                var selectedValue = $(el).val();
                
                $.ajax({
                    type: "get",
                    dataType:"json",
                    url: "{{ route('detail-tagihan-spp.index') }}",
                    success: function (res) {
                        const data = res.tagihan.find((val) => parseInt(val.id) === parseInt(selectedValue))
                        const end = arr.length - 1;
                        arr.splice(0, end, data)
                    },
                    error: function (err) {
                        console.log("err",err);
                    }
                });
            }

        });

    });

    console.log(dataSiswa);

    

    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token

      const findDaveData = arr.map((val) => val.id_jenis_tagihan ? dataSiswa.find((item) => item.jenis_tagihan.id === val.id_jenis_tagihan) : "")
      const mapSaveData = findDaveData.map((val) => ({
        id_tagihan_spp : val.id_tagihan_spp,
        id_siswa : val.id_siswa,
        id_jenis_tagihan : val.id_jenis_tagihan,
        harga : val.harga,
        status_pembayaran : 1,
      }))
      const mapDeleteData = findDaveData.map((val) => val.id_tagihan_spp)

      $.ajax({
            type: "post",
            url: "{{ url('pembayaran/pay') }}",
            data: {
                "first_name" : dataSiswa[0].siswa.nama_siswa,
                "email" : dataSiswa[0].siswa.email,
                "phone" : dataSiswa[0].siswa.no_telp,
                    detail : arr.map((val) => ({
                        "id" : val.id,
                        "price" : val.harga,
                        "name" : val.id_jenis_tagihan ? dataSiswa.find((item) => item.jenis_tagihan.id === val.id_jenis_tagihan).jenis_tagihan.nama_jenis_tagihan : "",
                        "quantity" : 1,
                    })),
                    "_token" : "{{ csrf_token() }}"
                },
            success: function (res) {
                window.snap.pay(res, {
                    onSuccess: function(result){
                    /* You may add your own implementation here */
                    alert("payment success!"); console.log(result);
                    $.ajax({
                        type: "post",
                        url:"{{ route('pembayaran.store') }}",  
                        data:{
                            detail: mapSaveData,
                            delete: mapDeleteData,
                            "_token" : "{{ csrf_token() }}"
                        },                              
                        success: function( data ) {
                            console.log(data);
                            location.reload();
                        },
                        error: function (err) {
                        console.log("err",err);
                        }
                    });
                    },
                    onPending: function(result){
                    /* You may add your own implementation here */
                    alert("wating your payment!"); console.log(result);
                    },
                    onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                    },
                    onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                    }
                })
            },
            error: function (err) {
                console.error(err);
            }
        });
      // customer will be redirected after completing payment pop-up
    });
</script>
@endsection
