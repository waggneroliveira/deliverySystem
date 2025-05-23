<div class="mb-3">
    <label for="taxa" class="form-label">Valor</label>
    <input type="number" required min="0" step="0.01" name="taxa" class="form-control" id="taxa{{isset($taxa->id)?$taxa->id:''}}" value="{{isset($taxa)?$taxa->taxa:''}}" placeholder="Digite o valor da taxa">
</div>


