@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Secretarios</h1>
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

        @if (session('eliminado'))
            <div class="alert alert-danger">
                <strong>{{ session('eliminado') }}</strong>
            </div>
        @endif



        @can('admin.secretaries.create')
            <div class="card-header">
                <a href="{{ route('admin.secretaries.create') }}" class="btn btn-primary"> Asignar nuevo secretario</a>
            </div>
        @endcan


        <div class="card-body">
            <table id="tabla1" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Oficina</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($secretaries as $secretary)
                        <tr>
                            <td>{{ $secretary->user_id }}</td>
                            <td>{{ $secretary->user->profile->name }}</td>
                            <td>{{ $secretary->user->profile->lastname }}</td>
                            <td>{{ $secretary->user->email }}</td>
                            <td>{{ $secretary->office->name }}</td>
                            <td style="display: flex">

                                {{-- Ver --}}
                                @can('admin.users.show')
                                    <a href="{{ route('admin.users.show', $secretary->user) }}" style="margin: 0px 5px;"
                                        class="btn btn-primary">Ver</a>
                                @endcan
                                {{-- Editar --}}
                                @can('admin.aplicants.edit')
                                    <a href="{{ route('admin.secretaries.edit', $secretary) }}"
                                        class="btn btn-success">Editar</a>
                                @endcan
                                {{-- Borrar --}}
                                @can('admin.aplicants.destroy')
                                    <form style="display: inline"
                                        action="{{ route('admin.secretaries.destroy', $secretary) }}" method="post"
                                        class="formulario-eliminar">
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
            $('#tabla1').DataTable({
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
                    text: "El usuario dejará de ser Secretario(a), mas no se eliminará del sistema. Para ello se debe de ir al menú de usuarios general",
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
