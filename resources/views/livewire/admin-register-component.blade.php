<div>
    <div class="row">
        <div class="col">
            <div>
                <label>Departamento</label>
                <select wire:model="department" class="form-control">
                    <option value="">Departamento</option>
                    @foreach ($department as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
            <div>
                <label>Provincia</label>
                <select wire:model="province" class="form-control">
                    <option value="">Provincia</option>

                    @foreach ($provinces as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="col">
            <div>
                <label>Distrito</label>
                <select name="district_id" wire:model="district" class="form-control">

                    <option value="">Distrito</option>

                    @foreach ($districts as $dist)
                        <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

</div>
