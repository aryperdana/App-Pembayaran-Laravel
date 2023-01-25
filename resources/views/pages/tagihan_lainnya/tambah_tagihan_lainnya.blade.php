@extends('layout.main')

@section('judul')
    Tagihan Lainnya
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Tagihan Lainnya</b>
    <a href="{{ route('tagihan-lainnya.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
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
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan Harga">
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
                        <label for="id_siswa">Siswa</label>
                        <select class="form-control" id="id_siswa" name="id_siswa">
                            <option value="none">Pilih Kelas Terlebih Dahulu</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="card-footer">
            <button class="btn btn-primary" id="simpan">Simpan</button>
        </div>
    {{-- </form> --}}
</div>

<script>
    $(document).ready(function () {
        const dataSiswa = []

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $("#id_kelas").change(function (e) { 
            e.preventDefault();
            $("#id_siswa option").remove(); 
            $('#id_siswa')
                .append($("<option></option>")
                .attr("value", "none")
                .text("Pilih Siswa")); 

            let id_kelas = $("#id_kelas").val()
            const siswa = <?php echo json_encode($siswa); ?>;
            const mapSiswa = siswa.filter(val => parseInt(val.id_kelas) === parseInt(id_kelas) && parseInt(val?.siswa?.status_siswa) === 0);


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
            let tenggat = $("#tenggat").val();
            let no_tagihan = "1234";
            let keterangan = "cekk 123"
            

            let dataDetail = [{
                id_siswa: id_siswa,
                id_jenis_tagihan: id_jenis_tagihan,
                harga: harga,
                tenggat: tenggat,
                status_pembayaran: 0,
                tunai: 0,
                lainnya: 1,
            }]
            $.ajax({
                type: "post",
                url: "{{ route('tagihan-lainnya.store') }}",
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
