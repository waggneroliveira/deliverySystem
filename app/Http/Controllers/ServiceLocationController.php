<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Taxa;
use Illuminate\Http\Request;
use App\Models\ServiceLocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceLocationController extends Controller
{
    public function index()
    {   
        $serviceLocations = ServiceLocation::get();

        $taxas = Taxa::get();
        $taxasArray = [];

        foreach ($taxas as $taxa) {
            $taxasArray[$taxa->id] = $taxa->taxa;
        }

        return view('admin.blades.serviceLocation.index', compact('taxasArray', 'serviceLocations'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;
                ServiceLocation::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }
    }

    public function update(Request $request, ServiceLocation $serviceLocation)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $data['active'] = $request->active?1:0;
                $serviceLocation->fill($data)->save();
            DB::commit();
            session()->flash('success', __('dashboard.response_item_update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_update'));
            return redirect()->back();
        }
    }

    public function destroy(ServiceLocation $serviceLocation)
    {
        $serviceLocation->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {    
        foreach ($request->deleteAll as $serviceLocationId) {
            $serviceLocation = ServiceLocation::find($serviceLocationId);
    
            if ($serviceLocation) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($serviceLocation)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $serviceLocationId,
                            'taxa_id' => $serviceLocation->taxa_id,
                            'name' => $serviceLocation->name,
                            'sorting' => $serviceLocation->sorting,
                            'active' => $serviceLocation->active,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                Log::warning("Item com ID $serviceLocationId não encontrado.");
            }
        }
    
        $deleted = ServiceLocation::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '.__('dashboard.response_item_delete')]);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $serviceLocation = ServiceLocation::find($id);
    
            if ($serviceLocation) {
                $serviceLocation->sorting = $sorting;
                $serviceLocation->save();
            } else {
                \Log::warning("Item com ID $id não encontrado.");
            }

            if($serviceLocation) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($serviceLocation)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'taxa_id' => $serviceLocation->taxa_id,
                            'name' => $serviceLocation->name,
                            'sorting' => $serviceLocation->sorting,
                            'active' => $serviceLocation->active,
                            'event' => 'order_updated',
                        ]
                    ])
                    ->log('order_updated');
            } else {
                \Log::warning("Item com ID $id não encontrado.");
            }
        }
    
        return Response::json(['status' => 'success']);
    }
}
