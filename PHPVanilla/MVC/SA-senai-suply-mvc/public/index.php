<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProdutoController;
use App\Core\AuthGuard;
use App\Core\Roteador;

//front Controller da Aplicação 

//Ponto único de entrada da aplicação,
// inicializa a sessão e autoloader PSR-4 
//e criar as rotas de navegação possíveis 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//inicia ao autoload 
require_once dirname(__DIR__) . '/vendor/autoload.php';

$roteador = new Roteador();

//1. Rotas públicas (Acesso Anonimo Permitido)
$roteador->registrar('GET', '/login', [AuthController::class, 'formularioLogin']);
$roteador->registrar('POST', '/login', [AuthController::class, 'login']);

//2. Rotas Protegidas de Consultas (Qualquer pessoal Logada Pode acessar)
$guardConsulta = [[AuthGuard::class, ['gestor', 'almoxarife', 'admin']]];
$roteador->registrar('GET', '/', [HomeController::class, 'index'], $guardConsulta);
$roteador->registrar('GET', '/produtos', [ProdutoController::class, 'listar'], $guardConsulta);
$roteador->registrar('GET', '/movimentacoes', [MovimentacaoController::class, 'historico'], $guardConsulta);
$roteador->registrar('POST', '/logout', [AuthController::class, 'logout'], $guardConsulta);

//3. Rotas Opereacionais de Escrita (Almoxarife e o Admin)
$guardOperacional = [[AuthGuard::class, ['almoxarife', 'admin']]];
$roteador->registrar('GET', '/produtos/novo', [ProdutoController::class, 'formulario'], $guardOperacional);
$roteador->registrar('POST', '/produtos/salvar', [ProdutoController::class, 'salvar'], $guardOperacional);
$roteador->registrar('GET', '/movimentacoes/novo', [MovimentacaoController::class, 'formulario'], $guardOperacional);
$roteador->registrar('POST', '/movimentacoes/salvar', [MovimentacaoController::class, 'salvar'], $guardOperacional);

//Despahcar a Rota
$roteador->despachar($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);