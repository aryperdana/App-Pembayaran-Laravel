@extends('layout.main')

@section('judul')
    Jenis Tagihan
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Jenis Tagihan</b>
    <a href="{{ route('jenis-tagihan.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('jenis-tagihan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_jenis_tagihan">Jenis Tagihan</label>
                <input type="text" class="form-control" name="nama_jenis_tagihan" id="nama_jenis_tagihan" placeholder="Masukan Jenis Tagihan">
            </div>
            <div class="form-group">
                <label for="no_akun">No. Akun</label>
                <input type="number" class="form-control" name="no_akun" id="no_akun" placeholder="Masukan No Akun">
            </div>
            <div class="form-group">
                <label for="nama_akun">Nama Akun</label>
                <input type="text" class="form-control" name="nama_akun" id="nama_akun" placeholder="Masukan Nama Akun">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukan Harga">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan Keterangan">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
