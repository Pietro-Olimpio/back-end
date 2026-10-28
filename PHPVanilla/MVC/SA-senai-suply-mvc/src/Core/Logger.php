<?php
declare(strict_types=1);

namespace App\Core;


//Classe de centralização de logs corporativos para persistência na raiz do projeto

final class Logger{
    //Registro de eventos de Log para Auditoria/Erros e Avisos

    private static function gravar(string $nivel, string $mensagem, array $contexto): void{
        //gravar o arquivo na raiz do servidor
        $caminho = dirname(__DIR__,2) . "/logs";
        if(!is_dir($caminho)){
            mkdir($caminho, 0755, true);
        }
        $ip = $_SERVER["REMOTE_ADDR"] ?? "CLI"; //Pega o ip do Usuário
        $dataHora = date("Y-m-d H:i:s"); //pega data e hora
        $detalhe = !empty($contexto) ? " " .json_encode($contexto, JSON_UNESCAPED_UNICODE) : "";
        $linha = sprintf("[%s] [%s] [IP: %s] %s%s%s", $dataHora, $nivel, $ip, $mensagem, $detalhe, PHP_EOL);
        file_put_contents($caminho . "/app.log", $linha, FILE_APPEND | LOCK_EX);
    }

    //criar o metodo para identificar logs ( auditoria, aviso, erro)
    // Registrar evento informativo de auditoria
    public static function info(string $mensagem, array $contexto=[]):void{
        self::gravar("INFO", $mensagem, $contexto);
    }
    //Registro de aviso - Violação de Regra de negocio
    public static function aviso(string $mensagem, array $contexto=[]):void{
        self::gravar("AVISO", $mensagem, $contexto);
    }
    //Registro de falha de erro - execução critica
    public static function erro(string $mensagem, array $contexto=[]):void{
        self::gravar("ERRO", $mensagem, $contexto);
    }

    //obs: metodo ou atributos "static" -> são executados ou chamados diretamente pela classe
    // sem a necessidade de instanciar um obj
    // podemos fazer uma analogia a u obj descartavel
    // serve apenas para uma unica tarefa e depois é jogado fora
    // evita ocupar espaço na memoria co objetos que não seram mais usados
}