<!DOCTYPE html>
<html lang="">
<head>
    <title></title>@include('admin.elements.head')
    <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
    @stack('style')
</head>
<body>
<div class="container-scroller">
    @include('user.elements.navbar')
    <div class="container-fluid page-body-wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
</div>
@include('admin.elements.script')
@stack('script')
</body>
</html>
