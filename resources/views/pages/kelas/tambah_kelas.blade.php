@extends('layout.main')

@section('judul')
    Kelas
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Kelas</b>
    <a href="{{ route('kelas.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        {{-- <form action="{{ route('siswa.store') }}" method="POST">
            @csrf --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" class="form-control" name="kode_kelas" id="kode_kelas" placeholder="Masukan Nama Kelas">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_guru">Wali Kelas</label>
                        <select class="form-control" id="id_guru" name="id_guru">
                            <option value="none">Pilih Wali Kelas</option>
                            @foreach ($guru as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_guru }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="tahun_ajaran" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Masukan Tahun Ajaran">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester">
                            <option value="none">Pilih Semester</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
        {{-- </form> --}}
        <div class="d-flex justify-content-between mb-2">
            <b>Tambah Siswa</b>
            <button class="btn btn-sm btn-success" id="tambah"><i class="fas fa-plus"></i></button>
        </div>
        <div class="row">
            <table class="table table-bordered table-hover text-nowrap" id="table_siswa">
                <thead>
                    <tr>
                    <th scope="col" class="text-center" style="width: 30px">No.</th>
                    <th scope="col" class="text-center">Nama Siswa</th>
                    <th scope="col" class="text-center" style="width: 50px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                    <td>1</td>
                    <td>
                        <div class="form-group">
                            <select class="form-control id_siswa" id="id_siswa" name="id_siswa">
                                <option value="none">Pilih Siswa</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_siswa }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger" id="hapus"><i class="fas fa-trash"></i></button>
                    </td>
                   </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" id="simpan">Simpan</button>
    </div>
</div>





<script>
    $(document).ready(function () {
        let baris = 1

        $(document).on('click', '#tambah', function () {
            baris = baris + 1

          

            var html = "<tr id='baris'" +baris+ ">"
                html += "   <td>" +baris+ "</td>"
                html += '<td><select name="id_siswa" class="form-control id_siswa" id="id_siswa"><option value="">Pilih Siswa</option><@foreach($siswa as $item)<option value="{{$item->id}}">{{$item->nama_siswa}}</option>@endforeach></select></td>'
                html += "   <td>    <button class='btn btn-sm btn-danger' data-row='baris' " +baris+ " id='hapus'>   <i class='fas fa-trash'></i>    </button>   </td>"
                html += "</tr>"  

                $('#table_siswa').append(html);
        });
        

        $(document).on('click', '#hapus', function () {
            let hapus = $(this).data('row')
            $("#" + hapus).remove();
        });

        $(document).on('click', "#simpan", function () {
            let kode_kelas = $("#kode_kelas").val();
            let id_guru = $("#id_guru").val();
            let tahun_ajaran = $("#tahun_ajaran").val();
            let semester = $("#semester").val();

            let dataSiswa = []
            // let nama_siswa

            $('.id_siswa').each(function () {
                this.value !== "" && dataSiswa.push(this.value)
            });

            $.ajax({
                type: "post",
                url: "{{ route('kelas.store') }}",
                data: {
                    kode_kelas : kode_kelas,
                    id_guru : id_guru,
                    tahun_ajaran : tahun_ajaran,
                    semester : semester,
                    detail_kelas : dataSiswa,
                    "_token" : "{{ csrf_token() }}"
                },
                success: function (res) {
                    window.location.href = "{{url('/kelas')}}";
                },
                error: function (err) {
                    console.error(err);
                }
            });
        });

    });
</script>

@endsection
