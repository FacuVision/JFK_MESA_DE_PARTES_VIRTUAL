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
        @if (session('danger'))
            <div class="alert alert-danger">
                <strong>{{ session('danger') }}</strong>
            </div>
        @endif
        @can('admin.aplicants.create')
            <div class="card-header">
                <a href="{{ route('admin.aplicants.create') }}" class="btn btn-primary"> Asignar nuevo solicitante</a>
            </div>
        @endcan


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
                                @can('admin.users.show')
                                    {{-- Ver --}}
                                    <a href="{{ route('admin.users.show', $aplicant->user) }}" style="margin: 0px 5px;"
                                        class="btn btn-primary">Ver</a>
                                @endcan
                                {{-- Editar --}}
                                @can('admin.users.edit')
                                    <a href="{{ route('admin.users.edit', $aplicant->user) }}"
                                        class="btn btn-success">Editar</a>
                                @endcan

                                @can('admin.aplicants.destroy')
                                    {{-- Borrar --}}
                                    <form style="display: inline" action="{{ route('admin.aplicants.destroy', $aplicant) }}"
                                        method="post" class="formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" id="delete" value="Desasignar" class="btn btn-danger">
                                    </form>
                                @endcan
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
        $(document).ready(function() {
            $('#tabla').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.formulario-eliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "El usuario dejará de ser Solicitante, mas no se eliminará del sistema. Para ello se debe de ir al menú de usuarios general",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, desasignar!',
                    cancelmButtonText: 'Cancelar'

                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });

        });
    </script>
@stop
