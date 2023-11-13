@extends('layouts.app')

@section('nav-title')
    Dashboard
@endsection

@section('content')
    @include('dashboard.line-chart')

    <br>

    @include('dashboard.pie-chart')

    <br>
    
@endsection
