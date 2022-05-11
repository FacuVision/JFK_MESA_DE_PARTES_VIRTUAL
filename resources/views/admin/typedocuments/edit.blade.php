@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Tipo de Documentos: Editar</h1>
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

            {!! Form::model($typedocument, ['route' => ['admin.typedocuments.update', $typedocument], 'method' => 'PUT']) !!}

            <div class="form-group">

                <div class="form-group">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('name', 'Nombre') !!}
                                {!! Form::text('name', $typedocument->name, ['class' => 'form-control']) !!} </div>
                        </div>
                    </div>

                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
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
    <script>
        console.log('Hi!');
    </script>
@stop
