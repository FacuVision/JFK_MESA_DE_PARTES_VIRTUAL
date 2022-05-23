<div>

    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Departamento</label>
        <select wire:model="department"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Departamento</option>
            @foreach ($departments as $dep)
                <option value="{{$dep->id}}">{{$dep->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Provincia</label>
        <select wire:model="province"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Provincia</option>

            @foreach ($provinces as $prov)
                <option value="{{$prov->id}}">{{$prov->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Distrito</label>
        <select name="district_id" wire:model="district"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            <option value="">Distrito</option>

            @foreach ($districts as $dist)
                <option value="{{$dist->id}}">{{$dist->name}}</option>
            @endforeach
        </select>
    </div>


</div>
