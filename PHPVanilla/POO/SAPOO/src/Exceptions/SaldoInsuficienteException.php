<?php
declare(strict_types=1);

final class SaldoInsuficienteException extends ContaException{
    #[Override]
    public function __construct(float $saldoDisponivel, float $valorTentado)
    {
        $menssage = sprintf(
            "Saldo insuficiente. Disponivel: R$ %.2f | Tentativa c encargos: R$ %.2f",
            $saldoDisponivel,
            $valorTentado
        );
        parent::__construct($menssage);
    }
}