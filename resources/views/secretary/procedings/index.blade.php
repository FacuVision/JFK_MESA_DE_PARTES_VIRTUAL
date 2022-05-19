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
            <table id="tabla1" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Titulo</th>
                        <th>Oficina</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($procedings as $proceding)
                        <tr>
                            @if ($proceding->status == 1 || $proceding->status == 2 || $proceding->status == 5)
                                <td>{{ $proceding->id }}</td>
                                <td>{{ $proceding->code }}</td>
                                <td>{{ $proceding->title }}</td>
                                <td>{{ $proceding->office->name }}</td>
                                @switch($proceding->status)
                                    @case(1)
                                        <td class="text-primary">
                                            Enviado
                                        </td>
                                    @break

                                    @case(2)
                                        <td class="text-warning">
                                            Derivado
                                        </td>
                                    @break

                                    @case(5)
                                        <td class="text-danger">
                                            Rechazado
                                        </td>
                                    @break
                                @endswitch

                                <td>

                                    <a href="#" data-toggle="modal" data-target="#showModal{{ $proceding->id }}"
                                        class="btn btn-info">Detalle</a>
                                    <a href="{{ route('secretary.procedings.show', $proceding) }}"
                                        class="btn btn-secondary">Archivar</a>
                                    {{-- @if ($proceding->status == 5)
                                        <form action="{{ route('secretary.procedings.destroy', $proceding) }}"
                                            method="post" class="formulario-eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    @endif --}}
                                    @include('secretary.procedings.partials.show')
                                    @include('secretary.procedings.partials.answer')
                                    @include('secretary.procedings.partials.derive')
                                </td>
                            @endif
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
            $('#tabla1').DataTable();
        });
    </script>

@stop
