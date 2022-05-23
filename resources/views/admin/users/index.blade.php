@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Usuarios</h1>
@stop

@section('content')
<div class="card">
    @if (session('mensaje'))
        <div class="alert alert-success">
            <strong>{{ session('mensaje') }}</strong>
        </div>
    @endif

        <div class="card-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Añadir Usuario</a>
        </div>



    <div class="card-body">
        <table id="tabla1" class="table table-striped dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de Creación</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ date('d/m/Y H:m:s', strtotime($user->created_at)) }}</td>
                        <td>
                            {{-- Mostrar --}}

                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary">Ver</a>


                            {{-- Editar --}}

                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Editar</a>

                                {{-- Eliminar --}}
                                <form class="formulario-eliminar" style="display: inline" action="{{ route('admin.users.destroy', $user) }}"
                                    method="post" class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                                </form>


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

<script>
    $(document).ready(function() {
            $('#tabla1').DataTable({
                responsive: true,
                autoWidth: false,
            });
    });

</script>

<script>
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
