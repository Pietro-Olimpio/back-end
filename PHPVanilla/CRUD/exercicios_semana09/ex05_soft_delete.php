<?php

declare(strict_types=1);

// DAO para movimentação de peças
final class ex05_soft_delete {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Busca o saldo atual da peça
    private function buscarSaldo(int $pecaId): ?int {
        $sql = "SELECT quantidade FROM pecas_industriais
                WHERE id = :id FOR UPDATE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $pecaId]);
        $peca = $stmt->fetch(PDO::FETCH_ASSOC);

        return $peca ? (int) $peca['quantidade'] : null;
    }

    // Atualiza o saldo da peça
    private function atualizarSaldo(int $pecaId, int $saldo): void {
        $sql = "UPDATE pecas_industriais
                SET quantidade = :quantidade WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'quantidade' => $saldo,
            'id' => $pecaId
        ]);
    }

    // Registra uma entrada ou saída
    public function registrarMovimentacao(
        int $pecaId,
        int $quantidade,
        string $tipo
    ): bool {
        if ($quantidade <= 0 ||
            ($tipo !== 'entrada' && $tipo !== 'saida')) {
            return false;
        }

        $this->pdo->beginTransaction();

        try {
            $saldo = $this->buscarSaldo($pecaId);

            if ($saldo === null ||
                ($tipo === 'saida' && $saldo < $quantidade)) {
                $this->pdo->rollBack();
                return false;
            }

            $novoSaldo = $tipo === 'entrada'
                ? $saldo + $quantidade
                : $saldo - $quantidade;

            $this->atualizarSaldo($pecaId, $novoSaldo);
            $this->pdo->commit();

            return true;
        } catch (PDOException $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            return false;
        }
    }
}

?>