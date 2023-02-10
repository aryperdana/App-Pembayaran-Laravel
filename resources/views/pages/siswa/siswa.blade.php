@extends('layout.main')

@section('judul')
    Siswa
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-3">
    @if ($user->level == 1)
    <a href="{{ route('siswa.create') }}" class="btn btn-primary px-4">Tambah</a>
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
                @if ($user->level == 1)
                <th scope="col" class="text-center" style="width: 100px">Aksi</th>
                @endif
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">No. Telp</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    @if ($user->level == 1)
                    <td class="text-center">
                        <form action="{{ route('siswa.destroy', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('siswa.edit', $hasil->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                              </div>
                        </form>
                    </td>
                    @endif
                    <td>{{ $hasil->nama_siswa }}</td>
                    <td>{{ $hasil->no_telp }}</td>
                    <td>{{ $hasil->email }}</td>
                    <td>{{ $hasil->status_siswa == 0 ? "Aktif" : "Pindah" }}</td>
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
