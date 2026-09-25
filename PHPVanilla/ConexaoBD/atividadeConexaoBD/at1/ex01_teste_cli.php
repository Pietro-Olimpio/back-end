<?php declare(strict_types=1);

//criando um gerenciados de fluxo de inicializacao, teste de latencia do banco, e busca da informações com auditoria em log de seguranç
//usar o comando required_one para buscar o arquivo de conexão

require_once __DIR__ . "/ConexaoBanco.php";

//caminhos de arquivos de configuração e log
const ARQUIVO_CONFIG = __DIR__ . "/database.ini";

function testarConexao(): string
{
    try {

        // Cria a conexão com o banco
        $pdo = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

        return "Conexão com PostgreSQL realizada com sucesso!";

    } catch (PDOException $e) {

        return "Não foi possível conectar ao banco de dados.";

    } catch (Throwable $th) {

       return "Não foi possível acessar o PostgreSQL na porta 5432.";
    }
}

echo testarConexao();

?>