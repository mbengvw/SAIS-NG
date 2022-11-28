<!doctype html>
<html @lang('en')>

<head>
    @include('partials/_head')
    @include('partials/_css')
    @include('partials/_script')
</head>

<body>
    @include('partials/_nav')

    <div>
        @yield('content')
    </div>

    @include('partials/_footer')

    @yield('script')
</body>

</html>
