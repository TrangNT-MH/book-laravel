<!DOCTYPE html>
<html lang="">
<head>
    @include('layouts.elements.head')
    @stack('style')
</head>
<body>
@auth
    @yield('auth')
@endauth
@guest
    @yield('guest')
@endguest
@include('layouts.elements.script')
@stack('script')
</body>
</html>
