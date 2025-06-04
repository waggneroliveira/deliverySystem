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
                                    <li class="breadcrumb-item active">Locais de atendimentos</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Locais de atendimentos</h4>
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
                                            @if (Auth::user()->hasPermissionTo('locais de atendimentos.visualizar') &&
                                            Auth::user()->hasPermissionTo('locais de atendimentos.remover') ||
                                            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                            Auth::user()->hasRole('Super'))
                                                <button id="btSubmitDelete" data-route="{{route('admin.dashboard.serviceLocation.destroySelected')}}" type="button" class="btSubmitDelete btn btn-danger" style="display: none;">{{__('dashboard.btn_delete_all')}}</button>
                                            @endif
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            @if (Auth::user()->hasPermissionTo('locais de atendimentos.visualizar') &&
                                            Auth::user()->hasPermissionTo('locais de atendimentos.criar') ||
                                            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                            Auth::user()->hasRole('Super'))
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#serviceLocation-create"><i class="mdi mdi-plus-circle me-1"></i> {{__('dashboard.btn_create')}}</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="serviceLocation-create" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">{{__('dashboard.btn_create')}}</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form action="{{route('admin.dashboard.serviceLocation.store')}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3 col-12 d-flex align-items-start flex-column">
                                                                        <label for="serviceLocation" class="form-label">Taxas <span class="text-danger">*</span></label>
                                                                        @php
                                                                            $currentTaxa = isset($serviceLocation) ? $serviceLocation->taxa_id : null;
                                                                        @endphp
                                                                    
                                                                        <select name="taxa_id" class="form-select" id="serviceLocation" required>
                                                                            <option value="" disabled selected>Selecione o Cliente</option>
                                                                            @foreach ($taxasArray as $taxaValue => $taxaLabel)
                                                                                <option value="{{ $taxaValue }}" {{ $taxaValue == $currentTaxa ? 'selected' : '' }}>
                                                                                    {{ $taxaLabel }}
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
                                                <th>Nome</th>
                                                <th>Taxa de entrega</th>
                                                <th>Status</th>
                                                <th style="width: 85px;">Ações</th>
                                            </tr>
                                        </thead>
    
                                        <tbody data-route="{{route('admin.dashboard.serviceLocation.sorting')}}">
                                            @foreach ($serviceLocations as $key => $serviceLocation)
                                                @php
                                                    $fmt = new \NumberFormatter('pt_PT', \NumberFormatter::CURRENCY);
                                                    $valor =  $fmt->formatCurrency($serviceLocation->taxa->taxa, 'EUR');
                                                @endphp

                                                <tr data-code="{{$serviceLocation->id}}">
                                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                    <td class="bs-checkbox">
                                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$serviceLocation->id}}"></label>
                                                    </td>
                                                    <td>{{$serviceLocation->name}}</td>
                                                    <td>{{$valor}}</td>
                                                    <td>
                                                        @switch($serviceLocation->active)
                                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                                        @endswitch
                                                    </td>
                                                    <td class="d-flex gap-lg-1 justify-center">
                                                        @if (Auth::user()->hasPermissionTo('locais de atendimentos.visualizar') &&
                                                        Auth::user()->hasPermissionTo('locais de atendimentos.editar') ||
                                                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                                        Auth::user()->hasRole('Super'))
                                                            <button class="table-edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-group-edit-{{$serviceLocation->id}}" style="padding: 2px 8px;width: 30px"><span class="mdi mdi-pencil"></span></button>
                                                            <div class="modal fade" id="modal-group-edit-{{$serviceLocation->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h4 class="modal-title" id="myCenterModalLabel">{{__('dashboard.group_and_permission')}}</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body p-4">
                                                                            <form action="{{ route('admin.dashboard.serviceLocation.update', ['serviceLocation' => $serviceLocation->id]) }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                @include('admin.blades.serviceLocation.form')    
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

                                                        @if (Auth::user()->hasPermissionTo('locais de atendimentos.visualizar') &&
                                                        Auth::user()->hasPermissionTo('locais de atendimentos.remover') ||
                                                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                                                        Auth::user()->hasRole('Super'))
                                                            <form action="{{route('admin.dashboard.serviceLocation.destroy',['serviceLocation' => $serviceLocation->id])}}" style="width: 30px" method="POST">
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
                                   {{-- {{$locais de atendimentos->links()}} --}}
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
