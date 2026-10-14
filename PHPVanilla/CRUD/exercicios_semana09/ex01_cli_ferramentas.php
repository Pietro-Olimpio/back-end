<?php
declare(strict_types=1);

// Camada de acesso a dados (DAO) para o almoxarifado
// Essa classe realiza operações no banco de dados

final class ex01_cli_ferramentas
{
    // Atributo que recebe a conexão com o banco
    private PDO $pdo;

    // Construtor que recebe a conexão PDO
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Cadastra uma nova ferramenta no banco
    public function cadastrar(array $dados): bool
    {
        $sql = "INSERT INTO ferramentas
                (nome, descricao, categoria, quantidade, preco_unitario)
                VALUES (:nome, :descricao, :categoria, :quantidade, :preco_unitario)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":nome" => trim($dados["nome"]),
            ":descricao" => trim($dados["descricao"]),
            ":categoria" => trim($dados["categoria"]),
            ":quantidade" => (int) $dados["quantidade"],
            ":preco_unitario" => (float) $dados["preco_unitario"]
        ]);
    }

    // Busca todas as ferramentas ativas
    public function buscarAtivo(): array
    {
        $sql = "SELECT * FROM ferramentas WHERE ativo = TRUE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Carrega as configurações da conexão com o banco
// Ajuste os dados conforme a configuração do seu PostgreSQL
$pdo = new PDO(
    "pgsql:host=localhost;port=5432;dbname=almoxarifado",
    "postgres",
    "sua_senha"
);

// Cria o objeto DAO com a conexão
$ferramentas = new ex01_cli_ferramentas($pdo);

// Define a opção inicial do menu
$opcao = 0;

// Repete o menu até o usuário escolher sair
while ($opcao != 3) {
    echo "\n===== MENU DE FERRAMENTAS =====\n";
    echo "1 - Cadastrar ferramenta\n";
    echo "2 - Listar ferramentas ativas\n";
    echo "3 - Sair\n";

    $opcao = (int) readline("Escolha uma opção: ");

    // Verifica se o usuário escolheu cadastrar
    if ($opcao == 1) {
        $dados = [];

        $dados["nome"] = readline("Nome: ");
        $dados["descricao"] = readline("Descrição: ");
        $dados["categoria"] = readline("Categoria: ");
        $dados["quantidade"] = readline("Quantidade: ");
        $dados["preco_unitario"] = readline("Preço unitário: ");

        if ($ferramentas->cadastrar($dados)) {
            echo "Ferramenta cadastrada com sucesso!\n";
        } else {
            echo "Erro ao cadastrar ferramenta!\n";
        }

    // Verifica se o usuário escolheu listar
    } elseif ($opcao == 2) {
        $resultado = $ferramentas->buscarAtivo();

        // Percorre as ferramentas retornadas pelo banco
        foreach ($resultado as $ferramenta) {
            echo "\nNome: " . $ferramenta["nome"] . "\n";
            echo "Descrição: " . $ferramenta["descricao"] . "\n";
            echo "Categoria: " . $ferramenta["categoria"] . "\n";
            echo "Quantidade: " . $ferramenta["quantidade"] . "\n";
            echo "Preço: R$ " . $ferramenta["preco_unitario"] . "\n";
        }

        if (count($resultado) == 0) {
            echo "Nenhuma ferramenta ativa encontrada.\n";
        }

    // Encerra o programa quando a opção for 3
    } elseif ($opcao == 3) {
        echo "Encerrando o programa...\n";

    // Informa quando a opção não existe
    } else {
        echo "Opção inválida! Tente novamente.\n";
    }
}
