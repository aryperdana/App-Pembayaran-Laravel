@extends('layout.main')

@section('judul')
    User
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-3">
    @if ($user->level == "1")
    <a href="{{ route('user.create') }}" class="btn btn-primary px-4">Tambah</a>
    @else
    <div></div>
    @endif
    <form action="" method="GET" class="input-group input-group col-4">
        <input type="text" name="key" class="form-control float-right"  placeholder="Cari...">
        <div class="input-group-append">
            <button class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>
@error('password')
{{-- <span class="text-danger"></span> --}}
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <thead>
                <tr>
                <th scope="col" class="text-center" style="width: 30px">No.</th>
                <th scope="col" class="text-center" style="width: 100px">Aksi</th>
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td class="text-center">
                        <form action="{{ route('user.destroy', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('user.edit', $hasil->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                @if ($user->level == "1")
                                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                @endif
                                <button type="button" data-toggle="modal" id="pay-tunai-button" class="btn btn-outline-secondary" data-target="#modal-tunai">Ubah Password</button>
                              </div>
                        </form>
                    </td>
                    <td>{{ $hasil->name }}</td>
                    <td>{{ $hasil->username }}</td>
                    <td>{{ $hasil->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $data->withQueryString()->links('pagination::bootstrap-4') }}
</div>

<div class="modal" id="modal-tunai" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Passoword</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="content-modal">
        <form action="{{ route('change-password') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
               
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password">
            </div>
        
            <div class="modal-footer">
            <button id="simpan-tunai" class="btn btn-primary">Simpan</button>
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            </div>
        </form>
      </div>
    </div>
  </div>


    
    {{-- <ul class="pagination pagination m-0">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul> --}}
{{-- </div> --}}
@endsection
