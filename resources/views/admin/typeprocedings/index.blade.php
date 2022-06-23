@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Tipos de Expedientes</h1>
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
        @can('admin.typeprocedings.create')
            <div class="card-header">
                <a href="{{ route('admin.typeprocedings.create') }}" class="btn btn-primary">Añadir Nuevo Tipo</a>
            </div>
        @endcan

        <div class="card-body">
            <table id="tipoExpe" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Acción</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipoexpedientes as $TypeProceding)
                        <tr>
                            <td>{{ $TypeProceding->id }}</td>
                            <td>{{ $TypeProceding->name }}</td>
                            <td>{{ $TypeProceding->type }}</td>
                            <td>
                                @can('admin.typeprocedings.edit')
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.typeprocedings.edit', $TypeProceding->id) }}"
                                        class="btn btn-success">Editar</a>
                                @endcan
                                @if ($TypeProceding->type != "system")
                                    @can('admin.typeprocedings.destroy')
                                        {{-- Eliminar --}}
                                        <form id="formulario-eliminar" style="display: inline"
                                            action="{{ route('admin.typeprocedings.destroy', $TypeProceding->id) }}"
                                            method="post" class="formulario-eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    @endcan
                                @endif
                            </td>
                            <td>{{ $TypeProceding->description }}</td>
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
            $('#tipoExpe').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#formulario-eliminar').submit(function(e) {
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
