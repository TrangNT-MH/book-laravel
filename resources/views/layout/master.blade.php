<!DOCTYPE html>
<html lang="">
<head>
    @include('admin.elements.head')
    @stack('style')
</head>
<body>
<div class="container-scroller">
    @include('admin.elements.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('admin.elements.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('admin.elements.script')
@stack('script')
</body>
</html>
