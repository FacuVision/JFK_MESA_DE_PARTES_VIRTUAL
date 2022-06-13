@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Usuarios: Editar Usuario</h1>
    @livewireStyles
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if (session('mensaje'))
                <div class="alert alert-success">
                    <strong>{{ session('mensaje') }}</strong>
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
                            <div class="col">
                                {!! Form::label('phone', 'Celular') !!}
                                {!! Form::text('phone', $user->profile->phone, ['class' => 'form-control']) !!}
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
                                {!! Form::text('lastname', $user->profile->lastname, ['class' => 'form-control']) !!} </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('date_nac', 'Fecha de Nacimiento') !!}
                                {!! Form::date('date_nac', $user->profile->date_nac, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('type_document_id', 'Tipo de Documento') !!}
                                {!! Form::select('type_document_id', $doc, $user->profile->type_document_id, ['placeholder' => 'Elija tipo de documento...', 'class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('document_number', '# Documento') !!}
                                {!! Form::text('document_number', $user->profile->document_number, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('gender', 'Sexo') !!}
                                {!! Form::select('gender', $sexo, $user->profile->gender, ['placeholder' => 'Elija sexo...', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Direccion') !!}
                        {!! Form::text('address', $user->profile->address, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        @livewire('admin-register-component')
                    </div>

                    <div class="form-group">
                        {!! Form::label('Administrador', 'Administrador') !!}
                        {!! Form::checkbox("roles[]", $roles[0]->id, null, ["class" => "mr-1"]) !!}
                    </div>

                </div>




                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}

        </div>
        @livewireScripts

    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script>
            console.log('Hi!');
        </script>
    @stop
