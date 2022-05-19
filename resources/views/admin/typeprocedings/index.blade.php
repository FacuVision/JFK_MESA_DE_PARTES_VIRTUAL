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
        <table id="tipoExpe" class="table table-striped dt-responsive nowrap " style="width:100%">
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
                                    <form  action="{{ route('admin.typeprocedings.destroy', $TypeProceding->id) }}"
                                    method="post" class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button  TypeProcedings="submit" id="delete" value="" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
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
    //datatatble
    // $('#tipoExpe').DataTable({
    //     responsive: true,
    //     autoWidth: false,
    //     "language": {
    //        "lengthMenu": "Mostrar "+
    //        `<select class="custom-select custom-select-sm form-control form-control-sm" style="padding:.25rem .5rem;height:calc(1.5em + .5rem + 2px)"  >
    //            <option value="10">10</option>
    //            <option value="25">25</option>
    //            <option value="50">50</option>
    //            <option value="100">100</option>
    //            <option value="-1">Todos</option>
    //        </select>` +" registros por página",
    //        "zeroRecords": "No se encontró nada, lo siento",
    //        "info": "Mostrando página _PAGE_ de _PAGES_",
    //        "infoEmpty": "No hay registros disponibles",
    //        "infoFiltered": "(filtrado de _MAX_ registros totales)",
    //        "search":"Buscar",
    //        "paginate":{
    //            'next': 'Siguiente',
    //            'previous': 'Anterior'
    //        }
    //    }
    // });
    //datatatble
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
