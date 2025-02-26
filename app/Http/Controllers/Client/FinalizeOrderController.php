<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinalizeOrderController extends Controller
{
    public function index()
    {
        $addressData = [
            'postalCode' => '',
            'localidade' => '',
            'distrito' => '',
            'concelho' => '',
            'designacaoPostal' => '',
        ];

        return view('client.blades.finalize-order', compact('addressData'));
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'postalCode' => 'required|string',
            'localidade' => 'required|string',
            'distrito' => 'required|string',
            'concelho' => 'required|string',
            'designacaoPostal' => 'required|string',
        ]);

        // Retornando os dados recebidos para o frontend, ou uma mensagem de sucesso.
        return response()->json([
            'message' => 'Dados recebidos com sucesso',
            'data' => $validated,
        ]);
    }
}
