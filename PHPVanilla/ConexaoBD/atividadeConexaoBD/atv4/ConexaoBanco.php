<?php declare(strict_types=1);


//Criando uma classe responsavel por realizar a conexão com o banco 
//esse classe será um Singleton (permitira instanciar apenas um objeto por vez)

final class ConexaoBanco {
    //atributos
    //armazena a conexão aberta com o banco de dados
    private static ?PDO $instancia = null;

    //metodos
    //toda classe precisa de um construtor (o construtor é um metodo que permite a criação de objetos)
    // em classe do tipo singleton o construtor é private e vazio
    private function __construct(){}

    //metodos de segurança anti clonagem e ati-serialização(desserialização)
    private function __clone(): void{}
    public function __wakeup(): void{
        //estou criando uma execption (falhas/erros)
        throw new \Exception("Desserialização não permitida para Singleton");
    }

    //metodo para obter a conexão (precisa ser publico e estatico)
    public static function obterConexao(string $caminhoConfig): PDO {
        //verificar se ja não existe uma conexão 
        if(self::$instancia ===null){ //se n existir a conexão ent crio uma
            $config = self:: carregarArquivoConfig($caminhoConfig);
            self::$instancia = self::estabelecerConexao($config);
        }//caso ja exista, retorna a conexão ja existente
        return self::$instancia;
    }

    //criar os metodos para carregar arquivos do .ini
    private static function carregarArquivoConfig(string $caminho): array{
        if(!file_exists($caminho)){//se o arquivo não exisir
            throw new \RuntimeException("Arquivo de configuração não encontrado em {$caminho}");
        }//caso o arquivo exista
        $dados = parse_ini_file($caminho, true);
        if($dados === false || !isset($dados["database"])){
            throw new \RangeException(("Seção [database] ausente no arquivo de configuração"));
        }// se tudo tive ok
        return $dados["database"];
    }

    //criar metodo para estabelecer a conexão com o banco
    private static function estabelecerConexao(array $cfg): PDO{
        //montar o endereço de conexão (pgsql:host=127.0.0.1;port=5432;biblioteca_escola)
        $dsn = sprintf(
            "%s:host=%s;port=%s;dbname=%s",
            $cfg["db_driver"],
            $cfg["db_host"],
            $cfg["db_port"],
            $cfg["db_name"],
        );

        //montar as flags de segurança do PDO
            $opcoes = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 5
        ];
        return new PDO($dsn, $cfg["db_user"], $cfg["db_pass"], $opcoes );
    }
    
}
?>