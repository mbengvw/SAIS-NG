<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <a class="navbar-brand" href="#">SIS-MAN 2 Kuningan</a>


            <li class="nav-item dropdown">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-bottom: 30px;">
                        <img src="{{ asset('images/user.png') }}" width="40" height="40" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                    </div>
                </div>
            </li>

    </div>

</nav>
