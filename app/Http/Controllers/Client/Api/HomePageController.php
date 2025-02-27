<?php

namespace App\Http\Controllers\Client\Api;

use App\Models\Slide;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function slides() {
        try {
            $slides = Slide::active()->sorting()->get();
            
            \Log::info('Slides encontrados:', $slides->toArray()); // Log para verificar os dados
    
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
            \Log::error('Erro ao buscar slides:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao buscar os slides'], 500);
        }
    }
    
}
