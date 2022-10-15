@extends('layout.main')

@section('judul')
    Kontak Guru
@endsection

@section('isi')
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('kontak-guru.create') }}" class="btn btn-primary px-4">Tambah</a>
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
                <th scope="col" class="text-center" style="width: 100px">Aksi</th>
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">No. Telp</th>
                <th scope="col" class="text-center">Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $hasil)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td class="text-center">
                        <form action="{{ route('kontak-guru.destroy', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('kontak-guru.edit', $hasil->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                              </div>
                        </form>
                    </td>
                    <td>{{ $hasil->nama_guru }}</td>
                    <td>{{ $hasil->nama_guru }}</td>
                    <td>{{ $hasil->nip }}</td>
                    <td>{{ $hasil->jabatan }}</td>
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
