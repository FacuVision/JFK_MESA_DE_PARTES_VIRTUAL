@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Usuarios: Crear Usuario</h1>
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

        <div class="col"></div>

        {!! Form::open(['method' => 'POST', 'route' => 'admin.users.store']) !!}
        <div class="form-group">

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('email', 'Correo Electronico') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
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
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('lastname', 'Apellidos') !!}
                        {!! Form::text('lastname', null, ['class' => 'form-control']) !!}                    </div>
                  </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('date_nac', 'Fecha de Nacimiento') !!}
                        {!! Form::date('date_nac', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('type_document', 'Tipo de Documento') !!}
                        {!! Form::select('type_document', $doc, null, ['placeholder' => 'Elija tipo de documento...', 'class' => 'form-control']); !!}
                    </div>
                    <div class="col">
                        {!! Form::label('document_number', '# Documento') !!}
                        {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('gender', 'Sexo') !!}
                        {!! Form::select('gender', $sexo, null, ['placeholder' => 'Elija sexo...', 'class' => 'form-control']); !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Direccion') !!}
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('district', 'Distrito') !!}
                {!! Form::select('district', $dist, null, ['placeholder' => 'Elija un distrito...', 'class' => 'form-control']); !!}
            </div>

        </div>

        <div class="form-group">
            {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
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
