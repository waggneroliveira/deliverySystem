@extends('admin.core.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Produtos</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Produtos</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-12 d-flex justify-between">
                                        <div class="col-6">
                                            @if (Auth::user()->hasPermissionTo('produtos.visualizar') &&
                                            Auth::user()->hasPermissionTo('produtos.remover') ||
                                            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                            Auth::user()->hasRole('Super'))
                                                <button id="btSubmitDelete" data-route="{{route('admin.dashboard.product.destroySelected')}}" type="button" class="btSubmitDelete btn btn-danger" style="display: none;">{{__('dashboard.btn_delete_all')}}</button>
                                            @endif
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            @if (Auth::user()->hasPermissionTo('produtos.visualizar') &&
                                            Auth::user()->hasPermissionTo('produtos.criar') ||
                                            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                            Auth::user()->hasRole('Super'))
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#product-create"><i class="mdi mdi-plus-circle me-1"></i> {{__('dashboard.btn_create')}}</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="product-create" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">{{__('dashboard.btn_create')}}</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form action="{{route('admin.dashboard.product.store')}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
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
                                                                        <input type="text" name="title" class="form-control" id="title" placeholder="Digite seu nome">
                                                                    </div>
                                                                    
                                                                    <div class="mb-3 col-12 d-flex align-items-start flex-column">
                                                                        <label for="textarea-create" class="form-label">Descrição</label>
                                                                        <textarea name="description" class="form-control col-12" id="textarea-create" rows="5"></textarea>
                                                                    </div>
                                                                    
                                                                    <div class="col-lg-12">
                                                                        <div class="mt-3">
                                                                            <label for="path_image" class="form-label">Imagem</label>
                                                                            <input type="file" name="path_image" data-plugins="dropify" />
                                                                            <p class="text-muted text-center mt-2 mb-0">{{__('dashboard.text_img_size')}} <b class="text-danger">2 MB</b>.</p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <div class="form-check">
                                                                            <input name="active" type="checkbox" class="form-check-input" id="invalidCheck{{isset($product->id)?$product->id:''}}" />
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
                                                                    <div class="d-flex justify-content-end gap-2">
                                                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">{{__('dashboard.btn_cancel')}}</button>
                                                                        <button type="submit" class="btn btn-success waves-effect waves-light">{{__('dashboard.btn_create')}}</button>
                                                                    </div>                                                 
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-sortable table table-centered table-nowrap table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="bs-checkbox">
                                                    <label><input name="btnSelectAll" type="checkbox"></label>
                                                </th>
                                                {{-- <th>Link</th> --}}
                                                <th>Título</th>
                                                <th>Imagem</th>
                                                <th>Status</th>
                                                <th>Destaque</th>
                                                <th>Promocional</th>
                                                <th style="width: 85px;">Ações</th>
                                            </tr>
                                        </thead>
    
                                        <tbody data-route="{{route('admin.dashboard.product.sorting')}}">
                                            @foreach ($products as $key => $product)
                                                <tr data-code="{{$product->id}}">
                                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                    <td class="bs-checkbox">
                                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$product->id}}"></label>
                                                    </td>
                                                    <td>{{$product->title}}</td>
                                                    <td class="table-user">
                                                        @if ($product->path_image)
                                                            <img src="{{ asset('storage/'.$product->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @switch($product->active)
                                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @switch($product->highlight_home)
                                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @switch($product->promotion)
                                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                                        @endswitch
                                                    </td>
                                                    <td class="d-flex gap-lg-1 justify-center">
                                                        @if (Auth::user()->hasPermissionTo('produtos.visualizar') &&
                                                        Auth::user()->hasPermissionTo('produtos.editar') ||
                                                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                                        Auth::user()->hasRole('Super'))
                                                            <button class="table-edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-stock-create-{{$product->id}}" style="padding: 2px 8px;width: 30px"><span class="mdi mdi-package-variant"></span></button>
                                                            <div class="modal fade" id="modal-stock-create-{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h4 class="modal-title" id="myCenterModalLabel">Estoque</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body p-4">
                                                                            @if (isset($product->stocks))
                                                                                @if (!$product->stocks->contains('product_id', $product->id))                                                                                    
                                                                                    <form action="{{ route('admin.dashboard.productStock.store') }}" method="POST">
                                                                                        @csrf
                                                                                        @method('POST')
                                                                                    
                                                                                        <div class="mb-3 col-12 d-flex align-items-start flex-column">
                                                                                            <input type="hidden" name="product_id" value="{{ isset($product) ? $product->id : '' }}">
                                                                                        </div>
                                                                                    
                                                                                        <div class="row">
                                                                                            <div class="mb-3 col-3">
                                                                                                <label for="quantity" class="form-label">Estoque</label>
                                                                                                <input type="number" required name="quantity" min="0" class="form-control" id="quantity"
                                                                                                placeholder="Digite a quantidade de estoque">
                                                                                            </div>
                                                                                    
                                                                                            <div class="mb-3 col-5">
                                                                                                <label for="promotion_value" class="form-label">Valor Promocional</label>
                                                                                                <input type="number" required name="promotion_value" min="0" step="0.01" class="form-control"
                                                                                                    id="promotion_value" 
                                                                                                    placeholder="Digite o valor promocional">
                                                                                            </div>
                                                                                    
                                                                                            <div class="mb-3 col-4">
                                                                                                <label for="amount" class="form-label">Valor</label>
                                                                                                <input type="number" required name="amount" min="0" step="0.01" class="form-control"
                                                                                                    id="amount" 
                                                                                                    placeholder="Digite o valor do produto">
                                                                                            </div>
                                                                                        </div>
                                                                                    
                                                                                        <div class="d-flex justify-content-end gap-2">
                                                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">{{__('dashboard.btn_cancel')}}</button>
                                                                                            <button type="submit" class="btn btn-success waves-effect waves-light">{{__('dashboard.btn_save')}}</button>
                                                                                        </div>                                                                                                                                                                                            
                                                                                    </form>
                                                                                @endif
                                                                            @endif
                                                                            
                                                                            <div class="table-responsive">
                                                                                <table class="table-sortable table table-centered table-nowrap table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Quantidade</th>
                                                                                            <th>Valor promocional</th>
                                                                                            <th>Valor</th>
                                                                                            <th style="width: 85px;">Ações</th>
                                                                                        </tr>
                                                                                    </thead>
                                                
                                                                                    <tbody>
                                                                                        @foreach($product->stocks as $stock)
                                                                                            <tr>                                                                                          
                                                                                                <td>
                                                                                                    {{$stock->quantity}}
                                                                                                </td>
                                                                                                <td>
                                                                                                    {{$stock->promotion_value}}
                                                                                                </td>
                                                                                                <td>
                                                                                                    {{$stock->amount}}
                                                                                                </td>
                                                                                                <td class="d-flex gap-lg-1 justify-center">
                                                                                                    @if (Auth::user()->hasPermissionTo('stocks.visualizar') &&
                                                                                                    Auth::user()->hasPermissionTo('stocks.editar') ||
                                                                                                    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                                                                                    Auth::user()->hasRole('Super'))
                                                                                                        <button class="table-edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-stock-edit-{{$stock->id}}" style="padding: 2px 8px;width: 30px"><span class="mdi mdi-pencil"></span></button>
                                                                                                        <div class="modal fade" id="modal-stock-edit-{{$stock->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-header bg-light">
                                                                                                                        <h4 class="modal-title" id="myCenterModalLabel">{{__('dashboard.group_and_permission')}}</h4>
                                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                                                                    </div>
                                                                                                                    <div class="modal-body p-4">
                                                                                                                        <form action="{{ route('admin.dashboard.productStock.update', ['productStock' => $stock->id]) }}" method="POST" enctype="multipart/form-data">
                                                                                                                            @csrf
                                                                                                                            @method('PUT')
                                                                                                                            @include('admin.blades.productStock.form')    
                                                                                                                            <div class="d-flex justify-content-end gap-2">
                                                                                                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">{{__('dashboard.btn_cancel')}}</button>
                                                                                                                                <button type="submit" class="btn btn-success waves-effect waves-light">{{__('dashboard.btn_save')}}</button>
                                                                                                                            </div>                                                                                                                                                                                            
                                                                                                                        </form>                                                                    
                                                                                                                    </div>
                                                                                                                </div><!-- /.modal-content -->
                                                                                                            </div><!-- /.modal-dialog -->
                                                                                                        </div><!-- /.modal -->                                                        
                                                                                                    @endif
                                            
                                                                                                    @if (Auth::user()->hasPermissionTo('stocks.visualizar') &&
                                                                                                    Auth::user()->hasPermissionTo('stocks.remover') ||
                                                                                                    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                                                                                    Auth::user()->hasRole('Super'))
                                                                                                        <form action="{{route('admin.dashboard.productStock.destroy',['productStock' => $stock->id])}}" style="width: 30px" method="POST">
                                                                                                            @method('DELETE') @csrf        
                                                                                                            
                                                                                                            <button type="button" style="width: 30px"class="demo-delete-row btn btn-danger btn-xs btn-icon btSubmitDeleteItem"><i class="fa fa-times"></i></button>
                                                                                                        </form>                                                    
                                                                                                    @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->     

                                                            <button class="table-edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-group-edit-{{$product->id}}" style="padding: 2px 8px;width: 30px"><span class="mdi mdi-pencil"></span></button>
                                                            <div class="modal fade" id="modal-group-edit-{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h4 class="modal-title" id="myCenterModalLabel">{{__('dashboard.group_and_permission')}}</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body p-4">
                                                                            <form action="{{ route('admin.dashboard.product.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                @include('admin.blades.product.form', ['textareaId' => 'textarea-edit-' . $product->id])    
                                                                                <div class="d-flex justify-content-end gap-2">
                                                                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">{{__('dashboard.btn_cancel')}}</button>
                                                                                    <button type="submit" class="btn btn-success waves-effect waves-light">{{__('dashboard.btn_save')}}</button>
                                                                                </div>                                                                                                                                                                                            
                                                                            </form>                                                                    
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->                                                        
                                                        @endif

                                                        @if (Auth::user()->hasPermissionTo('produtos.visualizar') &&
                                                        Auth::user()->hasPermissionTo('produtos.remover') ||
                                                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                                        Auth::user()->hasRole('Super'))
                                                            <form action="{{route('admin.dashboard.product.destroy',['product' => $product->id])}}" style="width: 30px" method="POST">
                                                                @method('DELETE') @csrf        
                                                                
                                                                <button type="button" style="width: 30px"class="demo-delete-row btn btn-danger btn-xs btn-icon btSubmitDeleteItem"><i class="fa fa-times"></i></button>
                                                            </form>                                                    
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- PAGINATION --}}
                                <div class="mt-3 float-end">
                                   {{-- {{$produtos->links()}} --}}
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <style>
        .cke_notification_warning{
            opacity: -1;
            z-index: -2;
        }
        .cke_chrome{
            width: 100%;
        }
    </style>
@endsection
