@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Expediente: </h1>
@stop

@section('content')
<div class="card">
    {{session('Todos')}}
    @if (session('mensaje'))
        <div class="alert alert-success">
            <strong>{{ session('mensaje') }}</strong>
        </div>
    @endif
    @if (session('alerta'))
        <div class="alert alert-warning">
            <strong>{{ session('alerta') }}</strong>
        </div>
    @endif

    <div class="card-header">
        {{-- <a href="#" class="btn btn-primary">Responder</a> --}}
    </div>


    <div class="card-body">
        <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <td>Titulo</td>
                    <td>Oficina</td>
                    <td>Estado</td>
                    <td>Acción</td>
                </tr>
            </thead>
            <tbody>

                    <tr>
                        <td>{{ $proceding->id }}</td>
                        <td>{{ $proceding->code }}</td>
                        <td>{{ $proceding->title }}</td>
                        <td>{{ $proceding->office->name }}</td>
                        <td>{{ $proceding->status }}</td>
                        <td>
                            <a href="{{ route('secretary.procedings.edit', $proceding) }}"
                                class="btn btn-warning">Responder</a>
                        </td>
                    </tr>

            </tbody>
        </table>

    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
