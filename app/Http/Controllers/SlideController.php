<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Helpers\HelperArchive;

class SlideController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/slide/';
    public function index()
    {
        $slides = Slide::sorting()->get();

        return view('admin.blades.slide.index', compact('slides'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['path_image', 'path_image_mobile']);
        $helper = new HelperArchive();

        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
            'path_image_mobile' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        //Slide desktop
        $path_image = $helper->renameArchiveUpload($request, 'path_image');
        if ($path_image) {
            $data['path_image'] = $this->pathUpload . $path_image;
        }
        if ($path_image) {
            $request->file('path_image')->storeAs($this->pathUpload, $path_image);
        }

        $data['active'] = $request->active ? 1 : 0;

        //Slide mobile
        $path_image_mobile = $helper->renameArchiveUpload($request, 'path_image_mobile');
        if ($path_image_mobile) {
            $data['path_image_mobile'] = $this->pathUpload . $path_image_mobile;
        }
        if ($path_image_mobile) {
            $request->file('path_image_mobile')->storeAs($this->pathUpload, $path_image_mobile);
        }

        try {
            DB::beginTransaction();
                Slide::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        //slide desktop
        $path_image = $helper->renameArchiveUpload($request, 'path_image');
        if ($path_image) {
            $data['path_image'] = $this->pathUpload . $path_image;
        }
        if ($path_image) {
            $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            Storage::delete($slide->path_image);
        }
        if(isset($request->delete_path_image) && !$path_image){
            $inputFile = $request->delete_path_image;
            Storage::delete($slide->$inputFile);
            $data['path_image'] = null;
        }

        //slide mobile
        $path_image_mobile = $helper->renameArchiveUpload($request, 'path_image_mobile');
        if ($path_image_mobile) {
            $data['path_image_mobile'] = $this->pathUpload . $path_image_mobile;
        }
        if ($path_image_mobile) {
            $request->file('path_image_mobile')->storeAs($this->pathUpload, $path_image_mobile);
            Storage::delete($slide->path_image_mobile);
        }
        if(isset($request->delete_path_image_mobile) && !$path_image_mobile){
            $inputFile = $request->delete_path_image_mobile;
            Storage::delete($slide->$inputFile);
            $data['path_image_mobile'] = null;
        }

        try {
            DB::beginTransaction();
                $data['active'] = $request->active ? 1 : 0;

                $slide->fill($data)->save();

                //slide desktop 
                if ($path_image) {
                    Storage::delete($this->pathUpload . $path_image);
                }
                if ($path_image) {
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }
                //slide mobile
                if ($path_image_mobile) {
                    Storage::delete($this->pathUpload . $path_image_mobile);
                }
                if ($path_image_mobile) {
                    $request->file('path_image_mobile')->storeAs($this->pathUpload, $path_image_mobile);
                }
            DB::commit();
            session()->flash('success', __('dashboard.response_item_update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Erro', __('dashboard.response_item_error_update'));
            return redirect()->back();
        }
    }


    public function destroy(Slide $slide)
    {
        Storage::delete($slide->path_image);
        Storage::delete($slide->path_image_mobile);
        $slide->delete();
        return redirect()->back()->with('sucess', 'Slide deletado com sucesso!');
    }

    public function destroySelected(Request $request)
    {

        if($deleted = Slide::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Slide::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
