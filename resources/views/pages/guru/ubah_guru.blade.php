@extends('layout.main')

@section('judul')
    Guru
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Ubah Guru</b>
    <a href="{{ route('guru.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('guru.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group">
                <label for="nama_guru">Nama Kontak</label>
                <input type="text" class="form-control" name="nama_guru" id="nama_guru" value="{{ $data->nama_guru }}" placeholder="Masukan Nama Kontak">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{ $data->no_telp }}" placeholder="Masukan No. Telp">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $data->jabatan }}" placeholder="Masukan Jabatan">
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="number" class="form-control" name="nip" id="nip" value="{{ $data->nip }}" placeholder="Masukan NIP">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="path_foto">Foto Guru</label>
                    <input type="file" id="path_foto" name="path_foto" class="form-control-file" placeholder="Pilih Foto"  value="{{ $data->path_foto }}">
                </div>
            </div>
            <div>
                @if ($data->path_foto)
                <img src="{{ asset('storage/'. $data->path_foto) }}" class="img-thumbnail" style="width: 30%">                       
                @else
                <span class="badge badge-danger">Tidak Ada Foto</span>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
