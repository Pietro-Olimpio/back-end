<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\Usuario;

final class AuthController extends Controller {
    
    //métodos para renderizar de formulario de Login
    public function formularioLogin(): void {
        $this->renderizar("auth/login", [
            "titulo" => "Login Corporativo - SENAi Suply",
            "csrfToken" => $this->obterCsrfToken()
        ]);
    }

    //método de login => quando eu aperto o botão enviar 
    public function login(): void{
        if(!$this->validarCsrfToken($_POST["csrf_token"] ?? null)) {
            $this->renderizar("auth/login",["titulo"=>"login", "erro"=>"Sessão Expirada. Tente Novamente"]);
            return;
        }
        //pegar as informações do usuário que esta fazendo o login
        $email = trim($_POST["email"] ?? "");
        $senha = (string)($_POST["senha"] ?? "");
        //buscar as informações do usuário
        $usuario = Usuario::buscarPorEmail($email);
        if($usuario && password_verify($senha, $usuario["senha_hash"])) {
            session_regenerate_id(true);
            $_SESSION["usuario_id"] =(int)$usuario["id"];
            $_SESSION["usuario_nome"] =$usuario["nome"];
            $_SESSION["usuario_perfil"] =$usuario["perfil"];
            //log do sistema
            Logger::info("Login corporativo bem-sucedido", ['usuario_id' => $usuario['id'], 'perfil' => $usuario['perfil']]);
            //redireciona do login -> index
            $this->redirecionar("/");
        }

        //se erro a verificação de senha ou do email
        Logger::aviso("Falha na tentativa de login corporativo", ['email' => $email]);
        $this->renderizar('auth/login', ['titulo' => 'Login', 'erro' => 'Credenciais incorretas.', 'csrfToken' => $this->obterCsrfToken()]);


    }


    //método de logout
}