<?php

namespace App\Http\Controllers;

use App\Models\Taxa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class TaxaController extends Controller
{

    public function index()
    {
        $taxas = Taxa::get();

        return view('admin.blades.taxa.index', compact('taxas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                Taxa::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }
    }

    public function update(Request $request, Taxa $taxa)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $taxa->fill($data)->save();
            DB::commit();
            session()->flash('success', __('dashboard.response_item_update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_update'));
            return redirect()->back();
        }
    }

    public function destroy(Taxa $taxa)
    {
        $taxa->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {    
        foreach ($request->deleteAll as $taxaId) {
            $taxa = Taxa::find($taxaId);
    
            if ($taxa) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($taxa)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $taxaId,
                            'taxa' => $taxa->taxa,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                Log::warning("Item com ID $taxaId não encontrado.");
            }
        }
    
        $deleted = Taxa::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '.__('dashboard.response_item_delete')]);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }
}
