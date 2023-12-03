<!DOCTYPE html>
<html lang="">
<head>
    <title></title>@include('admin.elements.head')
    @stack('style')
</head>
<body>
<div class="container-scroller">
    @include('admin.elements.navbar')
    <div class="container-fluid page-body-wrapper">
{{--        @include('user.elements.sidebar')--}}
            <div class="content-wrapper">
                @yield('content')
            </div>
    </div>
</div>
@include('admin.elements.script')
@stack('script')
</body>
</html>
