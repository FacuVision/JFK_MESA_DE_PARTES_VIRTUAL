@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Tipos de Expedientes</h1>
@stop

@section('content')
<div class="card">
    {{session('Todos')}}
    @if (session('mensaje'))
        <div class="alert alert-{{session('color')}}">
            <strong>{{ session('mensaje') }}</strong>
        </div>
    @endif
    @if (session('alerta'))
        <div class="alert alert-warning">
            <strong>{{ session('alerta') }}</strong>
        </div>
    @endif

    <div class="card-header">
        <a href="{{ route('admin.typeprocedings.create') }}" class="btn btn-primary">Añadir Nuevo Tipo</a>
    </div>


    <div class="card-body">
        <table id="tipoExpe" class="table table-striped dt-responsive nowrap" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoexpedientes as $TypeProceding)
                    <tr>
                        <td class="text-center">{{ $TypeProceding->id }}</td>
                        <td>{{ $TypeProceding->name }}</td>
                        <td>{{ $TypeProceding->description }}</td>
                        <td class="text-center">{{ $TypeProceding->type }}</td>
                        <td class="text-center">
                            <div class="grid-cols-2">
                                {{-- Editar --}}
                                <div class="col-sm-lg-1 m-1">
                                    <a href="{{ route('admin.typeprocedings.edit', $TypeProceding->id) }}"
                                    class="btn btn-warning"><i class="fa fa-pencil-alt"></i> </a>
                                </div>
                                <div class="col-sm-lg-1 m-1">
                                    {{-- Eliminar --}}
                                    {{-- <form  action="{{ route('admin.typeprocedings.destroy', $TypeProceding->id) }}"
                                    method="post" class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button  TypeProcedings="submit" id="delete" value="" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form> --}}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
            $('#tipoExpe').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
   $( document ).ready(function() {
       $('.formulario-eliminar').submit(function(e){
       e.preventDefault();
       Swal.fire({
       title: '¿Estás seguro?',
       text: "Esta registro se eliminará definitivamente",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Sí, eliminar!',
       cancelmButtonText: 'Cancelar'

       }).then((result) => {
       if (result.isConfirmed) {
           this.submit();
       }
       })
   });
});

</script>
@stop
