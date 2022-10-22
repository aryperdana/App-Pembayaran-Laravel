@extends('layout.main')

@section('judul')
    Wali Murid
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Tambah Wali Murid</b>
    <a href="{{ route('wali-murid.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('wali-murid.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_wali">Nama Wali Murid</label>
                <input type="text" class="form-control" name="nama_wali" id="nama_wali" placeholder="Masukan Nama Wali Murid">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukan No. Telp">
            </div>
            <div class="form-group">
                <label for="level">Siswa</label>
                <select class="form-control" id="id_siswa" name="id_siswa">
                    <option value="none">Pilih Siswa</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
