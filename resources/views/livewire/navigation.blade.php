<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="bg-gray-800" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button x-on:click="open=true" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">

                        <img class="block lg:hidden h-8 w-auto"
                            src="{{ asset('img/logo blanco.png') }}" alt="Workflow">
                        <img class="hidden lg:block h-8 w-auto"
                            src="{{ asset('img/logo blanco.png') }}"
                            alt="Workflow">
                    </div>

                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            @if (Auth::user() == null)
                                <a href="{{ route('login') }}"
                                    class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                                    aria-current="page">Ingresa o regístrate</a>
                            @else
                                @can("aplicants.procedings.create")
                                <a href="{{ route('aplicants.procedings.create') }}"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Genera
                                    tu expediente</a>
                                @endcan

                                @can("aplicants.tracings.index")
                                <a href="{{ route('aplicants.tracings.index') }}"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Tus expedientes</a>
                                @endcan
                                <a href="#" target="__blank"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Dejanos tu opinion!</a>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">









                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button x-on:click="open=true" type="button"
                                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">

                                @if (Auth::user())
                                    <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" />
                                @endif
                            </button>
                        </div>



                        <div x-show="open" x-on:click.away="open=false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->

                            @can("admin.index")
                            <a href="{{ route('admin.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Administracion</a>

                            @endcan



                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Tu perfil</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    Cerrar Sesión
                                </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away="open=false">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                @if (Auth::user() == null)
                <a href="{{ route('login') }}"
                    class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                    aria-current="page">Ingresa o regístrate</a>
            @else
                @can("aplicants.procedings.create")
                <a href="{{ route('aplicants.procedings.create') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Genera
                    tu expediente</a>
                @endcan

                @can("aplicants.tracings.index")
                <a href="{{ route('aplicants.tracings.index') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Tus expedientes</a>
                @endcan
                <a href="#" target="__blank"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Dejanos tu opinion!</a>
            @endif


                {{-- <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>

                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a> --}}
            </div>
        </div>
    </nav>

</div>
