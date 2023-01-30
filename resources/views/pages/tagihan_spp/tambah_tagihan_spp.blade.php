@extends('layout.main')

@section('judul')
    Tagihan SPP
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Tagihan SPP</b>
    <a href="{{ route('tagihan-spp.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    {{-- <form action="{{ route('tagihan-spp.store') }}" method="POST" enctype="multipart/form-data"> --}}
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_jenis_tagihan">Jenis Tagihan</label>
                        <select class="form-control" id="id_jenis_tagihan" name="id_jenis_tagihan">
                            <option value="none">Pilih Jenis Tagihan</option>
                            @foreach ($jenis_tagihan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_jenis_tagihan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tenggat">Tenggat</label>
                        <input type="date" class="form-control" name="tenggat" id="tenggat" placeholder="Masukan Tenggat">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester">
                            <option value="none">Pilih Semester</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select class="form-control" id="bulan" name="bulan">
                            <option value="none">Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control getKelas" id="id_kelas" name="id_kelas">
                            <option value="none">Pilih Kelas</option>
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->kode_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan Harga">
                    </div>
                </div>
            </div>

            <div class="row">
                <table class="table table-bordered table-hover text-nowrap" id="table_siswa">
                    <thead>
                        <tr>
                        <th scope="col" class="text-center" style="width: 30px">No.</th>
                        <th scope="col" class="text-center">Nama Siswa</th>
                        </tr>
                    </thead>
                    <tbody id="listSiswa">
                    </tbody>
                </table>
            </div>

        </div>

        

        <div class="card-footer">
            <button class="btn btn-primary" id="simpan">Simpan</button>
        </div>
    {{-- </form> --}}
</div>

<script>
    $(document).ready(function () {
        let dataListGlobal = []
        const dataSiswa = []
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        // $('#listSiswa').append("<tr>\
        //         <td colSpan='2' class='text-center align-middle' height='100'><b>Pilih Kelas</b></td>\
        //         </tr>");

        
        $(document).on('change', ".getKelas", function () {
            let id_kelas = $("#id_kelas").val();

            if (id_kelas !== 'none') {   
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    url: 'kelas/' + id_kelas,
                    success:function(response){
                        let dataList = [];

                        $("#listSiswa tr").remove(); 
                        // console.log("response", response.siswa);

                        response.data.map((val) => {
                            const nama_siswa = response.siswa.find((res) => val.id_siswa === res.id)?.nama_siswa
                            if (nama_siswa) {
                                const obj = {
                                    id_siswa: val.id_siswa,
                                    nama_siswa: nama_siswa,
                                }
                            dataList.push(obj)
                            }
                           
                           

                            
                        })

                        dataListGlobal.push(...dataList)
                        dataSiswa.push(...response.siswa)

                       
                        $.each(dataList, function (key, value) {
                     
							$('#listSiswa').append("<tr>\
                                        <td>"+parseInt(key + 1)+"</td>\
										<td>"+value.nama_siswa+"</td>\
										</tr>");
						})
                    }
                }) 
            }  
        });

        $("#id_jenis_tagihan").change(function (e) { 
            e.preventDefault();
            const id_jenis_tagihan = $("#id_jenis_tagihan").val();
            const jenis = <?php echo json_encode($jenis_tagihan); ?>;

            const filterHarga = jenis.find(val => parseInt(id_jenis_tagihan) === parseInt(val.id)).harga

            $("#harga").val(filterHarga);
            
        });

        $(document).on('click', "#simpan", function () {
            let id_jenis_tagihan = $("#id_jenis_tagihan").val();
            let id_kelas = $("#id_kelas").val();
            let bulan = $("#bulan").val();
            let semester = $("#semester").val();
            let harga = $("#harga").val();
            let no_tagihan = "1234";
            let keterangan = "cekk 123"
            let tenggat = $("#tenggat").val();
            

            let dataDetail = dataListGlobal.map((val) => {
                return {
                    id_siswa: val.id_siswa,
                    id_jenis_tagihan: id_jenis_tagihan,
                    harga: harga,
                    status_pembayaran: 0,
                    tunai: 0,
                    lainnya: 0,
                    tenggat:tenggat,
                }
            });

            let dataSiswaMaping = dataSiswa.map((val) => {
                const no_telp_edit = val?.no_telp?.split('').map((res, ind) => ind === 0 ? "+62" : res).join('')
                return {
                    ...val,
                    no_telp: no_telp_edit,
                }
            })

            $.ajax({
                type: "post",
                url: "{{ route('tagihan-spp.store') }}",
                data: {
                    id_kelas : id_kelas,
                    bulan : bulan,
                    semester : semester,
                    harga : harga,
                    no_tagihan : no_tagihan,
                    keterangan : keterangan,
                    detail_tagihan : dataDetail,
                    data_siswa : dataSiswaMaping,
                    "_token" : "{{ csrf_token() }}"
                },
                success: function (res) {
                    window.location.href = "{{url('/tagihan-spp')}}";
                },
                error: function (err) {
                    console.error(err);
                }
            });
        });

    });
</script>


@endsection
