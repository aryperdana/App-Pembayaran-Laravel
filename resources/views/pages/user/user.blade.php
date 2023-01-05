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
                                <button type="button" data-toggle="modal" id="changePassword" name="changePassword" value="{{ $hasil->id }}" class="btn btn-outline-secondary" data-target="#change_pass">Ubah Password</button>
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

<div class="modal" id="change_pass" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Passoword</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="content-modal">
        {{-- <form action="{{ route('change-password') }}" method="POST">
            @csrf --}}
            <div id="succesPass">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
                <span class="text-danger" id="errorMsg"></span>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password">
            </div>
        
            <div class="modal-footer">
            <button id="simpan" class="btn btn-primary">Simpan</button>
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            </div>
        {{-- </form> --}}
      </div>
    </div>
  </div>
<script type="text/javascript">
    let id = []
    $("#changePassword").click(function (e) { 
        e.preventDefault();
        id.push(e.target.value);
    });

    $(document).on('click', "#simpan", function () {
        let password = $("#password").val();
        let password_confirmation = $("#password_confirmation").val();
            $.ajax({
                type: "post",
                url: "{{ route('change-password') }}",
                data: {
                    id : id,
                    password: password,
                    password_confirmation: password_confirmation,
                    "_token" : "{{ csrf_token() }}"
                },
                success: function (res) {
                    $("#succesPass").html('<div class="alert alert-success" role="alert">Password Berhasil Diubah!</div>');
                },
                error: function (err) {
                    $("#errorMsg").append(err?.responseJSON?.message);
                }
            });
        });
</script>
@endsection
