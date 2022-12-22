@extends('layout.main')

@section('judul')
    Tagihan Lainnya
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Detail Tagihan Lainnya</b>
    <a href="{{ route('tagihan-lainnya.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_jenis_tagihan">Jenis Tagihan</label>
                        <select class="form-control" id="id_jenis_tagihan" name="id_jenis_tagihan" disabled>
                            <option value="none">Pilih Jenis Tagihan</option>
                            @foreach ($jenis_tagihan as $item)
                                <option value="{{ $item->id }}" {{ ( $data->id_jenis_tagihan == $item->id) ? 'selected' : '' }}>{{ $item->nama_jenis_tagihan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan Harga" value="{{ $data->harga }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester" disabled>
                            <option value="none">Pilih Semester</option>
                            <option value="ganjil" {{ ( $data->tagihanSpp->semester == "ganjil") ? 'selected' : '' }}>Ganjil</option>
                            <option value="genap" {{ ( $data->tagihanSpp->semester == "genap") ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select class="form-control" id="bulan" name="bulan" disabled>
                            <option value="none">Pilih Bulan</option>
                            <option value="1" {{ ( $data->tagihanSpp->bulan == "1") ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ ( $data->tagihanSpp->bulan == "2") ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ ( $data->tagihanSpp->bulan == "3") ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ ( $data->tagihanSpp->bulan == "4") ? 'selected' : '' }}>April</option>
                            <option value="5" {{ ( $data->tagihanSpp->bulan == "5") ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ ( $data->tagihanSpp->bulan == "6") ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ ( $data->tagihanSpp->bulan == "7") ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ ( $data->tagihanSpp->bulan == "8") ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ ( $data->tagihanSpp->bulan == "9") ? 'selected' : '' }}>September</option>
                            <option value="10" {{ ( $data->tagihanSpp->bulan == "10") ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ ( $data->tagihanSpp->bulan == "11") ? 'selected' : '' }}>November</option>
                            <option value="12" {{ ( $data->tagihanSpp->bulan == "12") ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                </div>
                {{-- @dd($data) --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control getKelas" id="id_kelas" name="id_kelas" disabled>
                            <option value="none">Pilih Kelas</option>
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" {{ ( $item->id == $data->tagihanSpp->id_kelas) ? 'selected' : '' }}>{{ $item->kode_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_siswa">Siswa</label>
                        <select class="form-control" id="id_siswa" name="id_siswa" disabled>
                            <option value="none">Pilih Kelas Terlebih Dahulu</option>
                        </select>
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
        </div>
        

        

        {{-- <div class="card-footer">
            <button class="btn btn-primary" id="simpan">Simpan</button>
        </div> --}}
    {{-- </form> --}}
</div>

<script>
    $(document).ready(function () {
        const dataSiswa = []
        const idKelas = <?php echo json_encode($data->tagihanSpp->id_kelas); ?>;
        const idSiswa = <?php echo json_encode($data->id_siswa); ?>;
        const siswa = <?php echo json_encode($siswa); ?>;

      

        let dataSiswaMaping = siswa.map((val) => {
                const no_telp_edit = val.siswa?.no_telp?.split('').map((res, ind) => ind === 0 ? "+62" : res).join('')
                console.log(no_telp_edit);
                return {
                    ...val.siswa,
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


        if (idKelas) {
            $("#id_siswa option").remove(); 
            $('#id_siswa')
                .append($("<option></option>")
                .attr("value", "none")
                .text("Pilih Siswa"));

            const mapSiswa = siswa.filter(val => parseInt(val.id_kelas) === parseInt(idKelas    ));
            $.each(mapSiswa, function(key, value) {   
                $('#id_siswa')
                .append($("<option></option>")
                .attr("value", value.id_siswa)
                .attr("selected", idSiswa === value.id_siswa ? true : false)
                .text(value.siswa.nama_siswa)); 
            });
        }



        $("#id_kelas").change(function (e) { 
            e.preventDefault();
            $("#id_siswa option").remove(); 
            $('#id_siswa')
                .append($("<option></option>")
                .attr("value", "none")
                .text("Pilih Siswa")); 

            let id_kelas = $("#id_kelas").val()
            const mapSiswa = siswa.filter(val => parseInt(val.id_kelas) === parseInt(id_kelas));

            $.each(mapSiswa, function(key, value) {   
                $('#id_siswa')
                .append($("<option></option>")
                .attr("value", value.id_siswa)
                .text(value.siswa.nama_siswa)); 
            });
        });


        $(document).on('click', "#simpan", function () {
            let id_jenis_tagihan = $("#id_jenis_tagihan").val();
            let id_kelas = $("#id_kelas").val();
            let id_siswa = $("#id_siswa").val()
            let bulan = $("#bulan").val();
            let semester = $("#semester").val();
            let harga = $("#harga").val();
            let no_tagihan = "1234";
            let keterangan = "cekk 123"
            

            let dataDetail = [{
                id_siswa: id_siswa,
                id_jenis_tagihan: id_jenis_tagihan,
                harga: harga,
                status_pembayaran: 0,
                tunai: 0,
                lainnya: 1,
            }]

            $.ajax({
                type: "put",
                url: "{{ route('tagihan-lainnya.update', $data->tagihanSPP->id) }}",
                data: {
                    id_kelas : id_kelas,
                    bulan : bulan,
                    semester : semester,
                    harga : harga,
                    no_tagihan : no_tagihan,
                    keterangan : keterangan,
                    detail_tagihan : dataDetail,
                    "_token" : "{{ csrf_token() }}"
                },
                success: function (res) {
                    window.location.href = "{{url('/tagihan-lainnya')}}";
                },
                error: function (err) {
                    console.error(err);
                }
            });
        });

    });
</script>


@endsection
