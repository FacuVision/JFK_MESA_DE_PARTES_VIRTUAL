@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Secretarios: Editar</h1>
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

        {!! Form::model($secretary, ['route' => ['admin.secretaries.update', $secretary], 'method' => 'PUT']) !!}

        <div class="form-group">
            <div class="row">
                {{-- <div class="form-group">
                    <p><strong>Materias:</strong> </p>
                    @foreach ($materias as $materia)
                    <label>
                        {!! Form::checkbox("materias[]", $materia->id, null, ["class"=>"mr-1"]) !!}
                        {{$materia->nombre}}
                    </label>
                    @endforeach
                </div> --}}

                <div class="col">
                    <div class="form-group">
                        {!! Form::label('office_id', 'Oficinas') !!}
                        <select required name="office_id" class="form-control">
                            @foreach ($offices as $office)
                                @if ($secretary->office->id == $office->id){
                                    <option selected value="{{ $office->id }}">{{ $office->name }}</option>
                                }
                                @else
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                    <a href="{{ route('admin.secretaries.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>


        </div>
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
