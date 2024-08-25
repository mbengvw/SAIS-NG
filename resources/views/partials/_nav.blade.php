<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <a class="navbar-brand" href="#">SIS-MAN 2 Kuningan</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Master Data<span class="sr-only"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('siswa.index') }}">Master Siswa</a>
                        <a class="dropdown-item" href="{{ route('kelas.index') }}">Master Kelas</a>
                        <a class="dropdown-item" href="{{ route('tahun.index') }}">Tahun Akademik</a>
                        <hr>
                        <a class="dropdown-item" href="{{ route('userman.index') }}">Manajemen User</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transaksi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('grouping.index') }}">Pengkelasan</a>
                        <a class="dropdown-item" href="{{ route('setwalas.index') }}">Penetapan Walikelas</a>
                        <hr>
                        <a class="dropdown-item" href="{{ route('presensi.index') }}">Absensi Kehadiran</a>
                        <a class="dropdown-item" href="{{ route('hukdis.index') }}">Pelanggaran Disiplin</a>
                    </div>
                </li>

                <li class="nav-item dropdown" style="margin-right: 20px;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('presensi.show_all') }}">Kehadiran Siswa</a>
                        <a class="dropdown-item" href="{{ route('presensi.rekap') }}">Rekap Kehadiran Siswa</a>
                        <a class="dropdown-item" href="{{ route('hukdisman.index') }}">Pelanggaran</a>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout <span class="sr-only"></span></a>
                </li> --}}


            </ul>
            <li class="nav-item dropdown">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/user.png') }}" width="40" height="40" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                    </div>
                </div>
            </li>

        </div>
    </div>

</nav>
