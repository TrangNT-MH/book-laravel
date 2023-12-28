@extends('layouts.layout')
@if(Auth::user()->hasRole('user'))
    @push('style')
        <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
    @endpush
@endif
@section('auth')
    @if(Auth::user()->hasRole('user'))
        <div class="container-scroller">
            @include('layouts.elements.navbar_user')
            <div class="container-fluid page-body-wrapper">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    @elseif(Auth::user()->hasRole('admin'))
        <div class="container-scroller">
            @include('layouts.elements.navbar')
            <div class="container-fluid page-body-wrapper">
                @include('layouts.elements.sidebar')
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
