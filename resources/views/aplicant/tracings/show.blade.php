<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Seguimiento de Expediente N° {{ $tracing->code }}
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

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css"/>


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

                        <a class="btn btn-secondary mb-2" href="{{ route('aplicants.tracings.index') }}"> Volver</a>

                        {{-- <div>

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

                                            <table id="horarios"
                                                class="table table-hover min-w-full divide-y divide-gray-200"
                                                style="width:100%">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            ID
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Oficina Remiente
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Remitente
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Oficina Destino
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Destinatario
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Estado
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Tipo de proc.
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                            Fecha de mov.
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-500">
                                                    @foreach ($incidents as $incident)
                                                        <tr style="font-size: 0.9em">
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$incident->id}}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$incident->office_remitent}}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$incident->remitent}}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$incident->office_destiny}}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$incident->destiny}}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$incident->status}}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap"><strong>{{$incident->transaction_type}}</strong></td>
                                                        @php
                                                            $fecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $incident->created_at)->format('d-m-Y H:i:s');
                                                        @endphp
                                                            <td class="px-6 py-4 whitespace-nowrap">{{$fecha}}</td>
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

                    </div>
                </div>
            </div>
    </x-app-layout>

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>

        $(document).ready(function() {
            $('#horarios').DataTable({
                "responsive": true,
                "auto-with": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "dom": "Bfrtlip"
            });
        });
    </script>
