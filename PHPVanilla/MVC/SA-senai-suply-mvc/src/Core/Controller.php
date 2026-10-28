<?php
declare(strict_types=1);

namespace App\Core;

use RuntimeException;

abstract class Controller {
    //classe abstrata com elementos de segurança e renderização de layout

    //método para renderizar layout ijetando dados padrão
     protected function renderizar(string $view, array $dados = []): void {
        extract($dados, EXTR_SKIP);
        $arquivoView = dirname(__DIR__) . "/Views/{$view}.php";
        if (!file_exists($arquivoView)) {
            throw new RuntimeException("A view nao foi localizada: {$arquivoView}");
        }
        require_once dirname(__DIR__) . "/Views/layout/header.php";
        require_once $arquivoView;
        require_once dirname(__DIR__) . "/Views/layout/footer.php";
    }

    //Método para Redirecionar -> rotas internas do sistema
    protected function redirecionar(string $rota): void {
        header("Location: {$rota}");
        exit;
    }

    //método para obter token Csrf de Sessão
    protected function obterCsrfToken(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return (string)$_SESSION['csrf_token'];
    }

    //método para validar token Csrf recebido
    protected function validarCsrfToken(?string $token): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $sessaoToken = $_SESSION['csrf_token'] ?? '';
        return !empty($token) && hash_equals((string)$sessaoToken, (string)$token);
    }
}