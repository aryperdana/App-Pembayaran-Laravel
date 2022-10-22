@extends('layout.main')

@section('judul')
    Guru
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Guru</b>
    <a href="{{ route('guru.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_guru">Nama Guru</label>
                <input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Masukan Nama Guru">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukan No. Telp">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukan Jabatan">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="path_foto">Foto Guru</label>
                    <input type="file" id="path_foto" name="path_foto" class="form-control-file" placeholder="Pilih Foto">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
