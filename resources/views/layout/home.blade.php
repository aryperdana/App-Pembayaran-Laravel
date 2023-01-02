@extends('layout.main')

@section('judul')
    Dashboard
@endsection

@section('isi')
@if ($user->level == 1)
<div class="d-flex">
    <div class="card" style="width: 18rem">
        <div class="card-body">
            <div class="d-flex">
                <i class="nav-icon fas fa-user" style="font-size: 50px"></i>
                <div class="ml-4">
                    <div><b>Jumlah Siswa</b></div>
                    <div>{{ $jumlah_siswa }} Orang</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card ml-3" style="width: 18rem">
        <div class="card-body">
            <div class="d-flex">
                <i class="nav-icon fas fa-users" style="font-size: 50px"></i>
                <div class="ml-4">
                    <div><b>Jumlah User</b></div>
                    <div>{{ $jumlah_user }} Orang</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    {{-- <div class="card-header">
        <h3 class="card-title">Dashboard</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div> --}}
    
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div style="width: 500px">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer">
        Footer
    </div> --}}
    <!-- /.card-footer-->
</div>
@endif
@if ($user->level == 2)
<div class="card">
    <div class="card-body">
        <h3>Selamat Datang!</h3>
    </div>
</div>
<div class="d-flex">
    <div class="card" style="width: 40rem">
        <div class="card-body">
            <div class="d-flex">
                <i class="nav-icon fas fa-user" style="font-size: 50px"></i>
                <div class="ml-4">
                    <div class="d-flex">
                        <div style="width: 60px"><b>Nama</b></div>
                        <div class="mx-3"><b>:</b></div>
                        <div><b>{{ $guru[0]->nama_guru }}</b></div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 60px"><b>NIP</b></div>
                        <div class="mx-3"><b>:</b></div>
                        <div><b>{{ $guru[0]->nip }}</b></div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 60px"><b>Jabatan</b></div>
                        <div class="mx-3"><b>:</b></div>
                        <div><b>{{ $guru[0]->jabatan }}</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card ml-3" style="width: 40rem">
        <div class="card-body">
            <div class="d-flex">
                <i class="nav-icon fas fa-file" style="font-size: 50px"></i>
                <div class="ml-4">
                    <div><b>Jumlah Tunggakan</b></div>
                    <div>{{ $jumlah_tunggakan }} Tunggakan</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    
    <script>
        const ctx = document.getElementById('myChart');

        const dataSiswa = <?php echo json_encode($siswa); ?>;
        const cekSiswaHasTagihanFilter = dataSiswa.map(val => ({...val,
            detail_tagihan_s_p_p : val.detail_tagihan_s_p_p.filter(res => res.status_pembayaran === 0)
        }));
        const cekSiswaHasTagihan = cekSiswaHasTagihanFilter.map(val => ({
            ...val, hasTagihan : val.detail_tagihan_s_p_p.length > 0 ? true : false
        }))

        const siswaHasTagihan = cekSiswaHasTagihan.filter(val => val.hasTagihan === true).length
        const siswaDontHasTagihan = cekSiswaHasTagihan.filter(val => val.hasTagihan === false).length
        
      
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Siswa Yang Tidak Memilik Tunggakan', 'Siswa Yang Memiliki Tunggakan'],
            datasets: [{
              label: 'Jumlah',
              data: [siswaDontHasTagihan, siswaHasTagihan],
              borderWidth: 1
            }]
          },
          
          options: {
            // scales: {
            //   y: {
            //     beginAtZero: true
            //   }
            // },
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Persentase Siswa Yang Menunggak'
                },
            },
        }
        });
      </script>
       
@endsection
