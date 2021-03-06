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
                                    @case(1)
                                        <span class="text-white badge badge-success">
                                            Enviado
                                        </span>
                                    @break
                                    @case(2)
                                        <span class="text-white badge badge-info">
                                            Derivado
                                        </span>
                                    @break

                                    @case(3)
                                        <span class="text-white badge badge-danger">
                                            Por subsanar
                                        </span>
                                    @break

                                    @case(5)
                                        <span class="text-white badge badge-dark">
                                            Rechazado
                                        </span>
                                    @break

                                    @case(6)
                                        <span class="text-white badge badge-warning">
                                            Subsanado
                                        </span>
                                    @break
                                    @case(7)
                                        <span class="text-white badge badge-primary">
                                            Desarchivado
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
                                        <a href="{{ route('secretaries.procedings.dont_reject', $proceding) }}"
                                            class="btn btn-success btn-sm ml-1"><i class="fa fa-check-square"
                                                aria-hidden="true"></i></a>
                                    @endif
                                    @if ($proceding->status != 5 && $proceding->status !=6 && $proceding->status !=1 && $proceding->status !=2)
                                        <a href="{{ route('secretaries.procedings.show', $proceding) }}"
                                            class="archivar ml-1 btn btn-secondary btn-sm mr-1">Archivar</a>
                                    @endif

                                </div>
                                @include('secretaries.procedings.partials.show')
                                @include('secretaries.procedings.partials.anotations')
                                @include('secretaries.procedings.partials.answer')
                                @include('secretaries.procedings.partials.subsana')
                                @include('secretaries.procedings.partials.derive')
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

            // $('.archivar').click(function(e) {
            //     e.preventDefault();
            //     Swal.fire({
            //         title: '¿Estás seguro?',
            //         text: "Esta expediente se archivará, el solicitante no podrá realizar ninguna acción con su expediente si continuas",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Sí, archivar',
            //         cancelmButtonText: 'Cancelar'

            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             this.submit();
            //         }
            //     })
            // });


        });
    </script>

@stop
