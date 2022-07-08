<div>
    <x-jet-button wire:click="$set('open', true)">
        Dejanos tu Opinión!
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Encuesta de Satisfacción del Cliente
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <hr>
                <div class="mt-2">
                    <strong>¿Qué tanto considera la facilidad de uso del sistema a comparación de la manera
                        tradicional?</strong>
                    <div>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa1" type="radio" value="1" wire:model.defer="usa1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            {{-- <x-jet-input type="radio" name="usa1" value="1" class="focus:border-indigo-300 text-indigo-600 rounded-full"/> --}}
                            <span>Insatisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa1" type="radio" value="2" wire:model.defer="usa1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Poco satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa1" type="radio" value="3" wire:model.defer="usa1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Regular</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa1" type="radio" value="4" wire:model.defer="usa1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa1" type="radio" value="5" wire:model.defer="usa1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Muy Satisfecho</span>
                        </label>
                        @error('usa1')
                        <span class="text-red-600">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="mt-2">
                    <strong>¿Considera que la atención es mucho más rápida?</strong>
                    <div>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa2" type="radio" value="1" wire:model.defer="usa2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Insatisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa2" type="radio" value="2" wire:model.defer="usa2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Poco satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa2" type="radio" value="3" wire:model.defer="usa2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Regular</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa2" type="radio" value="4" wire:model.defer="usa2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="usa2" type="radio" value="5" wire:model.defer="usa2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Muy Satisfecho</span>
                        </label>
                        @error('usa2')
                            <span class="text-red-600">
                                {{$message}}
                            </span>
                            @enderror
                    </div>
                </div>
                <hr>
                <div class="mt-2">
                    <strong>¿El sistema responde con velocidad en sus procedimientos?</strong>
                    <div>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun1" type="radio" value="1" wire:model.defer="fun1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Insatisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun1" type="radio" value="2" wire:model.defer="fun1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Poco satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun1" type="radio" value="3" wire:model.defer="fun1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Regular</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun1" type="radio" value="4" wire:model.defer="fun1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun1" type="radio" value="5" wire:model.defer="fun1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Muy Satisfecho</span>
                        </label>
                        @error('fun1')
                        <span class="text-red-600">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="mt-2">
                    <strong>¿El sistema descarga correctamente sus reportes en los formatos disponibles?</strong>
                    <div>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun2" type="radio" value="1" wire:model.defer="fun2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Insatisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun2" type="radio" value="2" wire:model.defer="fun2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Poco satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun2" type="radio" value="3" wire:model.defer="fun2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Regular</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun2" type="radio" value="4" wire:model.defer="fun2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="fun2" type="radio" value="5" wire:model.defer="fun2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Muy Satisfecho</span>
                        </label>
                        @error('fun2')
                        <span class="text-red-600">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="mt-2">
                    <strong>¿El sistema puede usarlo con normalidad en su móvil?</strong>
                    <div>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc1" type="radio" value="1" wire:model.defer="acc1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Insatisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc1" type="radio" value="2" wire:model.defer="acc1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Poco satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc1" type="radio" value="3" wire:model.defer="acc1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Regular</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc1" type="radio" value="4" wire:model.defer="acc1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc1" type="radio" value="5" wire:model.defer="acc1" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Muy Satisfecho</span>
                        </label>
                        @error('acc1')
                        <span class="text-red-600">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="mt-2">
                    <strong>¿Considera muy util poder hacer el seguimiento de sus expedientes enviados?</strong>
                    <div>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc2" type="radio" value="1" wire:model.defer="acc2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Insatisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc2" type="radio" value="2" wire:model.defer="acc2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Poco satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc2" type="radio" value="3" wire:model.defer="acc2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Regular</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc2" type="radio" value="4" wire:model.defer="acc2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Satisfecho</span>
                        </label>
                        <label class="inline-flex items-center mt-6 ml-2">
                            <input name="acc2" type="radio" value="5" wire:model.defer="acc2" wire:click="restore"
                                class="
                            text-indigo-600
                            border-gray-300
                            rounded-full
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                          " />
                            <span>Muy Satisfecho</span>
                        </label>
                        @error('acc2')
                        <span class="text-red-600">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
        </x-slot>

        <x-slot name="footer">
            <div class="mr-2">
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="">
                <x-jet-danger-button wire:click="enviar">
                    Enviar
                </x-jet-danger-button>
            </div>

        </x-slot>

    </x-jet-dialog-modal>

</div>
