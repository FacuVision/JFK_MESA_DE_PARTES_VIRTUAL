<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>



    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                {{-- @livewire('profile.update-profile-information-form') --}}
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Profile Information') }}</x-slot>
                        <x-slot name="description">
                            {{ __('Update your account\'s profile information and email address.') }}</x-slot>
                    </x-jet-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        {{-- {!! Form::model($user, ['route' => ['user.profiles.update', $user], 'method' => 'PUT']) !!} --}}
                        {!! Form::open(['method' => 'POST', 'route' => 'user.profiles.store']) !!}
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('email', 'Correo Electronico') !!}
                                    {!! Form::text('email', $user->email, ['disabled','class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('name', 'Nombres') !!}
                                    {!! Form::text('name', $user->name, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('lastname', 'Apellidos') !!}
                                    {!! Form::text('lastname', $user->profile->lastname, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('date_nac', 'Fecha de Nacimiento') !!}
                                    {!! Form::date('date_nac', $user->profile->date_nac, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('address', 'Direccion') !!}
                                    {!! Form::text('address', $user->profile->address, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('type_document_id', 'Tipo de Documento') !!}
                                    {!! Form::text('type_document_id', $user->profile->type_document->name, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('document_number', '# Documento') !!}
                                    {!! Form::text('document_number', $user->profile->document_number, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('phone', 'Celular') !!}
                                    {!! Form::text('phone', $user->profile->phone, ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    {!! Form::label('gender', 'Sexo') !!}
                                    @if ($user->profile->gender == 'm')
                                        {!! Form::text('document_number', 'Masculino', ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                    @else
                                        {!! Form::text('document_number', 'Femenino', ['disabled', 'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
                                    @endif
                                </div>
                                {{-- <div class="col-span-6 sm:col-span-4">
                                    {!! Form::submit('Guardar', ['class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition']) !!}
                                </div> --}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
