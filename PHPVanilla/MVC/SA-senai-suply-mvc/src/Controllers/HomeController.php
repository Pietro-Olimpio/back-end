<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Movimentacao;
use App\Models\Produto;

final Class HomeController extends Controller {


    //método da página index
    public function index() : void {
        $totalInsumos = Produto::totalInsumos();
        $totalEstoque = Produto::totalEstoque();
        $ultimasMovimentacoes = Movimentacao::listarHistorico(5);

        //renderizar a tela
        $this->renderizar('home/index', [
            "titulo"        => "Painel de Controle de almoxarifado",
            "totalInsumos"  => $totalInsumos,
            "totalEstoque"  => $totalEstoque,
            "ultimasMovimentacoes"  => $ultimasMovimentacoes
        ]);
    }
}
