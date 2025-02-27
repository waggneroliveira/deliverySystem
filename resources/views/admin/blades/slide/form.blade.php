<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input type="text" name="title" class="form-control" id="title{{isset($slide->id)?$slide->id:''}}" value="{{isset($slide)?$slide->title:''}}" placeholder="Digite seu nome">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descrição </label>
    <input type="text" name="description" class="form-control" id="description{{isset($slide->id)?$slide->id:''}}" value="{{isset($slide)?$slide->description:''}}" placeholder="Descrição">
</div>

<div class="col-lg-12">
    <div class="mt-3">
        <label for="path_image" class="form-label">Imagem desktop</label>
        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($slide)?$slide->path_image<>''?url('storage/'.$slide->path_image):'':''}}"  />
        <p class="text-muted text-center mt-2 mb-0">{{__('dashboard.text_img_size')}} <b class="text-danger">2 MB</b>.</p>
    </div>
</div>
<div class="col-lg-12">
    <div class="mt-3">
        <label for="path_image_mobile" class="form-label">Imagem mobile</label>
        <input type="file" name="path_image_mobile" data-plugins="dropify" data-default-file="{{isset($slide)?$slide->path_image_mobile<>''?url('storage/'.$slide->path_image_mobile):'':''}}"  />
        <p class="text-muted text-center mt-2 mb-0">{{__('dashboard.text_img_size')}} <b class="text-danger">2 MB</b>.</p>
    </div>
</div>
<div class="mb-3">
    <div class="form-check">
        <input name="active" {{ isset($slide->active) && $slide->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($slide->id)?$slide->id:''}}" />
        <label class="form-check-label" for="invalidCheck">{{__('dashboard.active')}}?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>

