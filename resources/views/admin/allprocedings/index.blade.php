@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Expedientes</h1>
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
                        <th>Referencia</th>
                        <th>Titulo</th>
                        <th>Oficina</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($procedings as $proceding)
                        <tr>
                            <td>{{ $proceding->id }}</td>
                            <td>{{ $proceding->code }}</td>
                            <td>{{ $proceding->reference }}</td>
                            <td>{{ $proceding->title }}</td>
                            <td>{{ $proceding->office->name }}</td>
                            <td>
                                @switch($proceding->status)

                                    @case(4)
                                        <span class="text-white badge badge-secondary">
                                            Archivado
                                        </span>
                                    @break

                                    @case(5)
                                        <span class="text-white badge badge-warning">
                                            Rechazado
                                        </span>
                                    @break

                                @endswitch

                            </td>

                            <td>
                                <div class="row">
                                    <a href="#" data-toggle="modal" data-target="#showModal{{ $proceding->id }}"
                                        class="btn btn-info btn-sm mr-1">Detalle</a>
                                    <a data-toggle="modal" class="btn btn-primary btn-sm"
                                        data-target="#anotationModal{{ $proceding->id }}">Ver Anotaciones</a>

                                    {{-- SI EN CASO EL EXPEDIENTE ES RECHAZADO --}}
                                    @if ($proceding->status == 5)
                                        <form action="{{ route('secretaries.procedings.destroy', $proceding) }}"
                                            method="post" class="formulario-eliminar ml-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="formulario-eliminar fa fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                                @include('admin.allprocedings.partials.show')
                                @include('admin.allprocedings.partials.anotations')
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
                autoWidth: false
            });


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
