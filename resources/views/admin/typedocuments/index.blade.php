@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Tipos de Documento de Identificación</h1>
@stop

@section('content')
    <div class="card">
        {{ session('Todos') }}
        @if (session('mensaje'))
            <div class="alert alert-{{ session('color') }}">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        @if (session('alerta'))
            <div class="alert alert-warning">
                <strong>{{ session('alerta') }}</strong>
            </div>
        @endif
        @can('admin.typedocuments.create')
            <div class="card-header">
                <a href="{{ route('admin.typedocuments.create') }}" class="btn btn-primary">Añadir Nuevo Tipo</a>
            </div>
        @endcan


        <div class="card-body">
            <table id="tabla1" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <td>Fecha Creación</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->created_at }}</td>
                            <td style="display: flex">
                                @can('admin.typedocuments.edit')
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.typedocuments.edit', $type) }}" class="btn btn-success">Editar</a>
                                @endcan

                                @can('admin.typedocuments.destroy')
                                    {{-- Borrar --}}
                                    <form style="display: inline" action="{{ route('admin.typedocuments.destroy', $type) }}"
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
