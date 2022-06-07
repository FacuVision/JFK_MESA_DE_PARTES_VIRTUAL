@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Expedientes de Archivados</h1>
@stop

@section('content')
    <div class="card">


        <div class="card-header">

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
            @if (count($errors) > 0)
                <div class="text-danger">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </div>
            @endif
        </div>



        <div class="card-body">
            <table id="expedientes" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Titulo</th>
                        <th>Oficina</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos_archivados as $archivado)
                        <tr>
                            <td>{{ $archivado->id }}</td>
                            <td>{{ $archivado->code }}</td>
                            <td>{{ $archivado->title }}</td>
                            <td>{{ $archivado->office->name }}</td>

                            <td>
                                <div class="row">
                                    <a href="#" data-toggle="modal" data-target="#showModal{{ $archivado->id }}"
                                        class="btn btn-info btn-sm mr-1">Detalle</a>
                                    <a data-toggle="modal" class="btn btn-primary btn-sm"
                                        data-target="#anotationModal{{ $archivado->id }}">Ver Anotaciones</a>



                                    <form action="{{ route('secretaries.archivate.procedings.destroy', $archivado)}}" method="post" class="formulario-eliminar ml-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary btn-sm">Deasarchivar</button>
                                    </form>

        </div>

        @include('secretaries.archivates.partials.show')
        @include('secretaries.archivates.partials.anotations')

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
            $('#expedientes').DataTable({
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
                    text: "Esta registro se desarchivará. Esto quiere decir que podra volver a ser gestionado como lo era anteriormente (podras verlo en tu menú de expedientes)",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, desarchivar!',
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
