<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tus Expedientes
        </h2>
    </x-slot>
    @section('content')

        <!--Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../public/css/styles.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
            integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
        </script>

        <div class="py-12">
            <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                        {{-- <div class="mt-10 sm:mt-0">

                                <div class="md:grid md:grid-cols-12 md:gap-6"> --}}
                        <div class="md:col-span-1">

                            {{-- <div class="px-4 sm:px-0">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                                            <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                                        </div> --}}

                        </div>

                        {{-- <div class="mt-5 md:mt-0 md:col-span-2">
                                        <div class="shadow overflow-hidden sm:rounded-md">

                                            <div class="px-4 py-5 bg-white sm:p-6"> --}}

                        <table id="horarios" class="table table-hover min-w-full divide-y divide-gray-200"
                            style="width:100%">
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
                                @foreach ($procedings as $proceding)
                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proceding->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proceding->code }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proceding->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proceding->n_foly }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $proceding->reference }}</td>
                                        @switch($proceding->status)
                                            @case(1)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:green; font-weight: bold">
                                                    Enviado</td>
                                            @break

                                            @case(2)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:indigo; font-weight: bold">
                                                    Derivado</td>
                                            @break

                                            @case(3)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:crimson; font-weight: bold">Por
                                                    subsanar
                                                </td>
                                            @break

                                            @case(4)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:gray; font-weight: bold">
                                                    Archivado</td>
                                            @break

                                            @case(5)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:black; font-weight: bold">
                                                    Rechazado</td>
                                            @break

                                            @case(6)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:orange; font-weight: bold">
                                                    Subsanado</td>
                                            @break

                                            @case(7)
                                                <td class="px-6 py-4 whitespace-nowrap" style="color:blue; font-weight: bold">
                                                    Desarchivado</td>
                                            @break
                                        @endswitch

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $proceding->office->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $proceding->type_proceding->name }}</td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <a href="{{ route('aplicants.tracings.show', $proceding) }}"
                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Seguimiento</a>

                                            <a href="#" data-toggle="modal" data-target="#showModal{{ $proceding->id }}"
                                                class="btn btn-info mr-1 ">Detalle</a>

                                            {{-- SI ESTE EXPEDIENTE TIENE UNA RESPUESTA, ENTONCES MOSTRARÁ EL BOTON --}}
                                            @if ($proceding->answers->count() > 0)
                                                <a href="#" data-toggle="modal"
                                                    data-target="#answerModal{{ $proceding->id }}"
                                                    class="btn btn-warning mr-1">Respuestas

                                                    ({{ $proceding->answers->count() }})
                                                </a>
                                            @endif


                                        </td>
                                        @include('aplicant.tracings.partials.show')
                                        @include('aplicant.tracings.partials.answer')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- </div>
                                        </div>
                                    </div> --}}

                        {{-- </div>
                            </div> --}}

                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>

                        {{-- </div> --}}
                    </div>
                </div>
    </x-app-layout>


    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#horarios').DataTable({
                "responsive": true,
                "auto-width": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
