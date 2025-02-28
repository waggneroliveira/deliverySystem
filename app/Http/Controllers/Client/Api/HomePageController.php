<?php

namespace App\Http\Controllers\Client\Api;

use App\Models\Slide;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;

class HomePageController extends Controller
{
    public function slides() {
        try {
            $slides = Slide::active()->sorting()->get();
    
            return response()->json($slides->map(function ($slide) {
                return [
                    'id' => $slide->id,
                    'title' => $slide->title,
                    'active' => $slide->active,
                    'description' => $slide->description,
                    'image' => $slide->path_image ? asset('storage/' . $slide->path_image) : null, 
                    'image_mobile' => $slide->path_image_mobile ? asset('storage/' . $slide->path_image_mobile) : null,
                ];
            }));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar os slides'], 500);
        }
    }
    
    public function productCategories(){
        try {
            $productCategories = ProductCategory::active()->sorting()->get();

            return response()->json($productCategories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'slug' => $category->slug,
                    'active' => $category->active,
                    'image' => $category->path_image ? asset('storage/' . $category->path_image) : null, 
                ];
            }));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar os slides'], 500);
        }
    }
}
