<div class="mb-3 col-12 d-flex align-items-start flex-column">
   <input type="hidden" name="product_id" value="{{isset($product)?$product->id:''}}">
</div>
<div class="row">
    <div class="mb-3 col-3">
        <label for="quantity" class="form-label">Estoque</label>
        <input type="number" required name="quantity" min="0" class="form-control" id="quantity{{isset($stock->id)?$stock->id:''}}" value="{{isset($stock)?$stock->quantity:''}}" placeholder="Digite a qauntidade de estoque">
    </div>
    <div class="mb-3 col-5">
        <label for="promotion_value" class="form-label">Valor Promocional</label>
        <input type="number" required name="promotion_value" min="0" step="0.01" class="form-control" 
            id="promotion_value{{ isset($stock->id) ? $stock->id : '' }}" 
            value="{{ isset($stock) ? number_format($stock->promotion_value, 2, '.', '') : '' }}" 
            placeholder="Digite o valor promocional">
    </div>
    
    <div class="mb-3 col-4">
        <label for="amount" class="form-label">Valor</label>
        <input type="number" required name="amount" min="0" step="0.01" class="form-control" 
            id="amount{{ isset($stock->id) ? $stock->id : '' }}" 
            value="{{ isset($stock) ? number_format($stock->amount, 2, '.', '') : '' }}" 
            placeholder="Digite o valor do produto">
    </div>
</div>


