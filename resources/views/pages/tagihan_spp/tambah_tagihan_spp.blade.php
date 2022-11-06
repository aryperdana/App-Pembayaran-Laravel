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
    <form action="{{ route('tagihan-spp.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama_siswa">Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Masukan Tagihan SPP">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_siswa">Kelas</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Masukan Tagihan SPP">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan">Semester</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan Keterangan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_siswa">Bulan</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Masukan Tagihan SPP">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan">Total</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan Keterangan">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
