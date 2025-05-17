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
    
    public function categories(){
        try {
            $productCategories = ProductCategory::whereHas('products', function ($query) {
                $query->where('active', 1);
            })
            ->with(['products' => function ($query) {
                $query->where('active', 1);
            }])
            ->active()
            ->sorting()
            ->get();

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
            return response()->json(['error' => 'Erro ao buscar as categorias' . $e], 500);
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
            return response()->json([
                'error' => 'Erro ao buscar os produtos',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }
    
    public function productWithCategory($category = null){
        try {
            if ($category === '') {
                $category = null;
            }

            $query = Product::with('stocks')->active();

            if ($category) {
                $categoryData = ProductCategory::where('slug', $category)->first();

                if ($categoryData) {
                    // Encontrou como categoria
                    $query->join('product_categories', 'products.produtc_category', '=', 'product_categories.id')
                        ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
                        ->select([
                            'products.id',
                            'products.title',
                            'products.description',
                            'products.slug',
                            'products.path_image',
                            'products.active as activeProducts',
                            'product_stocks.promotion_value',
                            'product_stocks.quantity',
                            'product_stocks.amount',
                            'product_categories.id as categoryId',
                            'product_categories.title as categoryTitle',
                            'product_categories.slug as categorySlug',
                            'product_categories.active as categoryActive',
                        ])
                        ->where('products.produtc_category', $categoryData->id);
                } else {
                    // Se não é categoria, busca como slug de produto
                    $query->where('products.slug', $category);
                }
            } else {
                $query->where('highlight_home', 1)->sorting()->limit(6);
            }

            $products = $query->get();

            // Se não achou nada, retorna vazio logo:
            if ($products->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($products->map(function ($product) {
                $stock = $product->stocks->first(); // cuidado com nulo

                return [
                    'categoryTitle' => $product->categoryTitle,
                    'id' => $product->id,
                    'title' => $product->title,
                    'text' => $product->description,
                    'slug' => $product->slug,
                    'active' => $product->active,
                    'promotion_value' => optional($stock)->promotion_value,
                    'highlight_home' => $product->highlight_home,
                    'image' => $product->path_image ? asset('storage/' . $product->path_image) : null,
                    'price' => $stock && $stock->promotion_value > 0
                        ? number_format($stock->promotion_value, 2, '.', '')
                        : ($stock ? number_format($stock->amount, 2, '.', '') : ''),
                    'oldPrice' => $stock && $stock->promotion_value > 0
                        ? number_format($stock->amount, 2, '.', '')
                        : null,
                    'tag' => $stock && $stock->promotion_value > 0
                        ? round(100 - ($stock->promotion_value * 100 / $stock->amount)) . '%' . ' off'
                        : null,
                    'stock' => $stock ? $stock->quantity : 0,
                    'outOfStock' => $stock && $stock->quantity <= 0,
                ];
            }));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar os produtos',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    
}
