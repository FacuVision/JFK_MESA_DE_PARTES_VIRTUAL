<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Seguimiento de Expedientes
        </h2>
    </x-slot>
    @section('content')
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">  

        <div class="card">
            <div class="py-12">
                <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                            {!! Form::open(['route' => 'aplicants.procedings.store', 'method' => 'POST', 'files' => true]) !!}
                            {!! Form::close() !!}


                            <div class="mt-10 sm:mt-0">

                                <div class="md:grid md:grid-cols-12 md:gap-6">
                                    <div class="md:col-span-1">

                                        {{-- <div class="px-4 sm:px-0">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                                            <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                                        </div> --}}

                                    </div>

                                    <div class="mt-5 md:mt-0 md:col-span-2">
                                        <div class="shadow overflow-hidden sm:rounded-md">

                                            <div class="px-4 py-5 bg-white sm:p-6">

                                                <table id="horarios" class="table table-hover min-w-full divide-y divide-gray-200" style="width:100%">
                                                    <thead class="bg-gray-100">
                                                        <tr>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                ID
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Código
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Título
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                N° Folios
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Referencia
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Estado
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Oficina
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Tipo de Procedimiento
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Acciones
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-500">
                                                        @foreach ($procedings as $pro)

                                                   <tr style="font-size: 0.9em">

                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            @switch($pro->status)

                                                                @case(1)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:green; font-weight: bold">Enviado</td>
                                                                @break
                                                                @case(2)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:indigo; font-weight: bold">Derivado</td>
                                                                @break
                                                                @case(3)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:crimson; font-weight: bold">Por subsanar</td>
                                                                @break
                                                                @case(4)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:gray; font-weight: bold">Archivado</td>
                                                                @break
                                                                @case(5)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:black; font-weight: bold">Rechazado</td>
                                                                @break
                                                                @case(6)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:orange; font-weight: bold">Subsanado</td>
                                                                @break
                                                                @case(7)
                                                                    <td class="px-6 py-4 whitespace-nowrap" style="color:blue; font-weight: bold">Desarchivado</td>
                                                                @break
                                                            @endswitch

                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{-- <a href="{{ route('aplicants.tracings.show')}}"
                                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Ver Detalle</a>
                                                                <a href="{{ route('aplicants.tracings.show')}}"
                                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Seguimiento</a> --}}
                                                            </td>
                                                        </tr>
                                            @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="hidden sm:block" aria-hidden="true">
                                <div class="py-5">
                                    <div class="border-t border-gray-200"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </x-app-layout>


    <!-- jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!--Datatables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>

        $(document).ready(function () {
          $('#horarios').DataTable({
                "responsive":true,
                "auto-with":true,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
