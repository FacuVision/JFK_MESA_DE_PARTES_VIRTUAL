@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Administracion</h1>
@stop

@section('content')
    <p>Bienvenido al panel de control de la empresa JFK Escuela de Manejo</p>

    @livewire("dashboardcomponent")
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
