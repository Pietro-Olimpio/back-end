<?php
declare(strict_types=1);

//Clase para cerificacao de usarios atraves de autenticação
//criacao de sessao e cookies de navegador
final class AuthService {
    //atributo
    private const TEMPO_INATIVIDADE_SEG = 900;//15min

    //criar funções static => não precisa criar objeto => funções executas diariamente pela classe

    public static function iniciarSessaoSegura():void{
        if(session_start() === PHP_SESSION_NONE){ //verifica se a sessão ja existe
            //se n tem => cria uma
            //cria os parametros cookie
            session_set_cookie_params([
                "lifetime"  =>0,
                "path"      =>"/",
                "httoinly"  =>true,
                "samesite"  =>"Lax",
            ]);
            //inicia a session
            session_start();
        }
    }

    //grava os dados do usuario na sessão e gerar um idenntificador
    public static function autenticar(array $usuario): void{
        //iniciar a sessão
        self::iniciarSessaoSegura(); //criar 
        session_regenerate_id(true);

        //gravando na superglobal as informações do usuario conectado
        $_SESSION["usuario_id"]         = (int)$usuario["id"];
        $_SESSION["usuario_nome"]       = (string)$usuario["nome"];
        $_SESSION["usuario_email"]      = (string)$usuario["email"];
        $_SESSION["usuario_perfil"]     = (string)$usuario["perfil"];
        $_SESSION["ultimo_acesso"]      = time();
    }

    //verifica  tempo de inicatividade
    public static function verificarEcpiracao(): bool {
        self::iniciarSessaoSegura();
        if(!isset($_SESSION["ultimo_acesso"])){
            return true;
    }
    if((time() - $_SESSION["ultimo"]))


}