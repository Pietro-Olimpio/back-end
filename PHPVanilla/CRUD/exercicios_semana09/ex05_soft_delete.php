
<?php
declare(strict_types=1);

// DAO para exclusão lógica de peças
final class ex05_soft_delete
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Desativa a peça sem apagar do banco
    public function excluir(int $id): bool
    {
        $sql = "UPDATE pecas_industriais
                SET ativo = FALSE
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
?>
