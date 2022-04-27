@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Secretarios: Asignar Nuevo Secretario</h1>
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

        {!! Form::open(['method' => 'POST', 'route' => 'admin.secretaries.store']) !!}


        <div class="form-group">

            {{-- Seleccionar Usuario --}}
            {!! Form::label('user_id', 'Seleccione un usuario') !!}<br>
            <div>
                <select name="user_id" id="user_id" class="form-control" size="10" aria-label="size 3 select example">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->profile->name . ' ' . $user->profile->lastname . ', # Documento:' . $user->profile->document_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!--.container-->
        </div>

        <div class="form-group">
            {!! Form::label('office_id', 'Oficina') !!}
            <select required name="office_id" class="form-control">
                @foreach ($offices as $office)
                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">

        {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
    </div>

    </div>
    {!! Form::close() !!}

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
