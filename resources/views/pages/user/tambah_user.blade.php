@extends('layout.main')

@section('judul')
    User
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Data User</b>
    <a href="{{ route('user.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama User</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama User">
            </div>
            <div class="d-flex">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="siswaShow">
                    <label class="form-check-label" for="siswaShow">
                    Sebagai Siswa
                    </label>
                </div>
                <div class="form-check mb-2 ml-3">
                    <input class="form-check-input" type="checkbox" id="guruShow">
                    <label class="form-check-label" for="guruShow">
                    Sebagai Guru
                    </label>
                </div>
            </div>
            <div class="form-group" id="siswaInput" style="display: none">
                <label for="id_siswa">Siswa</label>
                <select class="form-control" id="id_siswa" name="id_siswa">
                    <option value="none">Pilih Siswa</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}" usernameAttr="{{ $item->nis }}">{{ $item->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="guruInput" style="display: none">
                <label for="id_guru">Guru</label>
                <select class="form-control" id="id_guru" name="id_guru">
                    <option value="none">Pilih Guru</option>
                    @foreach ($data_guru as $item)
                        <option value="{{ $item->id }}" usernameAttr="{{ $item->nip }}">{{ $item->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
                <label for="level">Role</label>
                <select class="form-control" id="level" name="level">
                    <option value="none">Pilih Role</option>
                    <option value="1">Bendahara</option>
                    <option value="2">Wali Kelas</option>
                    <option value="3">Murid</option>
                </select>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script type="text/javascript">
 $(document).ready(()=>
 {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

     $("#siswaShow").click(
         function (e) {
            if (document.getElementById("siswaShow").checked) {
                $("#siswaInput").show();
                $('#username').attr('readonly', true);

                $("#id_siswa").change(function () { 
                    $("#username").val($(this).find('option:selected').attr("usernameAttr"));
                }).change();

            } else {
                $("#siswaInput").hide();
                $('#username').attr('readonly', false); 
            }   
        }
    )

    $("#guruShow").click(
         function (e) {
            if (document.getElementById("guruShow").checked) {
                $("#guruInput").show();
                $('#username').attr('readonly', true);

                $("#id_guru").change(function () { 
                    $("#username").val($(this).find('option:selected').attr("usernameAttr"));
                }).change();

            } else {
                $("#guruInput").hide();
                $('#username').attr('readonly', false); 
            }   
        }
    )
})
</script>

@endsection
