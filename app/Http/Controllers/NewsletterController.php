<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class NewsletterController extends Controller
{

    public function index()
    {
        $newsletters = Newsletter::get();
        return view('admin.blades.newsletter.index', compact('newsletters'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                Newsletter::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {    
        foreach ($request->deleteAll as $newsletterId) {
            $newsletter = Newsletter::find($newsletterId);
            
            if ($newsletter) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($newsletter)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $newsletterId,
                            'name' => $newsletter->name,
                            'email' => $newsletter->email,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $newsletterId não encontrado.");
            }
        }
    
        $deleted = Newsletter::whereIn('id', $request->deleteAll)->delete();
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '.__('dashboard.response_item_delete')]);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }
}
