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
                "httponly"  =>true,
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

    // verificação de tempo de inicatividade
    public static function verificarExpiracao(): bool {
        self::iniciarSessaoSegura();
        //se não tiver sessão, então inicia uma (direciona para login)
        if(!isset($_SESSION["ultimo_acesso"])){
            return true;
        }
        //se já exisitir uma sessão iniciada, epassou do tempo de inatividade
        if((time() - $_SESSION["ultimo_acesso"]) > self::TEMPO_INATIVIDADE_SEG){
            self::destruirSessao(); //deslogar o usuário
            return true; //retornar para tela de login
        }
        $_SESSION["ultimo_acesso"] = time();
        return false; // continua logado
    }

    //destruir a session => função que permite deslogar o usuário e limpar os dados da sessão
    public static function destruirSessao(): void {
        self::iniciarSessaoSegura();
        $_SESSION=[];

        //Limpando os dados do cookies da sessao
        if(ini_get("session.use_coockies")){
            $params = session_get_cookie_params();
            setcookie(
                session_name(),"",time()-42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        //executa a função nativa de logout de sessão
        session_destroy();
    }
}


