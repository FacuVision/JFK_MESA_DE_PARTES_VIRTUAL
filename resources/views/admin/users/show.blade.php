@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Datos del Usuario</h1>
@stop

@section('content')
    <div class="card">

        {{-- <div class="card-header">
            @if (session('mensaje'))
                <div class="alert alert-danger">
                    <strong>{{ session('mensaje') }}</strong>
                </div>
            @endif
        </div> --}}

        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha_Nac</th>
                        <th>Tipo_Documento</th>
                        <th>#_Documento</th>
                        <th>Sexo</th>
                        <th>Dirección</th>
                        <th>Distrito</th>
                        <th>Provincia</th>
                        <th>Departamento</th>
                        @can('admin.users.edit')
                            <th>Accion</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->profile->name }}</td>
                        <td>{{ $user->profile->lastname }}</td>
                        <td>{{ date('d/m/Y ', strtotime($user->profile->date_nac)) }}</td>
                        <td>{{ $user->profile->type_document->name }}</td>
                        <td>{{ $user->profile->document_number }}</td>
                        <td>
                            @if ($user->profile->gender == 'm')
                                Masculino
                            @else
                                Femenino
                            @endif
                        </td>
                        <td>{{ $user->profile->address }}</td>
                        <td>{{ $user->profile->district->name }}</td>
                        <td>{{ $user->profile->district->province->name}}</td>
                        <td>{{ $user->profile->district->province->departament->name }}</td>
                        @can('admin.users.edit')
                            @can('admin.users.destroy')
                                <td style="display: flex">

                                    {{-- Editar --}}
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Editar</a>

                                    {{-- Eliminar --}}
                                    <form style="display: inline" action="{{ route('admin.users.destroy', $user) }}" method="post"
                                        class="formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                                    </form>

                                </td>
                            @endcan
                        @endcan
                    </tr>


                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.users.index') }}" class="btn btn-warning"> Volver </a>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
