<!doctype html>
<html @lang('en')>

<head>
    @include('partials/_head')
    @include('partials/_css')
    @include('partials/_script')

</head>

<body>
    @if (Auth::user()->admin == 1)
        @include('partials/_nav')
    @elseif (Auth::user()->piket == 1)
        @include('partials._nav_piket')
    @endif

    <div>
        @yield('content')
    </div>

    @include('partials/_footer')

    @yield('script')
</body>

<script>
    $(document).ready(function() {
        const menuItems = document.getElementsByClassName("nav-link");
        const navItems = document.getElementsByClassName("nav-item");

        for (let i = 0; i < menuItems.length; i++) {
            if (menuItems[i].href === location.href) {
                navItems[i].className += " active"
            }
        }
    });
</script>

</html>
