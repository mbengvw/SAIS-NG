<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('piket.index') }}">SIS-MAN 2 Kuningan</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#piketNav"
            aria-controls="piketNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="piketNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('presensi.index') }}">Absensi Kehadiran</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/user.png') }}" width="35" height="35" class="rounded-circle" style="margin-right: 8px;">
                        <span>{{ Auth::user()->name ?? 'Guru Piket' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
