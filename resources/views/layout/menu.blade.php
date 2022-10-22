<li class="nav-item">
    <a href="{{ url('home') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

@if ($user->level == 1)
    <li class="nav-item">
        <a href="{{ url('kontak-guru') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Kontak Guru
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
        <a href="{{ url('guru') }}" class="nav-link">
            <i class="nav-icon fas fa-credit-card"></i>
            <p>
                Guru
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('kontak-guru') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Wali Murid
            </p>
        </a>
    </li>
@endif
