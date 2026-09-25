<?php declare(strict_types=1);
//criando um gerenciados de fluxo de inicializacao, teste de latencia do banco, e busca da informações com auditoria em log de segurança

//usar o comando required_one para buscar o arquivo de conexão
require_once __DIR__ . "/src/ConexaoBanco.php";

//caminhos de arquivos de configuração e log
const ARQUIVO_CONFIG = __DIR__ . "/config/database.ini";
const ARQUIVO_LOG = __DIR__ . "/logs/database.log";

//registrar para capturas erros no log do sistema
function gravarLogErro(string $mensagem): void{
    $diretorio = dirname(ARQUIVO_LOG);
    if(!is_dir($diretorio)){//se diretorio de armazenamento de logs n for valido, crie o diretorio
        mkdir($diretorio, 0755, true);
    }
    //Formatar a linha de log e adicionar a mensagem com timeStamp (carimbo de data e hora)
    $linha = sprintf("[%s] ERRO INFRA: %s%s", date("Y-m-d H:i:s"), $mensagem, PHP_EOL);
    //add a linha do arquivo
    file_put_contents(ARQUIVO_LOG, $linha, FILE_APPEND);
}

//função para consulta dos livros cadastrados no banco
//codigo SQL de Consulta o banco
function listarLivros(PDO $pdo): array{
    $sql = "SELECT * FROM livros
            ORDER BY id DESC";
    //statement => ordem de constulta
    $stmt = $pdo->query($sql);
    //retorna o array da consulta
    return $stmt->fetchAll();
}

$conectado = false;
$livros = [];
$mensagemErro = "";

//sistema de tratamento de erros -> try executa, e  catch-> captura os erros do sistema
try {
    //crio a conexão com o banco
    $pdo = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
    $conectado = true;
    $livros = listarLivros($pdo);
} catch (PDOException $e) {
    gravarLogErro("Erro no banco de dados: " . $e->getMessage()); //mensagem pro ADM
    $mensagemErro = "não foi possivel conectar ao banco de dados. Tente novamente mais tarde"; //mensagem para o usuario

}catch (\Throwable $th){
    gravarLogErro("Erro no banco de dados: " . $th->getMessage());
    $mensagemErro = "ocorreu um erro inesperado do sistema.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Escolar - Acervo de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        h1, h2 { color: #2c3e50; margin-top: 0; }
        .status { display: inline-block; padding: 6px 12px; border-radius: 20px; font-weight: bold; font-size: 0.9rem; }
        .sucesso { background: #d4edda; color: #155724; }
        .erro { background: #f8d7da; color: #721c24; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #e9ecef; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; color: #fff; }
        .DISPONIVEL { background-color: #28a745; }
        .EMPRESTADO { background-color: #dc3545; }
        .RESERVADO { background-color: #ffc107; color: #212529; }
    </style>
</head>
<body>
    <div class="container">
    <div class="card">
        <h1>📚 Sistema de Biblioteca Escolar</h1>
        <?php if ($conectado): ?>
            <span class="status sucesso">Conexão com o PostgreSQL estabelecida!</span>
        <?php else: ?>
            <span class="status erro">Falha na Conexão</span>
            <p style="color: #721c24; margin-top: 10px;"><?= htmlspecialchars($mensagemErro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
    </div>

    <?php if ($conectado): ?>
        <div class="card">
            <h2>📖 Acervo de Livros Cadastrados</h2>
            <?php if (empty($livros)): ?>
                <p>Nenhum livro cadastrado até o momento.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Preço</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($livros as $livro): ?>
                            <tr>
                                <td>#<?= (int)$livro['id'] ?></td>
                                <td><strong><?= htmlspecialchars($livro['titulo'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                                <td><?= htmlspecialchars($livro['autor'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>R$ <?= number_format((float)$livro['preco'], 2, ',', '.') ?></td>
                                <td>
                                    <span class="badge <?= htmlspecialchars($livro['status'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($livro['status'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>    
</body>
</html>