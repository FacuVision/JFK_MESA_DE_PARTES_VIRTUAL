@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Seguimiento de Expediente: {{$tracing->code}}</h1>
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
            <table id="horarios" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Oficina Remiente</th>
                        <th>Remitente</th>
                        <th>Oficina Destino</th>
                        <th>Destinatario</th>
                        <th>Estado</th>
                        <th>Tipo de proc.</th>
                        <th>Fecha de mov.</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            @foreach ($incidents as $incident)
                            <td>{{ $incident->id }}</td>
                            <td>{{ $incident->office_remitent }}</td>
                            <td>{{ $incident->remitent }}</td>
                            <td>{{ $incident->office_destiny }}</td>
                            <td>{{ $incident->destiny }}</td>
                            <td>{{ $incident->status }}</td>
                            <td ><span class="badge badge-info">{{ $incident->transaction_type }}</span></td>
                            @php
                                $fecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $incident->created_at)->format('d-m-Y H:i:s');
                            @endphp
                            <td>{{ $fecha }}</td>
                        </tr>
                    @endforeach
                    </tr>

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
            $('#horarios').DataTable({
                "responsive": true,
                "auto-with": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "dom": "Bfrtlip"
            });
        });
    </script>
@stop
