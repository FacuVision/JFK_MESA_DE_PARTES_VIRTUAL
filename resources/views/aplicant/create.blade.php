<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Expedientes
        </h2>
          
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        DATOS DEL Expediente
                    </div>
                        {!! Form::open(array('route'=>'aplicant.procedings.store', 'method'=>'POST','files'=>true)) !!}

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
                                                    <label for="email-address" class="block text-sm font-medium text-gray-700">Oficina Defensorial a donde desea dirigirse(*)</label>
                                                    {!! Form::select('office_id', $office,null, ['class'=>'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm','placeholder' => '[Selecciones un opción]','required'=>'required']) !!} 
                                                    @error('categoria_id')
                                                        <br>
                                                        <span class="badge badge-danger">{{ $message}}</span>
                                                    @enderror
                                                </div>


                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="first-name" class="block text-sm font-medium text-gray-700">Tipo de Documento (*)</label>
                                                    {!! Form::select('typedocument_id', $typedocument,null, ['class'=>'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm','placeholder' => '[Selecciones un opción]','required'=>'required']) !!} 
                                                    @error('categoria_id')
                                                        <br>
                                                        <span class="badge badge-danger">{{ $message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Número de Documento (*)</label>
                                                    <input type="text" name="" id="last-name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Título de la Solicitud (*)</label>
                                                    <input type="text" name="title" id="title" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                                </div>

                                                <div class="col-span-6 sm:col-span-4">
                                                    <label for="content" class="block text-sm font-medium text-gray-700"> Descripción (*)
                                                        Max. 500 Caracteres</label>
                                                    <div class="mt-1">

                                                        <textarea id="content" name="content" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Ingrese una descripción" required></textarea>
                                                    </div>
                                                    <p class="mt-2 text-sm text-gray-500">Brief description for your profile. URLs are hyperlinked.</p>
                                                </div>



                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="n_foly" class="block text-sm font-medium text-gray-700">Número de Folios</label>
                                                    <input type="text" name="n_foly" id="n_foly" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                                </div>

                                                <div class="col-span-12 sm:col-span-4">
                                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Documento Principal (*)
                                                        Solo archivos PDF. Max. 10Mb</label>

                                                    <!-- component -->
                                                    <div class="flex w-full h-screen items-center  bg-grey-lighter">
                                                        <label class="w-64 flex flex-col items-center px-2 py-3 bg-white text-blue rounded-lg shadow-lg tracking-wide  border border-blue cursor-pointer hover:bg-blue hover:text-white">
                                                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                                            </svg>
                                                            <span class="mt-2 text-base leading-normal">Select file</span>
                                                            <input type='file' name="pdf1" class="hidden" />
                                                        </label>
                                                    </div>
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
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Archivos anexos:</h3>
                                    <p class="mt-1 text-sm text-gray-600">Solo archivos PDF, JPG, DOC, XLS
                                        Para remitir más de 1 anexo, agrupe previamente los archivos en una carpeta de su computadora, luego seleccione todos, y a continnuacion de click en "abrir" para que se carguen en el formulario
                                        Máximo permitido 15Mb</p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="#" method="POST">
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <fieldset>
                                                <legend class="sr-only">Subir archivo (*)</legend>
                                                <div class="text-base font-medium text-gray-900" aria-hidden="true">Subir archivo (*)</div>
                                                <div class="mt-4 space-y-4">
                                                    <!-- component -->
                                                    <div class="flex w-full h-screen items-center justify-center bg-grey-lighter">
                                                        <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                                                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                                            </svg>
                                                            <span class="mt-2 text-base leading-normal">Select file</span>
                                                            <input type='file' name="pdf2" class="hidden" />
                                                        </label>
                                                    </div>

                                                </div>
                                            </fieldset>

                                        </div>

                                        {!! Form::close() !!}
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                        </div>
                                    </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
