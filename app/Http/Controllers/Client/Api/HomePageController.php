<?php

namespace App\Http\Controllers\Client\Api;

use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

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
            return response()->json(['error' => 'Erro ao buscar as categorias'], 500);
        }
    }

    public function products()
    {
        try {
            $products = Product::with('stocks')
            ->active()
            ->where('highlight_home', '=', 1)
            ->sorting()
            ->limit(6)
            ->get();
    
            return response()->json($products->map(function ($product) {
                $stock = $product->stocks->first(); // Pegando o primeiro estoque (se houver)
    
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'text' => $product->description,
                    'slug' => $product->slug,
                    'active' => $product->active,
                    'promotion' => $product->promotion,
                    'highlight_home' => $product->highlight_home,
                    'image' => $product->path_image ? asset('storage/' . $product->path_image) : null,
                    'price' => $stock && isset($stock->promotion_value) && $stock->promotion_value > 0 ? number_format($stock->promotion_value, 2, '.', '') : (isset($stock->amount) ? number_format($stock->amount, 2, '.', '') : ''),
                    'oldPrice' => $stock && isset($stock->promotion_value) && $stock->promotion_value > 0 ? number_format($stock->amount, 2, '.', '') : null,
                    'tag' => $stock && $stock->promotion_value > 0 && $stock->promotion_value ? round(100 - ($stock->promotion_value * 100 / $stock->amount)) . '%' . ' off' : null,
                    'stock' => $stock ? $stock->quantity : 0,
                    'outOfStock' => $stock && $stock->quantity <= 0,
                ];
            }));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar os produtos'], 500);
        }
    }
    
    
    
}
