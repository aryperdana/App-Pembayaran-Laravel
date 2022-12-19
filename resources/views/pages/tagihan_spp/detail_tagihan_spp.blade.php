@extends('layout.main')

@section('judul')
    Tagihan SPP
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Detail Tagihan SPP</b>
    <a href="{{ route('tagihan-spp.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="alert alert-primary" role="alert" id="notifAlert">
    Notifikasi Berhasil Dikirim!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="card">
    {{-- <form action="{{ route('tagihan-spp.store') }}" method="POST" enctype="multipart/form-data"> --}}
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="id_jenis_tagihan">Jenis Tagihan</label>
                        <select class="form-control" id="id_jenis_tagihan" name="id_jenis_tagihan" disabled>
                            <option value="none">Pilih Jenis Tagihan</option>
                            @foreach ($jenis_tagihan as $item)
                                <option value="{{ $item->id }}" {{ ( $data->detail_tagihan[0]['id_jenis_tagihan'] == $item->id) ? 'selected' : '' }}>{{ $item->nama_jenis_tagihan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester" disabled>
                            <option value="none">Pilih Semester</option>
                            <option value="ganjil" {{ ( $data->semester == "ganjil") ? 'selected' : '' }}>Ganjil</option>
                            <option value="genap" {{ ( $data->semester == "genap") ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select class="form-control" id="bulan" name="bulan" disabled>
                            <option value="none">Pilih Bulan</option>
                            <option value="1" {{ ( $data->bulan == "1") ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ ( $data->bulan == "2") ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ ( $data->bulan == "3") ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ ( $data->bulan == "4") ? 'selected' : '' }}>April</option>
                            <option value="5" {{ ( $data->bulan == "5") ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ ( $data->bulan == "6") ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ ( $data->bulan == "7") ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ ( $data->bulan == "8") ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ ( $data->bulan == "9") ? 'selected' : '' }}>September</option>
                            <option value="10" {{ ( $data->bulan == "10") ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ ( $data->bulan == "11") ? 'selected' : '' }}>November</option>
                            <option value="12" {{ ( $data->bulan == "12") ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control getKelas" id="id_kelas" name="id_kelas" disabled>
                            <option value="none">Pilih Kelas</option>
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" {{ ( $item->id == $data->id_kelas) ? 'selected' : '' }}>{{ $item->kode_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan Harga" value="{{ $data->detail_tagihan[0]['harga'] }}" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message">Pesan Notifikasi</label>
                        <textarea class="form-control" name="message" id="message" placeholder="Masukan Pesan" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <button class="btn btn-primary btn-sm" id="send-notif">Kirim Notifikasi</button>
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
                        @foreach ($data->detail_tagihan as $no => $hasil)
                            <tr>
                                <td>{{ $no + 1}}</td>
                                <td>{{ $hasil->siswa->nama_siswa}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        

        {{-- <div class="card-footer">
            <button class="btn btn-primary" id="simpan">Simpan</button>
        </div> --}}
    {{-- </form> --}}
</div>
{{-- @dd($data->detail_tagihan) --}}

<script>
    $(document).ready(function () {
        let dataListGlobal = []
        const dataSiswa = <?php echo json_encode($data_siswa); ?>;

        let dataSiswaMaping = dataSiswa.map((val) => {
                const no_telp_edit = val?.no_telp?.split('').map((res, ind) => ind === 0 ? "+62" : res).join('')
                return {
                    ...val,
                    no_telp: no_telp_edit,
                }
            })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $("#notifAlert").hide()


        $("#send-notif").click(function (e) { 
            e.preventDefault();

            let message = $("#message").val();

            $.ajax({
                type: "post",
                url: "http://127.0.0.1:8000/tagihan-spp/send-notif",
                data: {
                    data_siswa : dataSiswaMaping,
                    message : message,
                    "_token" : "{{ csrf_token() }}"
                },
                success: function (res) {
                    $("#notifAlert").show()
                },
                error: function (err) {
                    console.error(err);
                }
            });
            
        });
        
        $(document).on('change', ".getKelas", function () {
            let id_kelas = $("#id_kelas").val();

            if (id_kelas !== 'none') {   
                $.ajax({
                    type:"get",
                    dataType:"json",
                    url: 'http://127.0.0.1:8000/tagihan-spp/kelas/' + id_kelas,
                    success:function(response){
                        let dataList = [];

                        response.data.map((val) => {
                            const obj = {
                                id_siswa: val.id_siswa,
                                nama_siswa: response.siswa.find((res) => val.id_siswa === res.id).nama_siswa
                            }
                            
                            dataList.push(obj)
                        })

                        dataListGlobal.push(...dataList)
                        dataSiswa.push(...response.siswa)

                        console.log(dataList);

                        $.each(dataList, function (key, value) {
                     
							$('#listSiswa').html("<tr>\
                                        <td>"+parseInt(key + 1)+"</td>\
										<td>"+value.nama_siswa+"</td>\
										</tr>");
						})
                    }
                }) 
            }  
        });

        


        $(document).on('click', "#simpan", function () {
            let id_jenis_tagihan = $("#id_jenis_tagihan").val();
            let id_kelas = $("#id_kelas").val();
            let bulan = $("#bulan").val();
            let semester = $("#semester").val();
            let harga = $("#harga").val();
            let no_tagihan = "1234";
            let keterangan = "cekk 123"
            

            let dataDetail = dataListGlobal.map((val) => {
                return {
                    id_siswa: val.id_siswa,
                    id_jenis_tagihan: id_jenis_tagihan,
                    harga: harga,
                    status_pembayaran: 0,
                    tunai: 0,
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
                type: "put",
                url: "{{ route('tagihan-spp.update', $data->id) }}",
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
