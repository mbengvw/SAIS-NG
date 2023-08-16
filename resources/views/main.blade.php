<!doctype html>
<html @lang('en')>

<head>
    @include('partials/_head')
    @include('partials/_css')
</head>

<body>
    @include('partials/_nav')

    <div>
        @yield('content')
    </div>

    @include('partials/_footer')

    @yield('script')
    @include('partials/_script')
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
