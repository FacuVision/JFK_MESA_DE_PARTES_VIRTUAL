<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nombres') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                <input type="hidden" name="name" id="name" value="">
            </div>

            <div class="mt-4">
                <x-jet-label for="lastname" value="{{ __('Apellidos') }}" />
                <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" required />
                <input type="hidden" name="apellido" id="apellido" value="">
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirme Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>


            <div class="col-span-6 sm:col-span-3">
                <label for="type_document_id" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select id="type_document_id" name="type_document_id"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach ($collection as $item)

                    @endforeach
                    <option value="m">Hombre</option>

                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="document_number" value="{{ __('DNI') }}" />
                <x-jet-input id="document_number" class="block mt-1 w-full" type="text" :value="old('dni')" name="document_number" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="fecha_nac" value="{{ __('Fecha de Nacimiento') }}" />
                <x-jet-input id="fecha_nac" name="fecha_nac" type="date" class="mt-1 block w-full"
                    wire:model.defer="state.fecha_nac" />
            </div>

            <div class="mt-4">
                <x-jet-label for="edad" value="{{ __('Edad') }}" />
                <x-jet-input id="edad" class="block mt-1 w-full" :value="old('edad')" type="number" name="edad" required
                    autocomplete="edad" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select id="sexo" name="sexo"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="m">Hombre</option>
                    <option value="f">Mujer</option>
                </select>
            </div>





            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
                                        'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
                                    ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
