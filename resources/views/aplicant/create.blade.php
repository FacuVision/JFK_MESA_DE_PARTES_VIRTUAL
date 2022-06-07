<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Expedientes
        </h2>
    </x-slot>
    @section('content')
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        <?php

        ?>

        <div class="card">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <div>
                                Datos del expediente
                            </div>
                            {!! Form::open(['route' => 'aplicants.procedings.store', 'method' => 'POST', 'files' => true]) !!}

                            <div class="mt-10 sm:mt-0">
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    <div class="md:col-span-1">
                                        <div class="px-4 sm:px-0">
                                            {{-- <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3> --}}
                                            {{-- <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p> --}}
                                        </div>
                                    </div>
                                    <div class="mt-5 md:mt-0 md:col-span-2">
                                        <form action="#" method="POST">
                                            <div class="shadow overflow-hidden sm:rounded-md">
                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                    <div class="grid grid-cols-6 gap-6">


                                                        <div class="col-span-6 sm:col-span-4">
                                                            <label for="email-address"
                                                                class="block text-sm font-medium text-gray-700">Oficina a
                                                                donde desea dirigirse (*)</label>
                                                            {!! Form::select('office_id', $office, null, ['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'placeholder' => '[Selecciones un opción]']) !!}
                                                            @error('office_id')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror

                                                        </div>


                                                        <div class="col-span-6 sm:col-span-3">

                                                            <label for="first-name"
                                                                class="block text-sm font-medium text-gray-700">Tipo de
                                                                Documento (*)</label>
                                                            {!! Form::select('typedocument_id', $typedocument, null, ['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'placeholder' => '[Selecciones un opción]', 'id' => 'tipodoc', 'onchange' => 'select()']) !!}

                                                            @error('typedocument_id')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{--  --}}
                                                        <div class="col-span-6 sm:col-span-3 " id="newtipodoc">
                                                            <label for="first-name"
                                                                class="block text-sm font-medium text-gray-700">Nombre del
                                                                Otro tipo de Doc. (*)</label>

                                                            <input type="text" name="newtipodoc" autocomplete="family-name"
                                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            @error('newtipodoc')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror

                                                        </div>


                                                        <div class="col-span-6 sm:col-span-3 " id="id_subsanar">
                                                            <label for="first-name"
                                                                class="block text-sm font-medium text-gray-700">Referencia
                                                                (*)</label>
                                                            {{-- {!! Form::select('referencia', $docsubsanar,null, ['class'=>'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm','placeholder' => '[Selecciones un opción]']) !!} --}}
                                                            @livewire('show-procedings')
                                                            @error('referencia')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror



                                                        </div>


                                                        <div class="col-span-6 sm:col-span-4">
                                                            <label for="last-name"
                                                                class="block text-sm font-medium text-gray-700">Asunto
                                                                (*)</label>
                                                            <input type="text" name="title" id="title"
                                                                autocomplete="family-name"
                                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            @error('title')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-span-6 sm:col-span-4">
                                                            <label for="content"
                                                                class="block text-sm font-medium text-gray-700"> Descripción
                                                                (*)
                                                                Max. 500 Caracteres</label>
                                                            <div class="mt-1">

                                                                <textarea id="content" name="content" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                                    placeholder="Ingrese una descripción"></textarea>
                                                            </div>
                                                            @error('content')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-span-6 sm:col-span-3">
                                                            <label for="n_foly"
                                                                class="block text-sm font-medium text-gray-700">Número de
                                                                Folios</label>
                                                            <input type="text" name="n_foly" id="n_foly"
                                                                autocomplete="given-name"
                                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            @error('n_foly')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-4">


                                                            <!-- component -->
                                                            {{-- <div class=" m-2 items-center justify-center bg-grey-lighter">

                                                            <label class="m-2 w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide  border border-blue cursor-pointer hover:bg-blue hover:text-white">
                                                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                                                </svg>
                                                                <span class="mt-1 text-base leading-normal">Subir Archivo</span>
                                                                <input type='file' name="pdf1" class="hidden" />


                                                            </label>
                                                        </div> --}}

                                                            <div class="flex justify-left">
                                                                <div class="mb-3 w-96">
                                                                    <label for="last-name"
                                                                        class="block text-sm font-medium text-gray-700">Documento
                                                                        Principal (*)
                                                                        Solo archivos PDF. Max. 15Mb</label>
                                                                    <input name="pdf1"
                                                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        type="file" id="pdf1">
                                                                </div>
                                                            </div>

                                                            @error('pdf1')
                                                                <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                    role="alert">
                                                                    <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                        </div> --}}
                                            </div>
                                    </div>
                                </div>

                                <div class="hidden sm:block" aria-hidden="true">
                                    <div class="py-5">
                                        <div class="border-t border-gray-200"></div>
                                    </div>
                                </div>

                                <div class="mt-10 sm:mt-0">
                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Archivos anexos:
                                                </h3>
                                                <p class="mt-1 text-sm text-gray-600">Solo archivos PDF.
                                                    Para remitir más de 1 anexo, agrupe previamente los archivos en una
                                                    carpeta de su computadora, luego seleccione todos, y a continuacion de
                                                    click en "Seleccionar Archivo" para que se carguen en el formulario
                                                    Máximo permitido 15Mb</p>
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">
                                            <form action="#" method="POST">
                                                <div class="shadow overflow-hidden sm:rounded-md">
                                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                        <fieldset>
                                                            <legend class="sr-only">Subir archivo (*)</legend>
                                                            <div class="text-base font-medium text-gray-900"
                                                                aria-hidden="true">Subir archivo (*)</div>
                                                            <div class="mt-4 space-y-4">


                                                                <div class="flex justify-left">
                                                                    <div class="mb-3 w-96">
                                                                        <label for="last-name"
                                                                            class="block text-sm font-medium text-gray-700">Anexos
                                                                            (*)</label>
                                                                        <input name="pdf2"
                                                                            class="form-control
                                                                  block
                                                                  w-full
                                                                  px-3
                                                                  py-1.5
                                                                  text-base
                                                                  font-normal
                                                                  text-gray-700
                                                                  bg-white bg-clip-padding
                                                                  border border-solid border-gray-300
                                                                  rounded
                                                                  transition
                                                                  ease-in-out
                                                                  m-0
                                                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                            type="file" id="pdf2">
                                                                    </div>
                                                                </div>

                                                                @error('pdf2')
                                                                    <div class="mt-1 leading-normal text-red-600  rounded-lg"
                                                                        role="alert">
                                                                        <p class="m-1 text-sm">¡{{ $message }}!</p>
                                                                    </div>
                                                                @enderror

                                                                <!-- component -->
                                                                {{-- <div class="items-center justify-center bg-grey-lighter">
                                                                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                                                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                                                    </svg>
                                                                    <span class="mt-2 text-base leading-normal">Subir Archivo</span>
                                                                    <input type='file' name="pdf2" class="hidden" />
                                                                </label>
                                                            </div> --}}

                                                            </div>
                                                        </fieldset>

                                                    </div>

                                                    {!! Form::close() !!}
                                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                        <button type="submit"
                                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Enviar</button>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    let selection = document.getElementById("tipodoc");
                    //ocultar los campos de "otros" y "subsanación"
                    document.getElementById('id_subsanar').style.display = 'none';
                    document.getElementById('newtipodoc').style.display = 'none';
                    $(document).ready(function() {

                        select();
                    });

                    function select() {
                        //se obtiene datos del select
                        let otro = selection.options[selection.selectedIndex].value;
                        let subsanar = selection.options[selection.selectedIndex].value;
                        // console.log(otro);

                        //si la opción es "OTROS"- nuevo registro de tipo doc
                        if (otro !== null) {
                            if (otro == 12) {
                                document.getElementById('newtipodoc').style.display = '';
                            } else {
                                document.getElementById('newtipodoc').style.display = 'none';
                            }
                        } else {
                            document.getElementById('newtipodoc').style.display = 'none';
                        }

                        //si la opción es "SUBSANAR"-lista exp. por subsanar
                        if (subsanar !== null) {

                            if (subsanar == 11) {
                                document.getElementById('id_subsanar').style.display = '';
                            } else {
                                document.getElementById('id_subsanar').style.display = 'none';
                            }
                        } else {
                            document.getElementById('id_subsanar').style.display = 'none';

                        }
                    }
                </script>





                @if (session()->has('success'))
                    <script>
                        toastr.success("{{ session('success') }}");
                    </script>
                @endif
                @if (session()->has('error'))
                    <script>
                        toastr.error("{{ session('error') }}");
                    </script>
                @endif
                @if (session()->has('info'))
                    <script>
                        toastr.info("{{ session('info') }}");
                    </script>
                @endif
                @if (session()->has('warning'))
                    <script>
                        toastr.warnig("{{ session('warnig') }}");
                    </script>
                @endif

    </x-app-layout>
