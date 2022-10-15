@extends('layout.main')

@section('judul')
    Kontak Guru
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Kontak Guru</b>
    <a href="{{ route('kontak-guru.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('kontak-guru.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_guru">Nama Kontak</label>
                <input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Masukan Nama Kontak">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamats">
            </div>
            <div class="form-group">
                <label for="nip">No. Telp</label>
                <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukan No. Telp">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukan Jabatan">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
