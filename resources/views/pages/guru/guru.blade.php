@extends('layout.main')

@section('judul')
    Guru
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-3">
    @if ($user->id_siswa == "0" && $user->level != 2)
    <a href="{{ route('guru.create') }}" class="btn btn-primary px-4">Tambah</a>  
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
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <thead>
                <tr>
                <th scope="col" class="text-center" style="width: 30px">No.</th>
                @if ($user->id_siswa == "0" && $user->level != 2)
                <th scope="col" class="text-center" style="width: 100px">Aksi</th>
                @endif
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">NIP</th>
                <th scope="col" class="text-center">No. Telp</th>
                <th scope="col" class="text-center">Jabatan</th>
                <th scope="col" class="text-center">Foto Guru</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    @if ($user->id_siswa == "0" && $user->level != 2)
                    <td class="text-center">
                        <form action="{{ route('guru.destroy', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('guru.edit', $hasil->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                              </div>
                        </form>
                    </td>
                    @endif
                    <td>{{ $hasil->nama_guru }}</td>
                    <td>{{ $hasil->nip }}</td>
                    <td>{{ $hasil->no_telp }}</td>
                    <td>{{ $hasil->jabatan }}</td>
                    <td class="text-center px-0" style="width: 300px">
                        @if ($hasil->path_foto)
                        <img src="{{ asset('storage/'. $hasil->path_foto) }}" class="img-thumbnail" style="width: 80%">                       
                        @else
                        <span class="badge badge-danger">Tidak Ada Foto</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $data->withQueryString()->links('pagination::bootstrap-4') }}
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
