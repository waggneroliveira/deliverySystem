<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductStockController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $productStock = ProductStock::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }
    }

    public function update(Request $request, ProductStock $productStock)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                $productStock->fill($data)->save();
            DB::commit();
            session()->flash('success', __('dashboard.response_item_update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_update'));
            return redirect()->back();
        }
    }

    public function destroy(ProductStock $productStock)
    {
        $productStock->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    // Novo método para decrementar o estoque dos produtos do pedido
    public function decrementStock(Request $request)
    {
        $produtos = $request->input('produtos', []); // [{id, quantity}]

        DB::beginTransaction();
        try {
            foreach ($produtos as $item) {
                $productStock = ProductStock::where('product_id', $item['id'])->first();
                if ($productStock && $productStock->quantity >= $item['quantity']) {
                    $productStock->quantity -= $item['quantity'];
                    $productStock->save();
                }
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
