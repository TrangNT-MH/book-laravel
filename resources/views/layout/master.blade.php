<!DOCTYPE html>
<html>
<head>
    @include('admin.elements.head')
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
@yield('script')
</body>
</html>
