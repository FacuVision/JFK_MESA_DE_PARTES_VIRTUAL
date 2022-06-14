@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Seguimiento de Expedientes</h1>
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
                        <th>N° Folios</th>
                        <th>Referencia</th>
                        <th>Estado</th>
                        <th>Oficina</th>
                        <th>Tipo de Procedimiento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($procedings as $proceding)
                        <tr>
                            <td>{{ $proceding->id }}</td>
                            <td>{{ $proceding->code }}</td>
                            <td>{{ $proceding->title }}</td>
                            <td>{{ $proceding->n_foly }}</td>
                            <td>{{ $proceding->reference }}</td>
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
                            <td>{{ $proceding->office->name }}</td>
                            <td>{{ $proceding->type_proceding->name }}</td>

                            <td class="row">
                                <div class="d-inline-flex nowrap">

                                    <a href="{{ route('secretaries.tracing.show', $proceding) }}"
                                        class="btn btn-sm btn-secondary mr-1">Seguimiento</a>
                                    <a href="#" data-toggle="modal" data-target="#showModal{{ $proceding->id }}"
                                        class="btn btn-sm btn-info ">Detalle</a>

                                    {{-- SI ESTE EXPEDIENTE TIENE UNA RESPUESTA, ENTONCES MOSTRARÁ EL BOTON --}}
                                    @if ($proceding->answers->count() > 0)
                                        <a href="#" data-toggle="modal" data-target="#answerModal{{ $proceding->id }}"
                                            class="btn btn-sm btn-warning ml-1">Respuestas({{ $proceding->answers->count() }})

                                        </a>
                                    @endif
                                </div>
                            </td>
                            @include('secretaries.procedings.tracings.partials.show')
                            @include('secretaries.procedings.tracings.partials.answer')
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
                autoWidth: true
            });



        });
    </script>

@stop
