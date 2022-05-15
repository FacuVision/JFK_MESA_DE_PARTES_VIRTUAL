@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Tipo de Expedientes: Crear</h1>
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

        {!! Form::open(array('route'=>'admin.typeprocedings.store', 'method'=>'POST','files'=>true)) !!}
        @csrf    

        <div class="form-group">

            <div class="form-group">

                <div class="form-group">
                    <div class="row">

                        
                        <div class="col-sm-lg-1 m-1">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @error('name')
                            <br>
                            <span class="badge badge-danger">{{ $message}}</span>
                        @enderror
                        </div>
                        <div class="col-sm-lg-1 m-1">
                            {!! Form::label('description', 'Descripción') !!}
                            {!! Form::TextArea('description', null, ['class' => 'form-control','style'=>'height:150px']) !!} </div>

                        <div class="col-sm-lg-1 m-1">
                            {!! Form::label('type', 'Tipo') !!}
                            {!! Form::select('type', $tipos,null, ['class'=>'form form-control','placeholder' => '[Selecciones un tipo]']) !!} 
                            </div>
                    </div>
                </div>

                {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('admin.typeprocedings.index') }}" class="btn btn-info"> Volver</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
