<?php
declare(strict_types=1);

// DAO para movimentação do estoque
final class ex04_movimentacao_estoque {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Registra uma movimentação no estoque
    public function registrarMovimentacao(
        int $pecaId,
        int $quantidade,
        string $tipo
    ): bool {
        $this->pdo->beginTransaction();

        try {
            // Busca a quantidade atual
            $sql = "SELECT quantidade FROM pecas_industriais
                    WHERE id = :id FOR UPDATE";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $pecaId]);

            $peca = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$peca || $quantidade <= 0) {
                $this->pdo->rollBack();
                return false;
            }

            $saldo = (int) $peca['quantidade'];

            // Verifica a saída do estoque
            if ($tipo === 'saida' && $saldo < $quantidade) {
                $this->pdo->rollBack();
                return false;
            }

            // Calcula o novo saldo
            if ($tipo === 'entrada') {
                $saldo = $saldo + $quantidade;
            } elseif ($tipo === 'saida') {
                $saldo = $saldo - $quantidade;
            } else {
                $this->pdo->rollBack();
                return false;
            }

            // Atualiza a quantidade
            $sql = "UPDATE pecas_industriais
                    SET quantidade = :quantidade
                    WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'quantidade' => $saldo,
                'id' => $pecaId
            ]);

            $this->pdo->commit();

            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}

?>
