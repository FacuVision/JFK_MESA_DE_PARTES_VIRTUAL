@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Solicitantes: Añadir Solicitante</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            @if (count($errors) > 0)
                <div class="text-danger">

                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach

                </div>
            @endif

        </div>
        <div class="card-body">

            {!! Form::open(['method' => 'POST', 'route' => 'admin.aplicants.store']) !!}


            <div class="form-group">
                {{-- Seleccionar Usuario --}}
                {!! Form::label('user_id', 'Lista de usuarios que no han sido asignados') !!}<br>


                <div>
                    @if($users_sin_rol->count() > 0)

                    <select name="user_id" id="user_id" class="form-control" size="10" aria-label="size 3 select example">
                        @foreach ($users_sin_rol as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->profile->name . ' ' . $user->profile->lastname . ', # Documento:' . $user->profile->document_number }}
                            </option>
                        @endforeach
                    </select>

                    @else
                    <input type="text" class="form-control" disabled value="No hay usuarios para asignar">
                @endif

                </div>
            </div>
            <div class="form-group">
                @if($users_sin_rol->count() > 0)
                {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
            @else
                <a href="{{ route('admin.aplicants.index') }}" class="btn btn-secondary">Volver</a>
            @endif            </div>

        </div>
        {!! Form::close() !!}

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
