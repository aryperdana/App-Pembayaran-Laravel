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
                <th scope="col" class="text-center">Aksi</th>
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
                    <td class="text-center">
                        <input type="checkbox" class="check_box" value={{ $hasil->id }}>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
<div class="d-flex justify-content-end">
    @if ($user->id_siswa == "0")
        <button type="button" data-toggle="modal" id="pay-tunai-button" class="btn btn-primary" data-target="#modal-tunai">Bayar</button>
    @else
        <button  class="btn btn-primary" id="pay-button">Bayar</button>
    @endif  
</div>
<div class="d-flex justify-content-center mt-3">
    {{-- {{ $data->withQueryString()->links('pagination::bootstrap-4') }} --}}
</div>


{{-- Modal --}}
<div class="modal" id="modal-tunai" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pembayaran Tunai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="content-modal">
            <p>Pembayaran akan dilakukan secara tunai untuk Siswa Berikut :</p>
            <table class="table table-bordered table-hover text-nowrap" id="modal-table">
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
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </p>
        <div class="modal-footer">
          <button id="simpan-tunai" class="btn btn-primary">Simpan</button>
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
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
    const arr = []
    const idSelected = []
    const dataSiswa = <?php echo json_encode($data); ?>;
   

    const user = <?php echo json_encode($user); ?>;

     
    $('.check_box').change(function check(){

        $('.check_box').each(function(idx, el){

            if($(el).is(':checked'))
            { 
                if (user.id_siswa === 0) {
                    var searchIDs = $('input:checked').map(function(){

                    return $(this).val();

                    }).get();
                    

                    const start = parseInt(searchIDs.length - 1)
                    console.log("data", searchIDs);
                    console.log("length", start);
                    searchIDs.splice(start, 1)
                    console.log("cek", searchIDs);
                    idSelected.splice(0, idSelected.length, ...searchIDs);

                } else {
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
               
            }

        });

    });

    

    $('#pay-tunai-button').click(function (e) { 
        console.log("idSelected", idSelected);
        const mapDataSelected = idSelected.map((val) => {
            const dataSelected = dataSiswa.find((res) => parseInt(res.id) === parseInt(val))
            return {
                kode_kelas : dataSelected?.tagihan_spp?.kelas?.kode_kelas,
                tahun_ajaran : dataSelected?.tagihan_spp?.kelas?.tahun_ajaran,
                bulan : dataSelected?.tagihan_spp?.bulan === "1" ? "Janurari" :
                dataSelected?.tagihan_spp?.bulan === "2" ? "Februari" :
                dataSelected?.tagihan_spp?.bulan === "3" ? "Maret" :
                dataSelected?.tagihan_spp?.bulan === "4" ? "April" :
                dataSelected?.tagihan_spp?.bulan === "5" ? "May" :
                dataSelected?.tagihan_spp?.bulan === "6" ? "Juni" :
                dataSelected?.tagihan_spp?.bulan === "7" ? "Juli" : 
                dataSelected?.tagihan_spp?.bulan === "8" ? "Agustus" : 
                dataSelected?.tagihan_spp?.bulan === "9" ? "September" : 
                dataSelected?.tagihan_spp?.bulan === "10" ? "Okteber" :
                dataSelected?.tagihan_spp?.bulan === "11" ? "November" : "Desember" ,
                semester : dataSelected?.tagihan_spp?.semester,
                nama_siswa : dataSelected?.siswa?.nama_siswa,
                nama_jenis_tagihan: dataSelected?.jenis_tagihan?.nama_jenis_tagihan,
                harga : dataSelected.harga,
            }
        })


        console.log(mapDataSelected);
        var newtr = '';
        
        for (i = 0; i < mapDataSelected.length; i++) {
            
            newtr += '<tr>';
                newtr += '<td>'+ parseInt(i + 1) + '</td>';
                newtr += '<td>'+ mapDataSelected[i].kode_kelas + '</td>';
                newtr += '<td>'+ mapDataSelected[i].tahun_ajaran + '</td>';
                newtr += '<td>'+ mapDataSelected[i].bulan + '</td>';
                newtr += '<td>'+ mapDataSelected[i].semester + '</td>';
                newtr += '<td>'+ mapDataSelected[i].nama_siswa + '</td>';
                newtr += '<td>'+ mapDataSelected[i].nama_jenis_tagihan + '</td>';
                newtr += '<td>'+ mapDataSelected[i].harga + '</td>';
            newtr += '</tr>';
            }
            $('#modal-table tbody').html(newtr);
        console.log("after",mapDataSelected);

        idSelected.map((val) => {
            $.ajax({
                type: "get",
                dataType:"json",
                url: "{{ route('detail-tagihan-spp.index') }}",
                success: function (res) {
                    console.log(val, res);
                    const data = res.tagihan.find((item) => parseInt(item.id) === parseInt(val))
                    // const end = arr.length - 1;
                    arr.splice(0, 0, data)
                },
                error: function (err) {
                    console.log("err",err);
                }
            });
        })
       
        
    });


    $('#simpan-tunai').click(function (e) { 
        const findDaveData = arr.map((val) =>  dataSiswa.find((item) => item.id === val.id))
        const mapSaveData = findDaveData.map((val) => ({
            id_tagihan_spp : val.id_tagihan_spp,
            id_siswa : val.id_siswa,
            id_jenis_tagihan : val.id_jenis_tagihan,
            harga : val.harga,
            status_pembayaran : 1,
            tunai : 1,
            lainnya: val.lainnya,
            tenggat: val.tenggat,
            bank_transfer: null,
        }))
        const mapDeleteData = findDaveData.map((val) => val.id)

        console.log("seve", mapSaveData);
        console.log("delete", mapDeleteData);

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
    });

    

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
        tunai : 0,
        lainnya: val.lainnya,
        tenggat: val.tenggat,
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
                    alert("payment success!"); console.log(result?.va_numbers[0].bank);
                    const detailSave = mapSaveData.map(val => ({...val, bank_transfer:result?.va_numbers[0].bank})) 
                    $.ajax({
                        type: "post",
                        url:"{{ route('pembayaran.store') }}",  
                        data:{
                            detail: detailSave,
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
