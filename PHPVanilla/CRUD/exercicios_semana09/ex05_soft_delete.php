<?php
declare(strict_types=1);

// DAO para peças industriais
final class ex05_soft_delete {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Exclusão lógica da peça
    public function excluir(int $id): bool {
        $sql = "UPDATE pecas_industriais
                SET ativo = FALSE
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    // Lista somente as peças ativas
    public function listarTodos(): void {
        $sql = "SELECT * FROM pecas_industriais
                WHERE ativo = TRUE
                ORDER BY id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        while ($peca = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $peca['id'] . "\n";
            echo "Nome: " . $peca['nome'] . "\n";
            echo "--------------------\n";
        }
    }
}

?>
