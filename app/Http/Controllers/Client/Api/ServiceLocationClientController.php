<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceLocation;
use Illuminate\Http\Request;

class ServiceLocationClientController extends Controller
{
    public function locations(){
        
        try {
            $locations = ServiceLocation::whereHas('taxa')
            ->with('taxa')
            ->active()->sorting()->orderBy('name', 'asc')->get();
    
            return response()->json($locations->map(function ($location) {
                return [
                    'id' => $location->id,
                    'taxa_id' => $location->taxa_id,
                    'name' => $location->name,
                    'active' => $location->active,
                    'sorting' => $location->sorting,
                    'taxa' => $location->taxa ? [
                        'id' => $location->taxa->id,
                        'valor' => $location->taxa->taxa,
                    ] : null,
                ];
            }));

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar os Locais de atendimento',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
