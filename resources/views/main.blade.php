<!doctype html>
<html @lang('en')>

<head>
    @include('partials/_head')
    <link rel="stylesheet" href="{{ asset('css/sbi-theme.css') }}">
    @include('partials/_css')
    @include('partials/_script')
</head>

<body>
    {{-- Sidebar Overlay (mobile) --}}
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <div class="d-flex w-100">

        {{-- ═══════════ SIDEBAR ═══════════ --}}
        <nav id="sidebar" class="sidebar">

            {{-- Brand --}}
            <div class="sidebar-brand d-flex align-items-center gap-3">
                <div class="brand-icon flex-shrink-0">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <div class="sidebar-brand-text">
                    <div class="brand-name">SAIS-NG</div>
                    <div class="brand-sub">Sistem Informasi Siswa</div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="sidebar-nav">
                <div class="nav-section-title">Menu Utama</div>
                
                @if(isset($userMenus) && $userMenus->count() > 0)
                    @foreach($userMenus as $menu)
                        <a href="{{ Route::has($menu->route_name) ? route($menu->route_name) : '#' }}" class="sidebar-link {{ request()->routeIs($menu->route_name) ? 'active' : '' }}">
                            <i class="fa {{ $menu->icon }}"></i>
                            <span>{{ $menu->title }}</span>
                        </a>
                    @endforeach
                @else
                    {{-- Fallback jika belum migrate/seeding --}}
                    <a href="#" class="sidebar-link">
                        <i class="fa fa-warning"></i>
                        <span>Menu Belum Tersedia</span>
                    </a>
                @endif
                
            </nav>

            {{-- Footer User --}}
            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="avatar avatar-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1 overflow-hidden user-info">
                        <div class="user-name text-truncate">{{ auth()->user()->name }}</div>
                        <div class="user-role">
                            @if(Auth::user()->hasRole('admin') || Auth::user()->admin == 1) Admin 
                            @elseif(Auth::user()->hasRole('guru-piket') || Auth::user()->piket == 1) Guru Piket 
                            @elseif(Auth::user()->hasRole('wali-kelas') || auth()->user()->isWalikelas()) Wali Kelas 
                            @else User @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        {{-- ═══════════ END SIDEBAR ═══════════ --}}

        {{-- ═══════════ MAIN AREA ═══════════ --}}
        <div class="main-wrapper w-100" style="min-width: 0; overflow-x: hidden;">

            {{-- Topbar --}}
            <header class="topbar d-flex align-items-center" style="position: relative; z-index: 1040;">
                <button id="sidebarToggle" class="btn btn-sm btn-outline-secondary border-0 mr-3" title="Toggle Menu" style="background: transparent; color: #64748b;">
                    <i class="fa fa-bars fs-5" style="font-size: 20px;"></i>
                </button>

                <div>
                    <h5 class="m-0 font-weight-bold text-dark">SAIS-NG</h5>
                </div>

                <div class="d-flex align-items-center ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-sm d-flex align-items-center border-0 dropdown-toggle"
                                type="button"
                                id="userDropdown"
                                data-toggle="dropdown"
                                aria-expanded="false"
                                style="background: transparent;">
                            <div class="avatar avatar-sm d-none d-md-flex">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span class="d-none d-md-inline font-weight-bold text-dark">{{ auth()->user()->name }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border mt-2" aria-labelledby="userDropdown">
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.index') }}">
                                <i class="fa fa-user mr-2 text-primary"></i>Profil Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger d-flex align-items-center py-2" href="{{ route('logout') }}">
                                <i class="fa fa-sign-out mr-2"></i>Keluar
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            {{-- End Topbar --}}

            {{-- Page Content --}}
            <main class="page-content">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-top py-3 px-4 mt-auto">
                <p class="text-muted small mb-0">
                    &copy; {{ date('Y') }} MAN 2 | SAIS-NG
                </p>
            </footer>

        </div>
        {{-- ═══════════ END MAIN ═══════════ --}}

    </div>

    @yield('script')
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
</body>
</html>
