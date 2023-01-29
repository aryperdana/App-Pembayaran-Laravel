@extends('layout.main')

@section('judul')
    Siswa
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Siswa</b>
    <a href="{{ route('siswa.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Masukan Nama Siswa">
            </div>
            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" name="nis" id="nis" placeholder="Masukan NIS">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukan No. Telp">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="status_siswa" name="status_siswa">
                <label class="form-check-label" for="status_siswa">
                  Tidak Aktif
                </label>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
