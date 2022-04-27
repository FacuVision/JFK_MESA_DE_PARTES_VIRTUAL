@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Solicitantes</h1>
@stop

@section('content')
    <div class="card">

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
            <a href="{{ route('admin.secretaries.create') }}" class="btn btn-primary"> Añadir Solicitante</a>
        </div>


        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aplicants as $aplicant)
                        <tr>

                            <td>{{ $aplicant->user_id }}</td>
                            <td>{{ $aplicant->user->profile->name }}</td>
                            <td>{{ $aplicant->user->profile->lastname }}</td>
                            <td>{{ $aplicant->user->email }}</td>
                            <td style="display: flex">

                                {{-- Ver --}}

                                    <a href="{{ route('admin.users.show', $aplicant->user) }}" style="margin: 0px 5px;"
                                        class="btn btn-primary">Ver</a>
                                {{-- Editar --}}
                                    <a href="{{ route('admin.users.edit', $aplicant->user) }}" class="btn btn-success">Editar</a>

                                    {{-- Borrar --}}
                                    <form style="display: inline" action="{{ route('admin.secretaries.destroy', $aplicant) }}"
                                        method="post" class="formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                                    </form>



                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
