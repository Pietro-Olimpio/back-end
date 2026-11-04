<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AtivoController extends Controller
{
    /**
     * Método index() - Retorna a view com as métricas mokadas
     */
    public function index():View {
        $metricas = [
            "totalAtivos"   => 42,
            "emOperacao"    => 37,
            "emManutencao"  => 4,
            "parados"       => 1,
            "taxaEficiencia"=> 88,5
        ];

        return view("ativos.index", [
            "metricas" => $metricas,
            "titulo"    => "Painel Geral de Ativos Industriais"
        ]);
    }

    // método para retornar o status do servidor em um json
    public function status(): JsonResponse {
        return response()->json([
            "plataforma" => config("app.name"),
            "ambiente"  => config("app.env"),
            "version_php" => PHP_VERSION,
            "status" => "ONLINE",
            "timestamp" => now()->toIso8601String()
        ]);
    }

}
