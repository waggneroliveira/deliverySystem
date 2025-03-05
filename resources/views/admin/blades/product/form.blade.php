<div class="mb-3 col-12 d-flex align-items-start flex-column">
    <label for="category-select" class="form-label">Categoria(s) <span class="text-danger">*</span></label>
    @php
        $currentCategory = isset($product) ? $product->produtc_category : null;
    @endphp

    <select name="produtc_category" class="form-select" id="category-select" required>
        <option value="" disabled selected>Selecione o Cliente</option>
        @foreach ($categoryProducts as $categoryValue => $categoryLabel)
            <option value="{{ $categoryValue }}" {{ $categoryValue == $currentCategory ? 'selected' : '' }}>
                {{ $categoryLabel }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input type="text" name="title" class="form-control" id="title{{isset($product->id)?$product->id:''}}" value="{{isset($product)?$product->title:''}}" placeholder="Digite seu nome">
</div>

<div class="mb-3 col-12 d-flex align-items-start flex-column">
    <label for="{{ $textareaId }}" class="form-label">Descrição</label>
    <textarea name="description" class="form-control col-12" id="{{ $textareaId }}" rows="5">
        {!!isset($product)?$product->description:''!!}
    </textarea>
</div>

<div class="col-lg-12">
    <div class="mt-3">
        <label for="path_image" class="form-label">Imagem</label>
        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($product)?$product->path_image<>''?url('storage/'.$product->path_image):'':''}}"  />
        <p class="text-muted text-center mt-2 mb-0">{{__('dashboard.text_img_size')}} <b class="text-danger">2 MB</b>.</p>
    </div>
</div>

<div class="mb-3">
    <div class="form-check">
        <input name="active" {{ isset($product->active) && $product->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($product->id)?$product->id:''}}" />
        <label class="form-check-label" for="invalidCheck">{{__('dashboard.active')}}?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
    <div class="form-check">
        <input name="promotion" {{ isset($product->promotion) && $product->promotion == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck1{{isset($product->id)?$product->id:''}}" />
        <label class="form-check-label" for="invalidCheck1">Produto Promocional?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
    <div class="form-check">
        <input name="highlight_home" {{ isset($product->highlight_home) && $product->highlight_home == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck2{{isset($product->id)?$product->id:''}}" />
        <label class="form-check-label" for="invalidCheck2">Destacar na home?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>

