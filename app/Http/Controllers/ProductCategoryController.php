<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\SettingThemeRepository;
use App\Repositories\UserPermissionRepository;
use App\Http\Controllers\Helpers\HelperArchive;

class ProductCategoryController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/productCategory/';
    public function index(UserPermissionRepository $userPermissionRepository)
    {
        $productCategories = ProductCategory::sorting()->get();
        $settingTheme = (new SettingThemeRepository())->settingTheme();
        $users = User::excludeSuper()->with('roles');
        $filteredUsers = $userPermissionRepository->filterUsersByPermissions($users);

        if ($filteredUsers === 'forbidden') {
            return view('admin.error.403', compact('settingTheme'));
        }

        return view('admin.blades.productCategory.index', compact('productCategories'));
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
        $data['slug'] = Str::slug($request->title);

        try {
            DB::beginTransaction();
                ProductCategory::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        //productCategory desktop
        $path_image = $helper->renameArchiveUpload($request, 'path_image');
        if ($path_image) {
            $data['path_image'] = $this->pathUpload . $path_image;
        }
        if ($path_image) {
            $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            Storage::delete(isset($productCategory->path_image));
        }
        if(isset($request->delete_path_image) && !$path_image){
            $inputFile = $request->delete_path_image;
            Storage::delete($productCategory->$inputFile);
            $data['path_image'] = null;
        }

        try {
            DB::beginTransaction();
                $data['active'] = $request->active ? 1 : 0;
                $data['slug'] = Str::slug($request->title);
                $productCategory->fill($data)->save();
            DB::commit();
            session()->flash('success', __('dashboard.response_item_update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Erro', __('dashboard.response_item_error_update'));
            return redirect()->back();
        }
    }

    public function destroy(ProductCategory $productCategory)
    {
        Storage::delete(isset($productCategory->path_image)?$productCategory->path_image:'');
        $productCategory->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {    
        foreach ($request->deleteAll as $productCategoryId) {
            $productCategory = ProductCategory::find($productCategoryId);
    
            if ($productCategory) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($productCategory)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $productCategoryId,
                            'path_image' => $productCategory->path_image,
                            'title' => $productCategory->title,
                            'slug' => $productCategory->slug,
                            'sorting' => $productCategory->sorting,
                            'active' => $productCategory->active,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $productCategoryId não encontrado.");
            }
        }
    
        $deleted = ProductCategory::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '.__('dashboard.response_item_delete')]);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $productCategory = ProductCategory::find($id);

            if ($productCategory) {
                $productCategory->sorting = $sorting;
                $productCategory->save();
            } else {
                \Log::warning("Item com ID $id não encontrado.");
            }

            if($productCategory) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($productCategory)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'path_image' => $productCategory->path_image,
                            'title' => $productCategory->title,
                            'slug' => $productCategory->slug,
                            'sorting' => $sorting,
                            'active' => $productCategory->active,
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
