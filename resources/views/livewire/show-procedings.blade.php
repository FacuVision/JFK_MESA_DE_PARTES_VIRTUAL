<div>

    <!-- wire:model="department" -->
    <select name="referencia" wire:model="district"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option>[seleccione una opcion]</option>
        @foreach($expsubsanar as $dep)
            <option value="{{ $dep->code }}">{{ $dep->code }} - {{ $dep->title }}</option>
        @endforeach
    </select>




</div>
