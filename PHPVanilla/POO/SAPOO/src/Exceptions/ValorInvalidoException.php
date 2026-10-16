<?php
declare(strict_types=1);

final class ValorInvalidoException extends ContaException {
    #[Override]
    public function __construct(float $valor)
    {
        $message = sprintf("Valor R$ %.2f inválido. A quantidade deve ser positiva e maior que zero.", $valor);
        parent::__construct($message);
    }
    
}
