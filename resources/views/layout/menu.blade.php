<li class="nav-item">
    <a href="{{ url('home') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

@if ($user->level == 1)
    {{-- <li class="nav-item">
        <a href="{{ url('kontak-guru') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Kontak Guru
            </p>
        </a>
    </li> --}}
    <li class="nav-item">
        <a href="{{ url('guru') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Guru
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('user') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Data User
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('siswa') }}" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
                Siswa
            </p>
        </a>
    </li>
 
    <li class="nav-item">
        <a href="{{ url('wali-murid') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Wali Murid
            </p>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a href="{{ url('jenis-tagihan') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Jenis Tagihan
            </p>
        </a>
    </li> --}}

    <li class="nav-item">
        <a href="{{ url('kelas') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Kelas
            </p>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a href="{{ url('tagihan-spp') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Tagihan SPP
            </p>
        </a>
    </li> --}}

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
          <p>
            Tagihan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('jenis-tagihan') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Jenis Tagihan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('tagihan-spp') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tagihan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('tagihan-lainnya') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tagihan Lainnya</p>
            </a>
          </li>
        </ul>
      </li>

    <li class="nav-item">
        <a href="{{ url('pembayaran') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Pembayaran
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
          <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('laporan-tunggakan') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Tunggakan</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ url('tagihan-spp') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tagihan</p>
            </a>
          </li> --}}
        </ul>
      </li>
@endif


@if ($user->level == 3)
    <li class="nav-item">
        <a href="{{ url('guru') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Guru
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('pembayaran') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Pembayaran
            </p>
        </a>
    </li>
@endif
