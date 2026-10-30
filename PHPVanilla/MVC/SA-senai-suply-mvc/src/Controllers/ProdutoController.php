<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\Produto;

final class ProdutoController extends Controller {

    //método para listar os produtos
    public function listar ():void {
        $produtos = Produto::listarTodos();
        $this->renderizar('produtos/listar', [
            'titulo'   => 'Catálogo Geral de Insumos',
            'produtos' => $produtos
        ]);       
    }

    //método para renderizar o formulário de cadastro de produtos
    public function formulario(): void {
        $this->renderizar('produtos/criar', [
            'titulo'    => 'Cadastro de Novo Insumo',
            'csrfToken' => $this->obterCsrfToken()
        ]);
    }    


    //método para cadastrar produto
    public function salvar(): void {
        if (!$this->validarCsrfToken($_POST['csrf_token'] ?? null)) {
            $this->renderizar('produtos/criar', ['titulo' => 'Novo Insumo', 'erro' => 'Falha CSRF.']);
            return;
        }
        $nome = trim($_POST['nome'] ?? '');
        $cat  = trim($_POST['categoria'] ?? '');
        $preco = (float)($_POST['preco'] ?? 0.0);
        $est  = (int)($_POST['estoque'] ?? 0);

        if ($nome !== '' && $cat !== '' && $preco > 0.0 && $est >= 0) {
            Produto::salvar($nome, $cat, $preco, $est);
            Logger::info("Novo insumo cadastrado no almoxarifado", ['nome' => $nome, 'categoria' => $cat]);
            $this->redirecionar('/produtos');
        }
        //se tenta cadastrar sem informações, manda uma mensagem de aviso pro usuario
        $this->renderizar('produtos/criar', [
            'titulo'    => 'Novo Insumo',
            'erro'      => 'Preencha todos os campos corretamente.',
            'csrfToken' => $this->obterCsrfToken()
        ]);
    }   
}