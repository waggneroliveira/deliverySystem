<div class="mb-3 col-12 d-flex align-items-start flex-column">
    <label for="serviceLocation" class="form-label">Taxas <span class="text-danger">*</span></label>
    @php
        $currentTaxa = isset($serviceLocation) ? $serviceLocation->taxa_id : null;
    @endphp

    <select name="taxa_id" class="form-select" id="serviceLocation" required>
        <option value="" disabled selected>Selecione o Cliente</option>
        @foreach ($taxasArray as $taxaValue => $locationLabel)
            <option value="{{ $taxaValue }}" {{ $taxaValue == $currentTaxa ? 'selected' : '' }}>
                {{ $locationLabel }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" name="name" class="form-control" id="name{{isset($serviceLocation->id)?$serviceLocation->id:''}}" value="{{isset($serviceLocation)?$serviceLocation->name:''}}" placeholder="Digite a Localidade">
</div>

<div class="mb-3">
    <div class="form-check">
        <input name="active" {{ isset($serviceLocation->active) && $serviceLocation->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($serviceLocation->id)?$serviceLocation->id:''}}" />
        <label class="form-check-label" for="invalidCheck">{{__('dashboard.active')}}?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>

