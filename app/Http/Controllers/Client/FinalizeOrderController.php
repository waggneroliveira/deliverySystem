<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function verifyPostalCode(Request $request)
    {
        $request->validate([
            'postal_code' => 'required|string|min:7'
        ]);
        $postalCode = $request->postal_code;

        $url = "https://api.allorigins.win/raw?url=https://json.geoapi.pt/cp/{$postalCode}";
    
        try {
            $response = Http::get($url);
    
            // Verifica se a resposta é válida
            if (!$response->successful()) {
                return response()->json(['error' => 'Erro na requisição externa'], $response->status());
            }
    
            // Verifica se a resposta contém JSON válido
            $data = json_decode($response->body(), true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'error' => 'Resposta inválida da API',
                    'raw_response' => $response->body() // Exibe o conteúdo recebido
                ], 500);
            }
    
            // Retorna os dados verificados
            return response()->json([
                'codigo_postal' => $data['CP'] ?? 'Não encontrado',
                'designacao_postal' => $data['Designação Postal'] ?? 'Não encontrado',
                'concelho' => $data['Concelho'] ?? 'Não encontrado',
                'distrito' => $data['Distrito'] ?? 'Não encontrado',
                'localidade' => $data['Localidade'] ?? 'Não encontrado',
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar CEP',
                'exception' => $e->getMessage()
            ], 500);
        }
    }
    

}
