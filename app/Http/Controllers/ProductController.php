<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\SettingThemeRepository;
use App\Repositories\UserPermissionRepository;
use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/products/';
    public function index(UserPermissionRepository $userPermissionRepository)
    {
        $products = Product::with('stocks')->get();
        $settingTheme = (new SettingThemeRepository())->settingTheme();
        $users = User::excludeSuper()->with('roles');
        $filteredUsers = $userPermissionRepository->filterUsersByPermissions($users);
        $categories = ProductCategory::active()->get();
        $categoryProducts = [];

        foreach ($categories as $category) {
            $categoryProducts[$category->id] = $category->title;
        }

        if ($filteredUsers === 'forbidden') {
            return view('admin.error.403', compact('settingTheme'));
        }

        return view('admin.blades.product.index', compact('products', 'categoryProducts'));
    }

  
    public function store(Request $request)
    {
        $data = $request->except('path_image');
        $helper = new HelperArchive();

        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        $path_image = $helper->renameArchiveUpload($request, 'path_image');
        if ($path_image) {
            $data['path_image'] = $this->pathUpload . $path_image;
        }
        if ($path_image) {
            $request->file('path_image')->storeAs($this->pathUpload, $path_image);
        }

        $data['active'] = $request->active ? 1 : 0;
        $data['promotion'] = $request->promotion ? 1 : 0;
        $data['slug'] = Str::slug($request->title);

        try {
            DB::beginTransaction();
                Product::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $helper = new HelperArchive();
        // dd($data);
        $path_image = $helper->renameArchiveUpload($request, 'path_image');
        if ($path_image) {
            $data['path_image'] = $this->pathUpload . $path_image;
        }
        if ($path_image) {
            $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            Storage::delete(isset($product->path_image));
        }
        if(isset($request->delete_path_image) && !$path_image){
            $inputFile = $request->delete_path_image;
            Storage::delete($product->$inputFile);
            $data['path_image'] = null;
        }

        try {
            DB::beginTransaction();
                $data['active'] = $request->active ? 1 : 0;
                $data['promotion'] = $request->promotion ? 1 : 0;
                $data['slug'] = Str::slug($request->title);
                $product->fill($data)->save();
            DB::commit();
            session()->flash('success', __('dashboard.response_item_update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Erro', __('dashboard.response_item_error_update'));
            return redirect()->back();
        }
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->path_image);
        $product->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {    
        foreach ($request->deleteAll as $productId) {
            $product = Product::find($productId);
    
            if ($product) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($product)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $productId,
                            'path_image' => $product->path_image,
                            'title' => $product->title,
                            'slug' => $product->slug,
                            'sorting' => $product->sorting,
                            'active' => $product->active,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $productId não encontrado.");
            }
        }
    
        $deleted = Product::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '.__('dashboard.response_item_delete')]);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $product = Product::find($id);
    
            if($product) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($product)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'path_image' => $product->path_image,
                            'title' => $product->title,
                            'slug' => $product->slug,
                            'sorting' => $product->sorting,
                            'active' => $product->active,
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
