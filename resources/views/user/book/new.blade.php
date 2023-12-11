@extends('layout.main')
@section('content')
    @foreach($book as $sbook)
        {{$sbook->title}}
    @endforeach
@endsection
