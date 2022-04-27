@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Usuarios: Editar Usuario</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{session('mensaje')}}</strong>
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

        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}

        <div class="form-group">

            <div class="form-group">

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! Form::label('email', 'Correo Electronico') !!}
                            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('password', 'Contraseña') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                      </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! Form::label('name', 'Nombres') !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('lastname', 'Apellidos') !!}
                            {!! Form::text('lastname', $user->profile->lastname, ['class' => 'form-control']) !!}                    </div>
                      </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! Form::label('fecha', 'Fecha de Nacimiento') !!}
                            {!! Form::date('fecha', $user->profile->date_nac, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('type_document', 'Tipo de Documento') !!}
                            {!! Form::select('type_document', $doc, $user->profile->type_document->id, ['placeholder' => 'Elija tipo de documento...', 'class' => 'form-control']); !!}
                        </div>
                        <div class="col">
                            {!! Form::label('document_number', '# Documento') !!}
                            {!! Form::text('document_number', $user->profile->document_number, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('gender', 'Sexo') !!}
                            {!! Form::select('gender', $sexo, $user->profile->gender, ['placeholder' => 'Elija sexo...', 'class' => 'form-control']); !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('address', 'Direccion') !!}
                    {!! Form::text('address', $user->profile->address, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('district', 'Distrito') !!}
                    {!! Form::select('district', $dist, $user->profile->district->id, ['placeholder' => 'Elija un distrito...', 'class' => 'form-control']); !!}
                </div>

            </div>




        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
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
