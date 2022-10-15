@extends('layout.main')

@section('judul')
    User
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-2">
    <b>Ubah Data User</b>
    <a href="{{ route('user.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
<div class="card">
    <form action="{{ route('user.update', $data->id) }}" method="POST">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama User</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" placeholder="Masukan Nama User">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ $data->username }}" placeholder="Masukan Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $data->email }}" id="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
                <label for="level">Role</label>
                <select class="form-control" id="level"  name="level" selected="{{ $data->level }}">
                    <option value="none">Pilih Role</option>
                    <option value="1">Bendahara</option>
                    <option value="2">Wali Kelas</option>
                </select>
              </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
