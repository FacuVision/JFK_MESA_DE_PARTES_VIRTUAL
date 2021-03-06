@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Oficinas</h1>
@stop

@section('content')
    <div class="card">
        {{ session('Todos') }}
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
        @can('admin.offices.create')
            <div class="card-header">
                <a href="{{ route('admin.offices.create') }}" class="btn btn-primary">Añadir Nueva Oficina</a>
            </div>
        @endcan


        <div class="card-body">
            <table id="tabla1" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <td>Descripción</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offices as $office)
                        <tr>
                            <td>{{ $office->id }}</td>
                            <td>{{ $office->name }}</td>
                            <td>{{ $office->description }}</td>
                            <td style="display: flex">
                                @can('admin.offices.edit')
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.offices.edit', $office) }}" class="btn btn-success">Editar</a>
                                @endcan
                                @can("admin.offices.destroy")
                                    {{-- Borrar --}}
                                    <form style="display: inline" action="{{ route('admin.offices.destroy', $office) }}"
                                        method="post" class="formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
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
                    text: "Esta registro se eliminará definitivamente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
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
